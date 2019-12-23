<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shift extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        !empty($_SESSION['shop_id'])?: exit;
        $this->load->model('mdl_shift');
        $this->load->helper(['url', 'form', 'ajax']);
        $this->load->library('form_validation');
        judge_httprequest();
        header('Content-Type: application/json; charaset=utf-8');
    }

    public function register_shift()
    {
        $this->form_validation->run('shift')?: exit(json_encode(['valierr' => $this->form_validation->error_array()]));
        $this->judge_time();
        $data = [
            'shift_shop_id' => $_SESSION['shop_id'],
            'shift_staff_id' => $this->input->post('staff'),
            'shift_start' => $this->input->post('shift_start') .'T'. $this->input->post('shift_time'),
            'shift_end' => $this->input->post('shift_end') .'T'. $this->input->post('_shift_time'),
        ];
        exit((json_encode(json_msg('shift', $this->mdl_shift->insert_shift($data), 0))));
    }

    public function get_shift_via_ajax()
    {
        judge_httprequest();
        $columns = ['staff_name' => 'title', 'shift_name' => 'start', 'shift_start' => 'start', 'shift_end' => 'end', 'staff_color' => 'color'];
        if (!empty($shifts = $this->mdl_shift->get_shift($_SESSION['shop_id']))) {
            foreach ($shifts as $row => $shift) {
                foreach ($shift as $column => $value) {
                    if (array_key_exists($column, $columns)) {
                        $data[$row][$columns[$column]] = $value;
                    } else {
                        $data[$row][$column] = $value;
                    }
                }
            }
        } else {
            $data = [
                'error' => [
                    'title' => 'カレンダーの取得に失敗しました',
                    'msg' => 'しばらくたってからまたお試しください'
                ]
            ];
        }
        header('Content-Type: application/json; charaset=utf-8');
        exit(json_encode($data));
    }

    public function update_shift()
    {
        $this->form_validation->run('shift')?: exit(json_encode(['valierr' => $this->form_validation->error_array()]));
        $this->judge_time();
        if (!empty($shift_id = $this->input->post('shift_id'))) {
            $id = [
                'shift_shop_id' => $_SESSION['shop_id'],
                'shift_id' => @$this->input->post('shift_id')
            ];
            $data = [
                'shift_staff_id' => $this->input->post('staff'),
                'shift_start' => $this->input->post('shift_start') .'T'. $this->input->post('shift_time'),
                'shift_end' => $this->input->post('shift_end') .'T'. $this->input->post('_shift_time')
            ];
            exit(json_encode(json_msg('shift', $this->mdl_shift->update_shift($id, $data), 1)));
        } else {
            exit(json_encode(json_msg('shift', false, 1)));
        }
    }

    public function delete_shift()
    {
        $id = [
            'shift_id' => $this->input->post('shift_id'),
            'shift_shop_id' =>  $_SESSION['shop_id']
        ];
        exit(json_encode(json_msg('shift', $this->mdl_shift->delete_shift($id), 2)));
    }

    private function judge_time()
    {
        $start = strtotime($this->input->post('shift_start') .' '. $this->input->post('shift_time'));
        $end = strtotime($this->input->post('shift_end') .' '. $this->input->post('_shift_time'));
        if($start >= $end) {
            exit(json_encode([
                    'valierr' => [
                        'shift_start' => '開始日時より低い時間を設定してください',
                        'shift_end' => '開始日時より低い時間を設定してください',
                        'shift_time' => '開始日時より低い時間を設定してください',
                        '_shift_time' => '開始日時より低い時間を設定してください'
                    ]
                ]
            ));
        }
    }
}
