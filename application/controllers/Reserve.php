<?php
defined('BASEPATH') or exit('No direct script access allowed');

class reserve extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form', 'ajax']);
        $this->load->model('mdl_reserve');
        $this->load->model('mdl_total_list');
        $this->load->library('form_validation');
        isset($_SESSION['shop_id'])?: header('location: //animarl.com/login');
    }

    public function index()
    {
        $columns = [
            'pet_name' => 'title',
            'reserve_start' => 'start',
            'reserve_end' => 'end',
            'reserve_color' => 'color'
        ];
        if (!empty($reserves = $this->mdl_reserve->get_reserve($_SESSION['shop_id']))) {
            foreach ($reserves as $row => $reserve) {
                foreach ($reserve as $column => $value) {
                    if (array_key_exists($column, $columns)) {
                        $reserves[$row][$columns[$column]] = $value;
                    } else {
                        $reserves[$row][$column] = $value;
                    }
                }
            }
            $data['reserve'] = json_encode($reserves);
        } else {
            $data['reserve'] = '{}';
        }
        $array = $this->mdl_total_list->get_total_data($_SESSION['shop_id']);
        $data['total'] = !empty($array)? json_encode($array): '{}';
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/reserve/view_reserve', $data);
    }

    public function get_reserve_via_ajax()
    {
        judge_httprequest();
        $columns = [
            'pet_name' => 'title',
            'reserve_start' => 'start',
            'reserve_end' => 'end',
            'reserve_color' => 'color'
        ];
        if (!empty($reserves = $this->mdl_reserve->get_reserve($_SESSION['shop_id']))) {
            foreach ($reserves as $row => $reserve) {
                foreach ($reserve as $column => $value) {
                    if (array_key_exists($column, $columns)) {
                        $reserves[$row][$columns[$column]] = $value;
                    } else {
                        $reserves[$row][$column] = $value;
                    }
                }
            }
            $data['reserve'] = json_encode($reserves);
        } else {
            $data['reserve'] = '{error: {title: "カレンダーの取得に失敗しました", msg: "しばらくたってからまたお試しください"}';
        }
        header('Content-Type: application/json; charaset=utf-8');
        exit($data);
    }

    private function reserve_column()
    {
        $columns = ['reserve_pet_id', 'reserve_start', 'reserve_end', 'reserve_content', 'reserve_color'];
        foreach ($columns as $column) {
            if ($column === 'reserve_start') {
                $data[$column] = $this->input->post('reserve_start').'T'.$this->input->post('reserve_time');
            } elseif($column === 'reserve_end') {
                $data[$column] = $this->input->post('reserve_end').'T'.$this->input->post('_reserve_time');
            } else {
                $data[$column] = $this->input->post($column);
            }
        }
        return $data;
    }

    public function register_reserve()
    {
        header('Content-Type: application/json; charaset=utf-8');
        judge_httprequest();
        $this->form_validation->run('reserve')?: exit(json_encode(['valierr' => $this->form_validation->error_array()]));
        $this->judge_time();
        $data = $this->reserve_column();
        $data['reserve_shop_id'] = $_SESSION['shop_id'];
        exit(json_encode(json_msg('reserve', $this->mdl_reserve->insert_reserve($data), 0)));
    }

    public function update_reserve()
    {
        header('Content-Type: application/json; charaset=utf-8');
        judge_httprequest();
        $this->form_validation->run('reserve')?: exit(json_encode(['valierr' => $this->form_validation->error_array()]));
        $this->judge_time();
        $data = [
            'where' => [
                'reserve_shop_id' => $_SESSION['shop_id'],
                'reserve_id' => @$this->input->post('reserve_id')?: exit(json_encode(json_msg('reserve', false, 1)))
            ],
            'update' => $this->reserve_column()
        ];
        exit(json_encode(json_msg('reserve', $this->mdl_reserve->update_reserve($data), 1)));
    }

    public function delete_reserve()
    {
        header('Content-Type: application/json; charaset=utf-8');
        judge_httprequest();
        !empty($this->input->post('reserve_id'))?:exit(json_encode(json_msg('reserve',false, 2)));
        $id = [
            'reserve_shop_id' => $_SESSION['shop_id'],
            'reserve_id' => $this->input->post('reserve_id')
        ];
        exit(json_encode(json_msg('reserve', $this->mdl_reserve->delete_reserve($id), 2)));
    }

    private function judge_time()
    {
        $start = strtotime($this->input->post('reserve_start') .' '. $this->input->post('reserve_time'));
        $end = strtotime($this->input->post('reserve_end') .' '. $this->input->post('_reserve_time'));
        if($start >= $end) {
            exit(json_encode([
                    'valierr' => [
                        'reserve_end' => '開始日時より低い時間を設定してください',
                        '_reserve_time' => '開始日時より低い時間を設定してください'
                    ]
                ]
            ));
        }
    }
}
