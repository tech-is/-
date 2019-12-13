<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shift extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        !empty($_SESSION['shop_id'])?: exit;
        $this->load->model('Mdl_shift');
        $this->load->helper(['url', 'form', 'ajax']);
        $this->load->library('form_validation');
        judge_httprequest();
        header('Content-Type: application/json');
    }

    public function insert_shift()
    {
        $this->form_validation->run('shift')?: exit(json_encode(['valierr' => $this->form_validation->error_array()]));
        $data = [
            'shift_shop_id' => $_SESSION['shop_id'],
            'shift_staff_id' => $this->input->post('staff_id'),
            'shift_start' => $this->input->post('shift_start'),
            'shift_end' => $this->input->post('shift_end')
        ];
        exit(json_msg('shift', $this->Mdl_shift->insert_shift_data($data), 0));
    }

    public function update_shift()
    {
        $this->form_validation->run('shift')?: exit(json_encode(['valierr' => $this->form_validation->error_array()]));
        if (!empty($shift_id = $this->input->post('shift_id'))) {
            $id = [
                'shift_shop_id' => $_SESSION['shop_id'],
                'shift_id' => @$this->input->post('shift_id')
            ];
            $data = [
                'shift_staff_id' => $this->input->post('staff_id'),
                'shift_start' => $this->input->post('shift_start'),
                'shift_end' => $this->input->post('shift_end')
            ];
            exit(json_msg('shift', $this->Mdl_shift->update_shift_data($id, $data), 1));
        } else {
            exit(json_msg('shift', false, 1));
        }
    }

    public function delete_shift()
    {
        $id = [
            'shift_id' => $this->input->post('shift_id'),
            'shift_shop_id' =>  $_SESSION['shop_id']
        ];
        exit(json_msg('shift', $this->Mdl_shift->delete_shift_data($id), 2));
    }
}
