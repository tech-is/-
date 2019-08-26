<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_landing extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
    }

    /**
     * index
     *
     * @return require('index.html')
     */
    public function index()
    {
        $this->load->view('index.html');
    }

    public function login()
    {
        $this->load->view('view_sign-in');
    }

    public function registration_mail()
    {
        $this->load->view('view_registration_mail');
    }

    public function forgot_password()
    {
        $this->load->view("forgot-password");
    }

    public function register()
    {
        $code = $this->input->get("code");
        if($code == null) {
            redirect("cl_landing/login");
        } else {
            $this->load->model("mdl_register");
            $data = $this->mdl_register->check_code($code);
            if(!$data) {
                echo "dbにありませんす";
                exit;
            } else {
                $this->load->view("view_register", $data);
            }
        }
    }
}