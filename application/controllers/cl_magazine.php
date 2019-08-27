<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * class cl_main
 * メールを扱う関数を主に置いています
 * メールホストを設定したい場合にはapplication/confing/email.phpを書き換えてください
 */

class Cl_magazine extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        session_start();
        // $_SESSION["shops_id"] = 1;
    }

    public function index()
    {
        $this->load->view('index.html');
    }

    public function registration_magazine()
    {
        if($this->chk_magazine_data()) {
            if($this->insert_magazine_data()) {
                
            } else {

            }
        } else {
            return false;
        }
    }

    private function chk_magazine_data()
    {
        $config = [
            [
                'field' => 'name',
                'label' => 'ユーザ名',
                'rules' => 'required'
            ],
            // [
            //     'field' => 'kana',
            //     'label' => 'フリガナ',
            //     'rules' => 'required'
            // ],
            // [
            //     'field' => 'zip_adderss',
            //     'label' => '住所',
            //     'rules' => 'required'
            // ],
            // [
            //     'field' => 'year',
            //     'label' => '生年月日',
            //     'rules' => 'required'
            // ],
            // [
            //     'field' => 'password',
            //     'label' => 'パスワード',
            //     'rules' => 'required'
            // ],
            // [
            //     'field' => 'passconf',
            //     'label' => 'パスワード確認',
            //     'rules' => 'required'
            // ]
        ];
        $this->load->library("form_validation", $config);
    }

    private function insert_magazine_data()
    {
        $post_data = $this->input->post(null, true);
        $data = [
            "mail_shop_id" => $_SESSION["shops_id"],
            "mail_from_name" => $_postdata["form_name"],
            "mail_shop_mail" => $_postdata["mail"],
            "mail_subject" => $_postdata["subject"],
            "mail_detail" => $_postdata["detail"]
        ];
        $this->load->model("mdl_magazine");
        return $this->mdl_magazine->insert_magazine($data);
    }

    private function update_magazine_data()
    {
        $post_data = $this->input->post(null, true);
        $data = [
            "mail_id" => $_postdata["id"],
            "mail_shop_mail" => $_postdata["mail"],
            "mail_from_name" => $_postdata["form_name"],
            "mail_subject" => $_postdata["subject"],
            "mail_detail" => $_postdata["detail"]
        ];
    }
}
