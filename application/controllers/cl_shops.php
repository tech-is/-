<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_shops extends CI_Controller
{
    
    public function register_shop()
    {
        // if($this->check_shop_data() == true) {
        if($this->check_shop_data()) {
            $data = $this->input->post(null, true);
            echo $this->shop_registration($data)?"登録が完了しました": "登録失敗しました";
            // if($this->shop_registration($data) == true) {
            //     echo "登録が完了しました";
            // } else {
            //     echo "登録失敗しました";
            // }
        } else {
            // return false;
            echo "入力したデータが不正です。";
            exit;
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

    private function check_shop_data()
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
                'field' => 'email',
                'label' => 'メールアドレス',
                'rules' => 'required'
            ],
            [
                'field' => 'tel',
                'label' => '電話番号',
                'rules' => 'required'
            ],
            [
                'field' => 'zip_code',
                'label' => '郵便番号',
                'rules' => 'required'
            ],
            [
                'field' => 'zip_address',
                'label' => '住所',
                'rules' => 'required'
            ],
            [
                'field' => 'password',
                'label' => 'パスワード',
                'rules' => 'required'
            ]
        ];
        $this->load->library("form_validation", $config);
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
        $data = [
            'tmp_shop_email' => $email,
            'tmp_shop_code' => $code
        ];
        $this->load->model("mdl_shops");
        $result = $this->mdl_shops->insert_mail($data);
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
        $message = <<< EOM
            "このメールは配信専用のアドレスで配信されています。\n
            このメールに返信されても、返信内容の確認及び
            ご返答ができません。\n
            あらかじめご了承ください。\n
            電子メールアドレスのご登録ありがとうございます。\n
            電子メールアドレスを確認するには、次のリンクをクリックしてください。\n
            http://localhost/cl_login/register?code={$code}\n
            このメールに覚えのない場合には、お手数ですがメールを破棄してくださいますようお願い致します。\n
        EOM;
        $this->load->library("email");
        $this->email->from("system_animarl@niji-desk.work", "Animarlシステムメール");
        $this->email->to($email);
        $this->email->set_newline("\r\n");
        $this->email->subject("会員本登録メール");
        $this->email->message($message);
        // if($this->email->send()) {
        //     return true;
        // } else {
        //     return false;
        // }
        return $this->email->send();
    }

    /**
     * db_registration
     *
     * @return dbに登録後ログインページに遷移
     */
    private function shop_registration($data)
    {
        $hash_pass = password_hash($data["password"], PASSWORD_DEFAULT);
        $this->load->model("mdl_shops");
        $data = [
            "shop_name" => $data["name"],
            "shop_kana" => $data["kana"],
            "shop_tel" => $data["tel"],
            "shop_email" => $data["email"],
            "shop_zip_code" => $data["zip_code"],
            "shop_address" => $data["zip_address"],
            "shop_password" => $hash_pass,
        ];
        return $this->mdl_shops->insert_shops($data);
    }
}