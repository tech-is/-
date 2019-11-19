<?php
defined('BASEPATH') or exit('No direct script access allowed');

class staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('mdl_staff');
        $this->load->model('mdl_shift');
        $this->load->helper(['url', 'form']);
        $_SESSION['shop_id'] = 1;
    }

    public function index()
    {
        $column_array = ['staff_name' => 'title', 'shift_name' => 'start', 'shift_start' => 'start', 'shift_end' => 'end'];
        if($staffs = $this->mdl_staff->get_staff()) {
            foreach($staffs as $row => $staff) {
                foreach($staff as $column => $value) {
                    $data['staff'][$row][$column] = $value;
                }
            }
            $data['staff_json'] = $this->json_encode_array($data['staff']);
        } else {
            $data['staff_json'] = '{}';
        }
        if($shifts = $this->mdl_shift->get_shift_data()) {
            foreach($shifts as $row => $shift) {
                foreach($shift as $column => $value) {
                    if(array_key_exists($column, $column_array)) {
                        $data['shift'][$row][$column_array[$column]] = $value;
                    } else {
                        $data['shift'][$row][$column] = $value;
                    }
                }
            }
            $data['shift'] = $this->json_encode_array($data['shift']);
        } else {
            $data['shift'] = '{}';
        }

        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/staff/view_staff', $data);
    }

    /**
     * リクエストの正当性をチェック
     *
     * @param [str] $_SERVER['HTTP_X_CSRF_TOKEN'] && $_SESSION['token']
     */
    private function judge_request_param()
    {
        if(empty($_SERVER['HTTP_X_CSRF_TOKEN']) || $_SERVER['HTTP_X_CSRF_TOKEN'] !== $_SESSION['token']) {
            header('HTTP/1.1 403 Forbidden');
            exit();
        }
    }

    private function json_encode_array($array)
    {
        return !empty($array) && gettype($array) === 'array' ? json_encode($array): null;
    }

    public function register_staff()
    {
        $this->judge_request_param();
        if ($this->form_validation->run('staff')) {
            $data = [
                'staff_shop_id' => $_SESSION['shop_id'],
                'staff_name' => $this->input->post('staff_name'),
                'staff_tel' => $this->input->post('staff_tel'),
                'staff_mail' => $this->input->post('staff_email'),
                'staff_color' => $this->input->post('staff_color'),
                'staff_remarks' => $this->input->post('staff_remarks')
            ];
            $this->mdl_staff->insert_staff_data($data);
                echo 'success';
                exit;
        } else {
            echo 'vali_err';
            exit;
        }
    }

    public function update_staff()
    {
        $this->judge_request_param();
        if ($this->form_validation->run('staff')) {
            $id = [
                'staff_id' => $this->input->post('staff_id'),
                'staff_shop_id' => $_SESSION['shop_id']
            ];
            $data = [
                'staff_name' => $this->input->post('staff_name'),
                'staff_tel' => $this->input->post('staff_tel'),
                'staff_mail' => $this->input->post('staff_email'),
                'staff_color' => $this->input->post('staff_color'),
                'staff_remarks' => $this->input->post('staff_remarks')
            ];
            echo $this->mdl_staff->update_staff_data($id, $data)? 'success': 'error';
            exit;
        } else {
            echo 'vali_err';
            exit;
        }
    }

    public function delete_staff()
    {
        $this->judge_request_param('staff');
        $id = [
            'staff_id' => $this->input->post('staff_id'),
            'staff_shop_id' => $_SESSION['shop_id'],
        ];
        if($this->mdl_staff->delete_staff_data($id) === true) {
            echo 'success';
            exit;
        } else {
            echo 'dberror';
            exit;
        }
    }
}
