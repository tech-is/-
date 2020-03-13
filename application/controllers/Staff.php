<?php
defined('BASEPATH') or exit('No direct script access allowed');

class staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_staff');
        $this->load->model('mdl_shift');
        $this->load->library('form_validation');
        $this->load->helper(['url', 'form', 'ajax']);
        isset($_SESSION['shop_id'])?: header('location: https://www.animarl.com/login');
    }

    public function index()
    {
        $column_array = ['staff_name' => 'title', 'shift_name' => 'start', 'shift_start' => 'start', 'shift_end' => 'end', 'staff_color' => 'color'];
        if ($staffs = $this->mdl_staff->get_staff($_SESSION["shop_id"])) {
            foreach ($staffs as $row => $staff) {
                foreach ($staff as $column => $value) {
                    $data['staff'][$row][$column] = $value;
                }
            }
            $data['staff_json'] = is_array($data['staff'])? json_encode($data['staff']): '{}';
        } else {
            $data['staff_json'] = '{}';
        }
        if ($shifts = $this->mdl_shift->get_shift($_SESSION["shop_id"])) {
            foreach ($shifts as $row => $shift) {
                foreach ($shift as $column => $value) {
                    if (array_key_exists($column, $column_array)) {
                        $data['shift'][$row][$column_array[$column]] = $value;
                    } else {
                        $data['shift'][$row][$column] = $value;
                    }
                }
            }
            $data['shift'] = is_array($data['shift'])? json_encode($data['shift']): '{}';
        } else {
            $data['shift'] = '{}';
        }

        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/staff/view_staff', $data);
    }

    public function register_staff()
    {
        judge_httprequest();
        if ($this->form_validation->run('staff')) {
            $data = [
                'staff_shop_id' => $_SESSION['shop_id'],
                'staff_name' => $this->input->post('staffFamilyName'). ' '.$this->input->post('staffFirstName'),
                'staff_tel' => $this->input->post('staff_tel'),
                'staff_mail' => $this->input->post('staff_email'),
                'staff_color' => $this->input->post('staff_color'),
                'staff_remarks' => $this->input->post('staff_remarks')
            ];
            exit(json_encode(json_msg('staff', $this->mdl_staff->insert_staff($data), 0)));
        } else {
            exit(json_encode(['valierr' => $this->form_validation->error_array()]));
        }
    }

    public function update_staff()
    {
        judge_httprequest();
        if ($this->form_validation->run('staff')) {
            $id = [
                'staff_id' => @$this->input->post('staff_id')?: exit(json_encode(json_msg('staff', false), 1)),
                'staff_shop_id' => $_SESSION['shop_id']
            ];
            $data = [
                'staff_name' => $this->input->post('staffFamilyName'). ' '.$this->input->post('staffFirstName'),
                'staff_tel' => $this->input->post('staff_tel'),
                'staff_mail' => $this->input->post('staff_email'),
                'staff_color' => $this->input->post('staff_color'),
                'staff_remarks' => $this->input->post('staff_remarks')
            ];
            exit(json_encode(json_msg('staff', $this->mdl_staff->update_staff($id, $data), 1)));
        } else {
            exit(json_encode(['valierr' => $this->form_validation->error_array()]));
        }
    }

    public function delete_staff()
    {
        judge_httprequest();
        $id = [
            'staff_id' => @$this->input->post('staff_id')?: exit,
            'staff_shop_id' => $_SESSION['shop_id'],
        ];
        if ($this->mdl_staff->delete_staff($id) === true) {
            echo 'success';
            exit;
        } else {
            echo 'dberror';
            exit;
        }
    }
}
