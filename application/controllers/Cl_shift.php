<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_shift extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper(["url", "form"]);
    }

    public function insert_shift()
    {
        $config = [
            [
                'field' => 'staff_id',
                'label' => 'スタッフID',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'start',
                'label' => '開始日時',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'end',
                'label' => '終了日時',
                'rules' => 'required|trim'
            ]
        ];
        $this->load->library("form_validation", $config);
        if($this->form_validation->run()) {
            $this->load->model("mdl_staff_shift");
            $data = [
                'shift_shop_id' => $_SESSION['shop_id'],
                'shift_staff_id' => $this->input->post("staff_id"),
                'shift_start' => $this->input->post("start"),
                'shift_end' => $this->input->post("end")
            ];
            if($this->mdl_staff_shift->insert_shift_data($data)) {
                echo "success!";
            } else {
                "登録に失敗しました。";
            }
        } else {
            echo "入力に間違いがあります";
        }
    }

    public function update_shift_data()
    {
        $config = [
            [
                'field' => 'shift_id',
                'label' => '名前',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'staff_id',
                'label' => '名前',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'shift_start',
                'label' => '開始日時',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'shift_end',
                'label' => '終了日時',
                'rules' => 'required|trim'
            ]
        ];
        $this->load->library("form_validation", $config);
        if($this->form_validation->run()) {
            $this->load->model("mdl_staff_shift");
            $id = [
                'shift_shop_id' => $_SESSION["shop_id"],
                'shift_id' => $this->input->post("shift_id")
            ];
            $data = [
                'shift_staff_id' => $this->input->post("staff_id"),
                'shift_start' => $this->input->post("shift_start"),
                'shift_end' => $this->input->post("shift_end")
            ];
            if($this->mdl_staff_shift->update_shift_data($id, $data)) {
                echo "success";
                exit;
            } else {
                echo "dberror";
                exit;
            }
        } else {
            echo "入力に間違いがあります";
        }
    }

    public function delete_shift_data()
    {
        $id = [
            "shift_id" => $this->input->post("shift_id"),
            "shift_shop_id" => 1,
            // "staff_shop_id" => $this->input->session("shop_id"),
        ];
        $this->load->model("mdl_staff_shift");
        if($this->mdl_staff_shift->delete_shift_data($id) == true) {
            echo "succsess!";
        } else {
            echo "false";
        }
    }
}