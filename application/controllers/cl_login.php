<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
    }

    public function login()
    {
        $this->load->view('register/view_sign-in');
    }

    public function registration_mail()
    {
        $this->load->view('register/view_registration_mail');
    }

    public function forgot_password()
    {
        $this->load->view("register/forgot-password");
    }

    public function register()
    {
        $code = $this->input->get("code");
        if($code == null) {
            header("HTTP/1.1 404 Not Found");
            exit;
            // $this->load->view("404.html");
            // redirect("cl_landing/login");
        } else {
            $this->load->model("mdl_register");
            $data = $this->mdl_register->select_code($code);
            if($data) {
                // var_dump($data);
                // exit;
                $this->load->view("register/view_register", $data);
            } else {
                header("HTTP/1.1 404 Not Found");
            }
        }
    }

    /**
     * check_user
     * 
     * @param $_POST["email"] = ポストされたメールアドレス
     * @return メインページにリダイレクト
     */
    public function chk_login()
    {
        if($this->vali_login_data() === true) {
            $data = $this->chk_login_data();
            if($data !== false) {
                if($this->chk_password($data) === true) {
                    session_start();
                    $SESSION["shops_id"] = $data["shops_id"];
                    redirect("cl_main/home");
                } else {
                    redirect("cl_landing/login");
                }
            } else {
                redirect("cl_landing/login");
            }
        } else {
            $this->load->view('cl_landing/login');
        }
    }

    private function vali_login_data()
    {
        $config = [
            [
                'field' => 'email',
                'label' => 'メールアドレス',
                'rules' => 'required'
            ],
            [
                'field' => 'password',
                'label' => 'パスワード',
                'rules' => 'required'
            ],
        ];
        $this->load->library("form_validation", $config);
        return $this->form_validation->run();
    }

    private function chk_login_data()
    {
        $data = [
            "shop_email" => $this->input->post("email")
        ];
        $this->load->model("mdl_login");
        return $this->mdl_login->select_login_data($data);
    }

    private function chk_password($data)
    {
        $password = $this->input->post("password");
        return password_verify($password, $data["shop_password"]);
    }
}