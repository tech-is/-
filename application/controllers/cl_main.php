<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * viewファイル専用コントローラー
 * viewファイルを主に扱うコントローラーです。
 * デフォルトコントローラーに設定されています。
*/
class Cl_main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        // date_default_timezone_set('Asia/Tokyo');
        session_start();
    }

    public function index()
    {
        $this->load->model('mdl_reserve');
        $columns = [
            'pet_name' => 'title',
            'reserve_start' => 'start',
            'reserve_end' => 'end'
        ];
        if(!empty($reserves = $this->mdl_reserve->get_reserve_list($_SESSION['shop_id']))) {
            foreach($reserves as $row => $reserve) {
                foreach($reserve as $column => $value) {
                    if(array_key_exists($column, $columns)) {
                        $data['reserve'][$row][$columns[$column]] = $value;
                    } else {
                        $data['reserve'][$row][$column] = $value;
                    }
                }
            }
        } else {
            $data['reserve'] = null;
        }
        $data['reserve'] = !empty($data['reserve'])? json_encode($data['reserve'], JSON_UNESCAPED_UNICODE): null;
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/home/view_home', $data);
    }

    // private function json_encode_array($array)
    // {
    //     return !empty($array)? json_encode($array, JSON_UNESCAPED_UNICODE): null;
    // }

    private function get_reserve($shop_id)
    {
        $columns = [
            'pet_name' => 'title',
            'reserve_start' => 'start',
            'reserve_end' => 'end'
        ];
        if(!empty($reserves = $this->mdl_reserve->get_reserve_list($shop_id))) {
            foreach($reserves as $row => $reserve) {
                foreach($reserve as $column => $value) {
                    if(array_key_exists($column, $columns)) {
                        $data[$row][$columns[$column]] = $value;
                    } else {
                        $data[$row][$column] = $value;
                    }
                }
            }
            !empty($data)? json_encode($array, JSON_UNESCAPED_UNICODE): null;
        } else {
            $data = null;
        }
        return $data;
    }

    public function magazine()
    {
        $data = $this->get_magazine();
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/magazine/view_magazine', $data);
    }

    public function magazine_send()
    {
        $data = [
            "from_name" => ["cipher", "galm", "pixy"],
            "mail" => ["cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp"],
            "mail_subject" => ["システムテスト", "やっはろー！", "ヤバいですね！"],
            "mail_detail" => ["Hello World", "やばいですね！", "yahoooooooooooooo"],
            "name" => ["aaa", "bbb", "ccc", "ddd"]
        ];
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/magazine/view_magazine_send', $data);
    }

    public function magazine_new_form()
    {
        $data = [
            "mail_from_name" => "cipher",
            "mail_adr" => "cipher_galm01@outlook.jp"
        ];
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/magazine/view_new_magazine', $data);
    }

    public function magazine_form()
    {
        $data = [
            "mail_from_name" => ["cipher", "galm", "pixy"],
            "mail" => ["cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp"],
            "mail_subject" => ["システムテスト", "やっはろー！", "ヤバいですね！"],
            "mail_detail" => ["Hello World", "やばいですね！", "yahoooooooooooooo"],
        ];
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/magazine/view_magazine_form', $data);
    }

    private function get_staff_data()
    {
        $this->load->model('mdl_staff');
        $result = $this->mdl_staff->get_staff_list();
        $result == true? $result: $result = null;
        return $result;
    }

    private function get_magazine()
    {
        $data = [
            "mail_subject" => ["システムテスト", "やっはろー！", "ヤバいですね！"],
            "from_name" => ["cipher", "galm", "pixy"],
            "mail" => ["cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp"],
            "mail_detail" => ["Hello World<br>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa", "やばいですね！", "yahoooooooooooooo"]
        ];
        $this->load->model('mdl_magazine');
        return $data;
    }
}
