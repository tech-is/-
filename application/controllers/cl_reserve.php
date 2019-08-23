<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_reserve extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
    }

    public function reserve_view()
    {
        $id = $this->$input->get("reserve_id");
    }

    public function register_reserve_data()
    {
        if($this->chk_reserve_data() == true) {
            // $data = $this->input->post();
            if($this->insert_reserve() == true){
                redirect("cl_main/reserve");
            } else {
                redirect("cl_main/reserve_new_form");
            }
        } else {
            echo "hoge";
            // redirect("cl_main/reserve_new_form");
        }
    }

    private function chk_reserve_data()
    {
        $config = [
            [
                'field' => 'customer',
                'label' => 'お客様名',
                'rules' => 'required'
            ],
            // [
            //     'field' => 'start',
            //     'label' => '開始日',
            //     'rules' => 'required'
            // ],
            // [
            //     'field' => 'end',
            //     'field' => '終了日',
            //     'rules' => 'required'
            // ],
            // [
            //     'field' => 'content',
            //     'label' => '内容',
            //     'rules' => 'required'
            // ]
        ];
        $this->load->library("form_validation", $config);
        return $this->form_validation->run();
    }

    private function insert_reserve()
    {
        $this->load->model("mdl_reserve");
        $result = $this->mdl_reserve->insert_reserve_data();
        return $result;
    }
}