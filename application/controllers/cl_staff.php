<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_staff extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
    }

    public function register_staff()
    {
        if($this->check_staff_data() == true) {
            if($this->insert_staff() == true) {
                echo "success!";
            } else {
                echo "false…";
            }
        } else {
            echo "hoge";
        }
    }

    public function update_staff_list()
    {
        if($this->check_staff_data() == true) {
            $result = $this->update_staff();
            if($result == true) {
                echo "success!";
            } else {
                echo "false…";
            }
        } else {
            echo "hoge";
        }
    }

    /**
     * check_user
     * 
     * @param $_POST["email"] = ポストされたメールアドレス
     * @return メインページにリダイレクト
     */
    public function check_staff_data()
    {
        $config = [
            [
                'field' => 'staff_name',
                'label' => '名前',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'staff_tel',
                'label' => '電話',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'staff_email',
                'label' => 'メールアドレス',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'staff_color',
                'label' => 'カラーラベル',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'staff_remarks',
                'label' => '備考',
                'rules' => 'trim'
            ]
        ];
        $this->load->library("form_validation", $config);
        return $this->form_validation->run();
    }

    private function insert_staff()
    {
        $data = [
            // "staff_shop_id" => $this->input->session("shop_id"),
            "staff_shop_id" => 1,
            "staff_name" => $this->input->post("staff_name"),
            "staff_tel" => $this->input->post("staff_tel"),
            "staff_mail" => $this->input->post("staff_email"),
            "staff_color" => $this->input->post("staff_color"),
            "staff_remarks" => $this->input->post("staff_remarks")
        ];
        $this->load->model("mdl_staff");
        return $this->mdl_staff->insert_staff_data($data);
    }

    private function update_staff()
    {
        $id = [
            "staff_id" => $this->input->post("staff_id"),
            "staff_shop_id" => 1,
        ];
        $data = [
            "staff_name" => $this->input->post("staff_name"),
            "staff_tel" => $this->input->post("staff_tel"),
            "staff_mail" => $this->input->post("staff_email"),
            "staff_color" => $this->input->post("staff_color"),
            "staff_remarks" => $this->input->post("staff_remarks")
        ];
        $this->load->model("mdl_staff");
        return $this->mdl_staff->update_staff_data($id, $data);
    }

    public function delete_staff()
    {
        $id = [
            "staff_id" => $this->input->post("staff_id"),
            "staff_shop_id" => 1,
            // "staff_shop_id" => $this->input->session("shop_id"),
        ];
        $this->load->model("mdl_staff");
        if($this->mdl_staff->delete_staff_data($id) == true) {
            echo "succsess!";
        } else {
            echo "false";
        }
    }

    public function insert_shift()
    {
        //
    }

    public function update_shift()
    {
        //
    }

    public function delete_shift()
    {
        //
    }

}