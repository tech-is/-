<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_login extends CI_Controller 
{

    /**
     * check_email
     * 
     * @param $_POST["email"]
     * @return 
     */
    public function check_email()
    {
        $email = $this->input->post("email");
        $config = [
            [
                'field' => 'email',
                'rules' => 'required'
            ]
        ];
        $this->load->library('form_validation', $config);
        if ($this->form_validation->run() == false) {
            $this->load->library('../controllers/cl_main');
            $this->cl_main->signup("sign-up");
        } else {
            $tmp = md5(uniqid(rand(), true));
            if($this->tmp_db_registration($email, $tmp) == true) {
                    echo "hoge";
                    exit;
                if($this->send_mail($email, $tmp) == true) {
                    //
                } else {
                    $this->del_email($email);
                }
            }
        }
    }

    /**
     * tmp_db_registration
     *
     * @param [str] $email
     * @return true | false
     */
    private function tmp_db_registration($email, $tmp)
    {   
        $this->load->model("mdl_members");
        $result = $this->sign_up_mail($email, $tmp);
        return $result;
    }

    /**
     * send_mail
     *
     * @return true | false
     */
    private function send_mail($email, $tmp)
    {
        $message = <<< EOM
        このメールは、配信専用のアドレスで配信されています。 
        このメールに返信されても、返信内容の確認およびご返答ができません。
        あらかじめご了承ください。
        電子メールアドレスのご登録ありがとうございます。
        電子メールアドレスを確認するには、次のリンクをクリックしてください。
        http://localhost/cl_logon?tmp={$tmp}
        このメールに覚えのない場合には、お手数ですがメールを破棄してくださいますようお願い致します。
        EOM;
        $config["mailtype"] = "text";
        $this->load->library("email", $config);
        $this->email->from("system_animarl@niji-desk.work", $mail);
        $this->email->to($mail);
        $this->email->set_newline("\r\n");
        $this->email->subject("会員本登録メール");
        $this->email->message($message);
        $this->email->send();
    }

}