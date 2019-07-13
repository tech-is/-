<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * class cl_main 
 * メールを扱う関数を主に置いています
 * メールホストを設定したい場合にはapplication/confing/email.phpを書き換えてください
 */

class Cl_main extends CI_Controller {

    public function hello()
    {
        echo "hello";
    }
    /**
     * send_mail_magazine
     * @param $magazine_id = マガジンテンプレートのインデックスid
     *        $data = DB内のマガジンテンプレートを配列で格納
     * @return メールを指定した顧客に送信
     */
    public function send_mail_magazine()
    {
        try {
            $config["mailtype"] = "text";
            $this->load->library("email", $condig);
            $magazine_id = $this->input->post("magazine_id");
            $this->load->model("mdl_cms");
            $data = $this->model->get_magazine_setting($magazine_id);
            /* $data[0]["mail"] = ユーザーのメールアドレス, $data[0]["mail_header_name"] = 差出人名 */
            $this->email->from($data[0]["mail"], $data[0]["mail_header_name"]);
            $this->email->subject($data[0]["mail_subject"]);
            $this->email->message($data[0]["mail_detail"]);
            foreach($data as $customer) {
                $this->email->to($customer);
                $this->email->send();
            }
        } catch(extension $e) {
            echo "メールの送信に失敗しました";
        }
    }

    public function send_dm_mail()
    {
        try {
            $config["mailtype"] = "text";
            $this->load->library("email", $condig);
            $data = $this->input->post();
            $this->email->from($data["mail"], $data["mail_header_name"]);
            $this->email->to('');
            $this->email->subject($data["mail_subject"]);
            $this->email->message($data["mail_detail"]);
        } catch(extension $e) {
            echo "メールの送信に失敗しました";
        }
    }

    public function send_mail_test()
    {
        echo "hello";
        exit;
        try {
            $data = $this->input->post("mail");
            $config["mailtype"] = "text";
            $this->load->library("email", $config);
            $magazine_id = $this->input->post("magazine_id");
            $this->load->model("mdl_cms");
            $data = $this->model->get_magazine_setting($magazine_id);
            /* $data[0]["mail"] = ユーザーのメールアドレス, $data[0]["mail_header_name"] = 差出人名 */
            $this->email->from($data["mail"], $data["mail_header_name"]);
            $this->email->subject($data["mail_subject"]);
            $this->email->message($data["mail_detail"]);
            foreach($data as $customer) {
                $this->email->to($customer);
                $this->email->send();
            }
        } catch(extension $e) {
            echo "メールの送信に失敗しました";
        }
    }

}