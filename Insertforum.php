<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Insertforum extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('adminpost');
    }

//    public function index() {
//
//        $data['result'] = $this->adminpost->get_category();
//        $this->load->view('common/headeradmin');
//        $this->load->view('admin/newforum');
//        $this->load->view('common/footeradmin');
//    }

    function insert_frm_db() {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');

//        $last_row = $this->adminapi_model->get_lastjob();
//        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('title', 'Forum Title', 'trim|required');
        $this->form_validation->set_rules('tags', 'Forum Tags', 'trim|required');
        $this->form_validation->set_rules('category', 'Forum Category', 'trim|required');
        $array = explode(',', $_POST['tags']);

        $tags = serialize($array);
        if ($this->form_validation->run() !== FALSE) {

            $title = $this->input->post('title');
            $category = $this->input->post('category');

            $data = array
                (
                'forum_title' => $title,
                'tags' => $tags,
                'category' => $category
            );
            $this->adminpost->insert_forum_db($data);
            $data['result'] = $this->adminpost->get_forum();
            $this->load->view('common/headeradmin', $data);
            $this->load->view('admin/forum');
            $this->load->view('common/footeradmin');
        } else {
            $this->load->view('common/headeradmin');
            $this->load->view('admin/newforum');
            $this->load->view('common/footeradmin');
        }
    }

}

?>  