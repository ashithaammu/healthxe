<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

    public function __construct() {

        parent::__construct();
        //  $this->load->helper('smiley');
        $this->load->model('main');
        $this->load->model('userpost');
        $this->load->library('session');
    }

    public function index($i) {
        $post_data = $this->main->get_single_post($i);
        if (empty($post_data)) {
            show_404();
            die();
        }
        if ($_POST) {
            $action = $this->input->post('action');
            if ($action === 'send_query') {
                $from_email = "info@healthxe.com";
                $to_email = "kiranant@gmail.com";

                //Load email library 
                $this->load->library('email');

                $this->email->from($from_email, $this->input->post('email') . ' ' . $this->input->post('name'));
                $this->email->to($to_email);
                $this->email->subject('contact form');
                $this->email->message($this->input->post('nsg') . ',' . $this->input->post('email') . ' ,' . $this->input->post('name') . ' ,contact no: ' . $this->input->post('phone'));
                //Send mail 
                if ($this->email->send()) {
                    $this->session->set_flashdata("email_sent1", "  <h4 style='text-align: center;'>Email sent successfully.</h4>");
                } else {
                    $this->session->set_flashdata("email_sent1", "Error in sending Email.");
                }
            }
        }
        $header_Data = array();
        $data['postt'] = $post_data;
        $data['result'] = $this->userpost->get_category();
        $data['topics'] = $this->userpost->get_topics();
        $data['postpic'] = $this->main->get_post_pic($i);
        $data['like_count'] = $this->main->post_like_count($i);
        $data['postlikes'] = $this->main->post_likes_list($i);
        $data['comments'] = $this->main->get_comments($i, 0);
//        var_dump($post_data);
//        exit();
        $header_Data['page_title'] = $post_data->title;
        $header_Data['page_desc'] = $post_data->content;
        $header_Data['page_image'] = $post_data->im_path;
        $data['comments_count'] = count($data['comments']);
        if (isset($_SESSION['user_login'])) {
            $post_data = $this->userpost->get_user_profile($_SESSION['user_login']);
            $data['post'] = $post_data;
            $user_data = $_SESSION['logged_in'];
            $data['contractors'] = $this->userpost->get_user_groups($user_data->user_id);
            $header_Data['user_role'] = $user_data->user_role;
        }
        $this->load->view('common/header', $header_Data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('single', $data);
        $this->load->view('common/footer2');
    }

    public function forum($i) {
        $post_data = $this->main->get_single_forum($i);
        if (empty($post_data)) {
            show_404();
            die();
        }
        $header_Data = array();
        $data['postt'] = $post_data;
        $data['post_id'] = $i;
        $header_Data['page_title'] = $post_data->title;
        $header_Data['page_desc'] = $post_data->content;
        $header_Data['page_image'] = $post_data->im_path;
        if (isset($_SESSION['user_login'])) {
            $post_data = $this->userpost->get_user_profile($_SESSION['user_login']);
            $data['post'] = $post_data;
            $user_data = $_SESSION['logged_in'];
            $data['contractors'] = $this->userpost->get_user_groups($user_data->user_id);
            $header_Data['user_role'] = $user_data->user_role;
        }
        $data['result'] = $this->userpost->get_category();
        $data['topics'] = $this->userpost->get_topics();
        $data['postpic'] = $this->main->get_forum_pic($i);
        $this->load->view('common/header', $header_Data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('forumsingle', $data);
        $this->load->view('common/footer2');
    }

    public function process_form($i) {
        $from_email = "jayasree@cazablaze.com";
        $to_email = "jayasreetu@gmail.com";
        $data['topics'] = $this->userpost->get_topics();
        $data['post_id'] = $i;
        //Load email library 
        $this->load->library('email');

        $this->email->from($from_email, $this->input->post('email') . ' ' . $this->input->post('name'));
        $this->email->to($to_email);
        $this->email->subject('contact form');
        $this->email->message($this->input->post('nsg') . ',' . $this->input->post('email') . ' ,' . $this->input->post('name') . ' ,contact no: ' . $this->input->post('phone'));

        //Send mail 
        if ($this->email->send())
            $this->session->set_flashdata("email_sent1", "  <h4 style='text-align: center;'>Email sent successfully.</h4>");
        else
            $this->session->set_flashdata("email_sent1", "Error in sending Email.");
        $post_data = $this->main->get_single_forum($i);
        if (empty($post_data)) {
            show_404();
            die();
        }
        $header_Data = array();
        $data['postt'] = $post_data;
        $header_Data['page_title'] = $post_data->title;
        $header_Data['page_desc'] = $post_data->content;
        $header_Data['page_image'] = $post_data->im_path;
        if (isset($_SESSION['user_login'])) {
            $post_data = $this->userpost->get_user_profile($_SESSION['user_login']);
            $data['post'] = $post_data;
            $user_data = $_SESSION['logged_in'];
            $data['contractors'] = $this->userpost->get_user_groups($user_data->user_id);
            $header_Data['user_role'] = $user_data->user_role;
        }
        $data['result'] = $this->userpost->get_category();
        $data['topics'] = $this->userpost->get_topics();
        $data['postpic'] = $this->main->get_forum_pic($i);
        $this->load->view('common/header', $header_Data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('forumsingle', $data);
        $this->load->view('common/footer2');
    }

    public function forum_topics($i) {
        $data['bloglist'] = $this->main->get_forum_catpost($i);
//        $data['comments'] = $this->main->get_comments();
        $data['result'] = $this->userpost->get_category();
        $data['topics'] = $this->userpost->get_topics();
        $header_Data = array();
        if (isset($_SESSION['user_login'])) {
            $post_data = $this->userpost->get_user_profile($_SESSION['user_login']);
            $data['post'] = $post_data;
            $user_data = $_SESSION['logged_in'];
            $data['contractors'] = $this->userpost->get_user_groups($user_data->user_id);
            $header_Data['user_role'] = $user_data->user_role;
        }
        $this->load->view('common/header', $header_Data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('forum', $data);
        $this->load->view('common/footer2');
    }

    public function blog_topics($i) {
        $header_Data = array();
        if (isset($_SESSION['user_login'])) {
            $post_data = $this->userpost->get_user_profile($_SESSION['user_login']);
            $data['post'] = $post_data;
            $user_data = $_SESSION['logged_in'];
            $data['contractors'] = $this->userpost->get_user_groups($user_data->user_id);
            $header_Data['user_role'] = $user_data->user_role;
        }
        $data['bloglist'] = $this->main->get_catpost($i);
//        $data['comments'] = $this->main->get_comments();
        $data['result'] = $this->userpost->get_category();
        $data['topics'] = $this->userpost->get_topics();
        $this->load->view('common/header', $header_Data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('blog', $data);
        $this->load->view('common/footer2');
    }

}
