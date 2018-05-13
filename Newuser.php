<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Newuser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("user_model");
    }
    public function index() {
        $this->load->view('form_user');
    }

    public function authenticate() {
//            echo 'hai'; 
//         $this->user_model->abc();
        $username = $this->input->post('txt_username');
        $userpassword = $this->input->post('txt_password');
        $data = array(
            'user_name' => $username,
            'user_password' => $userpassword,
        );
       $user_id= $this->user_model->abc($data);
       echo $user_id;
           }
}
