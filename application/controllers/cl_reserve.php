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
        $event_id = $this->input->post("event_id");
        $data = $this->get_reserve($event_id);
        echo $result;
    }

    public function register_reserve_data()
    {
        if($this->chk_reserve_data() == true) {
            if($this->insert_reserve() == true) {
                echo "success!";
            } else {
                echo "false...";
            }
        } else {
            echo "hoge";
            // redirect("cl_main/reserve_new_form");
        }
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
    }

    private function chk_reserve_data()
    {
        $config = [
            [
                'field' => 'customer_name',
                'label' => 'お客様名',
                'rules' => 'required'
            ],
            [
                'field' => 'customer_pet',
                'label' => 'ペット名',
                'rules' => 'required'
            ],
            [
                'field' => 'reserve_start',
                'label' => '開始日',
                'rules' => 'required'
            ],
            [
                'field' => 'reserve_end',
                'label' => '終了日',
                'rules' => 'required'
            ],
            [
                'field' => 'reserve_content',
                'label' => '内容',
                'rules' => 'required'
            ]
        ];
        $this->load->library("form_validation", $config);
        return $this->form_validation->run();
    }

    private function insert_reserve()
    {
        $this->load->model("mdl_reserve");
        isset($_POST['staff_id']) && $_POST['staff_id'] == ""? $staff = null: $staff = $this->input->post('staff_id');
        $data = [
            'event_customer' => $this->input->post('customer_name'),
            'event_pet' => $this->input->post('customer_pet'),
            'event_start' => $this->input->post('reserve_start'),
            'event_end' => $this->input->post('reserve_end'),
            'event_content' => $this->input->post('reserve_content'),
            'event_staff_id' => $staff
        ];
        return $this->mdl_reserve->insert_reserve_data($data);
    }

    private function get_reserve($event_id)
    {
        $this->load->model("mdl_reserve");
        $result = $this->mdl_reserve->select_reserve_data($event_id);
        return $result;
    }

    private function update_reserve()
    {
        $this->load->model("mdl_reserve");
        isset($_POST["staff_id"]) == ""? $staff = null: $staff = $_POST["staff_id"];
        $data = [
            'event_customer' => $_POST["customer"],
            'event_pet' => $_POST["pet"],
            'event_start' => $_POST["start"],
            'event_end' => $_POST["end"],
            'event_content' => $_POST["content"],
            'event_staff_id' => $staff
        ];
        $result = $this->mdl_reserve->update_reserve_data($data);
        return $result;
    }

}