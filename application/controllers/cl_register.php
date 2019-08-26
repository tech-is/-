<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_register extends CI_Controller {
    

    public function register_email()
    {
        if($this->check_email() == true) {
            $email = $this->input->post("email");
            $code = md5(uniqid(rand(), true));
            if($this->tmp_db_registration($email, $code) == true) {
                if($this->send_mail($email, $code) == true) {
                    // redirect("cl_main/login");
                    echo "登録完了しました！";
                } else {
                    $this->del_email($email);
                    redirect("/cl_main/login");
                }
            } else {
                redirect("cl_main/signup_db_error");
            }
        } else {
            $this->load->view('sign-up');
        }
    }
    /**
     * check_email
     *
     * @param $_POST["email"]
     * @return
     */
    private function check_email()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|valid_email',
            [
                "required" => "正しいメールアドレスを入力してください。",
                "valid_email" => "正しいメールアドレスを入力してください。"
            ]
        );
        return $this->form_validation->run();
    }

    /**
     * tmp_db_registration
     *
     * @param [str] $email
     * @return true || false
     */
    private function tmp_db_registration($email, $code)
    {
        $this->load->model("mdl_register");
        $result = $this->mdl_register->insert_mail($email, $code);
        return $result;
    }

    /**
     * del_email($email)
     * 
     * @param [str] $email
     * @return 登録した行を削除
     */
    private function delete_email($email)
    {
        $this->mdl_members->delete_email($email);
        return;
    }
    /**
     * send_mail
     *
     * @return true or false
     */
    private function send_mail($email, $code)
    {
        $message = "このメールは、配信専用のアドレスで配信されています。\n";
        $message .= "このメールに返信されても、返信内容の確認およびご返答ができません。\n";
        $message .= "あらかじめご了承ください。\n";
        $message .= "電子メールアドレスのご登録ありがとうございます。\n";
        $message .= "電子メールアドレスを確認するには、次のリンクをクリックしてください。\n";
        $message .= "http://localhost/cl_landing/register?code=".$code."\n";
        $message .= "このメールに覚えのない場合には、お手数ですがメールを破棄してくださいますようお願い致します。\n";
        $this->load->library("email");
        $this->email->from("system_animarl@niji-desk.work", "Animarlシステムメール");
        $this->email->to($email);
        $this->email->set_newline("\r\n");
        $this->email->subject("会員本登録メール");
        $this->email->message($message);
        if($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * db_registration
     *
     * @return dbに登録後ログインページに遷移
     */
    private function db_registration()
    {
        $config = [
            [
                'field' => 'name',
                'label' => 'ユーザ名',
                'rules' => 'required'
            ],
            [
                'field' => 'kana',
                'label' => 'フリガナ',
                'rules' => 'required'
            ],
            [
                'field' => 'zip_adderss',
                'label' => '住所',
                'rules' => 'required'
            ],
            [
                'field' => 'year',
                'label' => '生年月日',
                'rules' => 'required'
            ],
            [
                'field' => 'password',
                'label' => 'パスワード',
                'rules' => 'required'
            ]
        ];
        $this->load->library("form_validation", $config);
        if($this->form_validation->run() == false) {
            $this->load->view('sign-up.html');
        } else {
            $post = $this->input->post();
            $post["password"] = password_hash($post["password"], PASSWORD_DEFAULT);
            if($this->mdl_member->db_registration($post) == true) {
                redirect("/cl_main/login");
            } else {
                redirect("/cl_main/login");
                // 失敗ページ作成予定
            }
        }
    }
}