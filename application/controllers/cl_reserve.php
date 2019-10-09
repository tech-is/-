<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_reserve extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
    }

    public function get_reserve_data()
    {
        $reserve_id = $this->input->post("reserve_id");
        $data = $this->get_reserve($reserve_id);
        echo $result;
    }

    public function register_reserve_data()
    {
        if($this->resereve_validation() == true) {
            if($this->insert_reserve() == true) {
                echo "success";
            } else {
                echo "dberr";
            }
        } else {
            echo "valierr";
        }
        exit;
    }

    public function update_reserve_data()
    {
        if($this->chk_reserve_data() == true) {
            if($this->update_reserve() == true) {
                return true;
            } else {
                return false;
            }
        }
        exit;
    }

    private function resereve_validation()
    {
        $config = [
            [
                'field' => 'reserve_pet_id',
                'label' => 'ペット名',
                'rules' => 'required'
            ],
            [
                'field' => 'reserve_start',
                'label' => '来店予定日',
                'rules' => 'required'
            ]
        ];
        $this->load->library("form_validation", $config);
        return $this->form_validation->run();
    }

    private function insert_reserve()
    {
        $this->load->model("mdl_reserve");
        $data = [
            'reserve_pet_id' => $this->input->post('reserve_pet_id'),
            'reserve_start' => $this->input->post('reserve_start'),
            'reserve_content' => $this->input->post('reserve_content')
        ];
        return $this->mdl_reserve->insert_reserve_data($data);
    }

    private function get_reserve($reserve_id)
    {
        $this->load->model("mdl_reserve");
        $result = $this->mdl_reserve->select_reserve_data($reserve_id);
        return $result;
    }

    private function update_reserve()
    {
        $this->load->model("mdl_reserve");
        isset($_POST["staff_id"]) == ""? $staff = null: $staff = $_POST["staff_id"];
        $data = [
            'reserve_customer' => $_POST["customer"],
            'reserve_pet' => $_POST["pet"],
            'reserve_start' => $_POST["start"],
            'reserve_end' => $_POST["end"],
            'reserve_content' => $_POST["content"],
            'reserve_staff_id' => $staff
        ];
        $result = $this->mdl_reserve->update_reserve_data($data);
        return $result;
    }

}