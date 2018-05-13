<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('google');
        $this->load->library('facebook');
        $this->load->model('main');
    }

    public function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $data = array();
        $data['gloginURL'] = $this->google->loginURL();
        $data['floginURL'] = $this->facebook->login_url();
        $this->load->view('common/header2');
        $this->load->view('login', $data);
        $this->load->view('common/footer2');
    }

//    public function login_google() {
//        $this->load->helper(array('form', 'url'));
//        $this->load->library('session');
//
//       
//
//        //load google login view
//        $this->load->view('user_authentication/index', $data);
//    }

    public function authenticate() {
        $this->load->library('session');
        $this->load->model('userpost');
        $this->load->model('adminpost');
//        var_dump($_GET);
//        var_dump($_POST);
//        exit();
        if ($this->facebook->is_authenticated() && isset($_GET['code'])) {
//            exit('fb');
            // Get user facebook profile details
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');

            // Preparing data for database insertion
//            $userData['oauth_provider'] = 'facebook';
//            $userData['oauth_uid'] = $userProfile['id'];
//            $userData['first_name'] = $userProfile['first_name'];
//            $userData['last_name'] = $userProfile['last_name'];
//            $userData['email'] = $userProfile['email'];
//            $userData['gender'] = $userProfile['gender'];
//            $userData['locale'] = $userProfile['locale'];
//            $userData['profile_url'] = 'https://www.facebook.com/' . $userProfile['id'];
//            $userData['picture_url'] = $userProfile['picture']['data']['url'];
            // Insert or update user data
            $userdata = $this->main->user_login_g($userProfile['email']);
            if (!empty($userdata)) {
                
            } else {
                $datain = array(
                    'name' => $userProfile['first_name'] . ' ' . $userProfile['last_name'],
                    'username' => $userProfile['email'],
                    'email' => $userProfile['email'],
                    'password' => '',
                    'gender' => $userProfile['gender']
                );
//                $imagedata = getimagesize($gpInfo['picture']);
//                $fp = fopen($gpInfo['picture'], "rb");
//                if ($imagedata && $fp) {
//                    header("Content-type: {$imagedata['mime']}");
//                    fpassthru($fp);
//                }
//                exit;
//                var_dump($imagedata);
//                exit();
                $this->main->userregister($datain);
                $userdata = $this->main->user_login_g($userProfile['email']);
//                var_dump($userdata);
            }
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $userdata = $this->main->user_login($username, $password);
        }

//        var_dump($userdata);
//        exit();
        if (!empty($userdata)) {
            if ($userdata->user_role === 'admin') {
                $data = $userdata;
//echo($data[0]['username']);
                $this->session->set_userdata(array('user_login' => $data->username, 'logged_in' => $data));

                $post_data = $this->userpost->get_user_profile($data->username);
                $data = array();
                $data['post'] = $post_data;
                $post_data1 = $this->userpost->get_user_pic($_SESSION['user_login']);
                $data['pic'] = $post_data1;
                $data['bloglist'] = $this->adminpost->get_bloglist();
                $this->load->view('common/headeradmin', $data);
                $this->load->view('admin/bloglist', $data);
                $this->load->view('common/footeradmin', $data);
            } else {
                $data = $userdata;
                $this->session->set_userdata(array('user_login' => $data->username, 'logged_in' => $data));

                $post_data = $this->userpost->get_user_profile($data->username);
                $data = array();
                $data['post'] = $post_data;
                $post_data1 = $this->userpost->get_user_pic($_SESSION['user_login']);
                $data['pic'] = $post_data1;
                $data22 = array
                    (
                    'flogin' => 1,
                );


                if ($userdata->flogin == 1) {

//                    $data['result'] = $this->userpost->get_category();
//                    $data['topics'] = $this->userpost->get_topics();
//                    $data['bloglist'] = $this->main->get_bloglist();
//
//                    if (isset($_SESSION['user_login'])) {
//                        $post_data = $this->userpost->get_user_profile($_SESSION['user_login']);
//                        $data['post'] = $post_data;
//                    }
                    redirect('/home/', 'location');
                } else {
                    $this->userpost->edit_profile($data22);
//                    $this->db->select('username');
//                    $this->db->where('email', $this->input->post('username'));
//                    $q = $this->db->get('users');
//                    $data = $q->result_array();
//echo($data[0]['username']);
                    redirect('/user/usernewgroup', 'location');
                }
            }
        } else {
            $data["error"] = "Incorrect Email ID or Password";
            $data['gloginURL'] = $this->google->loginURL();
            $data['floginURL'] = $this->facebook->login_url();
            $this->load->view('common/header2');
            $this->load->view('login', $data);
            $this->load->view('common/footer-login');
        }
    }

    public function authenticate_google() {
        $this->load->library('session');
        $this->load->model('userpost');
        $this->load->model('adminpost');
        if (isset($_GET['code'])) {
//            exit('google');
            $this->google->getAuthenticate();
            //get user info from google
            $gpInfo = $this->google->getUserInfo();
//            var_dump($gpInfo);
//            exit();

//            //preparing data for database insertion
//            $userData['oauth_provider'] = 'google';
//            $userData['oauth_uid'] = $gpInfo['id'];
//            $userData['first_name'] = $gpInfo['given_name'];
//            $userData['last_name'] = $gpInfo['family_name'];
//            $userData['email'] = $gpInfo['email'];
//            $userData['gender'] = !empty($gpInfo['gender']) ? $gpInfo['gender'] : '';
//            $userData['locale'] = !empty($gpInfo['locale']) ? $gpInfo['locale'] : '';
//            $userData['profile_url'] = !empty($gpInfo['link']) ? $gpInfo['link'] : '';
//            $userData['picture_url'] = !empty($gpInfo['picture']) ? $gpInfo['picture'] : '';
            $userdata = $this->main->user_login_g($gpInfo['email']);
            if (!empty($userdata)) {
//                exit('adasd');
            } else {
                $datain = array(
                    'name' => $gpInfo['given_name'] . ' ' . $gpInfo['family_name'],
                    'username' => $gpInfo['email'],
                    'email' => $gpInfo['email'],
                    'password' => '',
                    'gender' => $gpInfo['gender']
                );
//                $imagedata = getimagesize($gpInfo['picture']);
//                $fp = fopen($gpInfo['picture'], "rb");
//                if ($imagedata && $fp) {
//                    header("Content-type: {$imagedata['mime']}");
//                    fpassthru($fp);
//                }
//                exit;
//                var_dump($imagedata);
//                exit();
                $this->main->userregister($datain);
                $userdata = $this->main->user_login_g($gpInfo['email']);
//                var_dump($userdata);
            }
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $userdata = $this->main->user_login($username, $password);
        }

//        var_dump($userdata);
//        exit();
        if (!empty($userdata)) {
            if ($userdata->user_role === 'admin') {
                $data = $userdata;
//echo($data[0]['username']);
                $this->session->set_userdata(array('user_login' => $data->username, 'logged_in' => $data));

                $post_data = $this->userpost->get_user_profile($data->username);
                $data = array();
                $data['post'] = $post_data;
                $post_data1 = $this->userpost->get_user_pic($_SESSION['user_login']);
                $data['pic'] = $post_data1;
                $data['bloglist'] = $this->adminpost->get_bloglist();
                $this->load->view('common/headeradmin', $data);
                $this->load->view('admin/bloglist', $data);
                $this->load->view('common/footeradmin', $data);
            } else {
                $data = $userdata;
                $this->session->set_userdata(array('user_login' => $data->username, 'logged_in' => $data));

                $post_data = $this->userpost->get_user_profile($data->username);
                $data = array();
                $data['post'] = $post_data;
                $post_data1 = $this->userpost->get_user_pic($_SESSION['user_login']);
                $data['pic'] = $post_data1;
                $data22 = array
                    (
                    'flogin' => 1,
                );


                if ($userdata->flogin == 1) {

//                    $data['result'] = $this->userpost->get_category();
//                    $data['topics'] = $this->userpost->get_topics();
//                    $data['bloglist'] = $this->main->get_bloglist();
//
//                    if (isset($_SESSION['user_login'])) {
//                        $post_data = $this->userpost->get_user_profile($_SESSION['user_login']);
//                        $data['post'] = $post_data;
//                    }
                    redirect('/home/', 'location');
                } else {
                    $this->userpost->edit_profile($data22);
//                    $this->db->select('username');
//                    $this->db->where('email', $this->input->post('username'));
//                    $q = $this->db->get('users');
//                    $data = $q->result_array();
//echo($data[0]['username']);
                    redirect('/user/usernewgroup', 'location');
                }
            }
        } else {
            $data["error"] = "Incorrect Email ID or Password";
            $data['gloginURL'] = $this->google->loginURL();
            $data['floginURL'] = $this->facebook->login_url();
            $this->load->view('common/header2');
            $this->load->view('login', $data);
            $this->load->view('common/footer-login');
        }
    }

}
