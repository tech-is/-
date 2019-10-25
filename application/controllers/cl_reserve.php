<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_reserve extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper(["url", "form"]);
        $_SESSION["shop_id"] = 1;
    }

    public function index()
    {
        $data = [
            "total" => !empty($array = $this->get_total_list($_SESSION["shop_id"]))? $this->json_encode_array($array): null,
            "reserve" => !empty($array = $this->get_reserve($_SESSION["shop_id"]))? $this->json_encode_array($array): null
        ];
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/reserve/view_reserve', $data);
    }

    private function json_encode_array($array)
    {
        return !empty($array)? json_encode($array, JSON_UNESCAPED_UNICODE): null;
    }

    private function get_reserve($shop_id)
    {
        $columns = [
            "pet_name" => "title",
            "reserve_start" => "start",
            "reserve_end" => "end"
        ];
        $this->load->model('mdl_reserve');
        if(!empty($reserves = $this->mdl_reserve->get_reserve_list($shop_id))) {
            foreach($reserves as $row => $reserve) {
                foreach($reserve as $column => $value) {
                    if(array_key_exists($column, $columns)) {
                        $data[$row][$columns[$column]] = $value;
                    } else {
                        $data[$row][$column] = $value;
                    }
                    // if($column === "pet_name") {
                    //     $data[$row]["title"] = $value;
                    // } elseif($column ==="reserve_start") {
                    //     $data[$row]["start"] = $value;
                    // } elseif($column ==="reserve_end") {
                    //     $data[$row]["end"] = $value;
                    // } else {
                    //     $data[$row][$column] = $value;
                    // }
                }
            }
        } else {
            $data = null;
        }
        return $data;
    }

    private function get_total_list($shop_id)
    {
        $this->load->model('mdl_total_list');
        return $this->mdl_total_list->m_get_total_list($shop_id);
    }

    public function register_reserve_data()
    {
        if($this->resereve_validation()) {
            $this->load->model("mdl_reserve");
            $data = [
                'reserve_shop_id' => $_SESSION['shop_id'],
                'reserve_pet_id' => $this->input->post('reserve_pet_id'),
                'reserve_start' => $this->input->post('reserve_start'),
                'reserve_end' => $this->input->post('reserve_end'),
                'reserve_content' => $this->input->post('reserve_content')
            ];
            echo $this->mdl_reserve->insert_reserve_data($data)? "success": "dberr";
        } else {
            echo "valierr";
        }
        exit;
    }

    public function update_reserve_data()
    {
        if($this->resereve_validation()) {
            echo $this->update_reserve()? "success": "dberr";
        } else {
            echo "valierr";
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
            ],
            [
                'field' => 'reserve_end',
                'label' => '終了予定日',
                'rules' => 'required'
            ]
        ];
        $this->load->library("form_validation", $config);
        return $this->form_validation->run();
    }

    private function update_reserve()
    {
        $this->load->model("mdl_reserve");
        $data = [
            'reserve_customer' => $this->input->post("customer"),
            'reserve_pet' => $this->input->post("pet"),
            'reserve_start' => $this->input->post("start"),
            'reserve_end' => $this->input->post("end"),
            'reserve_content' => $this->input->post("content"),
            'reserve_staff_id' => @$this->input->post("staff_id")?: null
        ];
        return $this->mdl_reserve->update_reserve_data($data);
    }

}