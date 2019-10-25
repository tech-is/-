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
        if($_SERVER["REQUEST_METHOD"] !== "POST" && $this->input->get("error") == 1) {
            $data["error"] = "メールアドレスかパスワードが間違っています";
            $this->load->view('login/view_sign-in', $data);
        } else {
            $this->load->view('login/view_sign-in');
        }
    }

    public function registration_mail()
    {
        $this->load->view('login/view_registration_mail');
    }

    public function forgot_password()
    {
        $this->load->view("login/forgot-password");
    }

    public function register()
    {
        $code = $this->input->get("code");
        if($code == null) {
            exit;
        } else {
            $this->load->model("mdl_shops");
            $data = $this->mdl_shops->select_code($code);
            if($data) {
                $this->load->view("login/view_register", $data);
            } else {
                exit;
            }
        }
    }

    public function password_reset()
    {
        $code = $this->input->get("code");
        $this->load->view("view_password_reset");
    }

    public function send_token()
    {
        $email = $this->input->post("email");
        if($this->chk_login_data() == true) {
            try {
                $this->load->library("email");
                $this->email->from("example@example.com", "Animarlシステムメール");
                $this->email->to($email);
                $this->email->subject("Animarlログインパスワードリセット");
                $msg = <<< EOM
                いつもAnimarlをご利用いただきありがとうございます。\n
                パスワードリセット用のURLを添付いたしましたので以下のリンクから変更をお願い致します。\n
                http://animarl.com/cl_login/password_reset?=
                このメールに心当たりがない場合、他のお客様がパスワードをリセットする際に誤って\n
                お客様のメールアドレスを入力した可能性がありますので、\n
                お手数ですがメールを破棄してくださいますようお願い致します。\n";
                EOM;
                $this->email->message($msg);
            } catch(extension $e) {
                echo "メールの送信に失敗しました";
            }
        } else {
            return false;
        }
    }

    public function chk_login()
    {
        if($this->vali_login_data()) {
            $email = $this->input->post("email");
            $data = $this->chk_login_data($email);
            if(!empty($data)) {
                if($this->chk_password($data)) {
                    session_start();
                    $_SESSION["shop_id"] = $data["shop_id"];
                    redirect("cl_main/home");
                } else {
                    redirect("cl_login/login?error=1");
                }
            } else {
                redirect("cl_login/login?error=1");
            }
        } else {
            redirect("cl_login/login?error=1");
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

    private function chk_login_data($email)
    {
        $data = [
            "shop_email" => $email
        ];
        $this->load->model("mdl_login");
        return $this->mdl_login->select_login_data($data);
    }

    private function chk_password($data)
    {
        $password = $this->input->post("password");
        return password_verify($password, $data["shop_password"]);
    }

    private function update_password($data)
    {
        $hash_pass = password_hash($data["password"], PASSWORD_DEFAULT);
        $data = [
            "shop_password" => $hash_pass
        ];
        return $this->mdl_login->update_password($data);
    }
}