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
        date_default_timezone_set('Asia/Tokyo');
        session_start();
        $_SESSION["shops_id"] = 1;
    }

    public function home()
    {
        $data = $this->get_reserve();
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/home/view_home', $data);
    }

    public function staff()
    {
        $this->load->model('mdl_staff');
        $this->load->model('mdl_staff_shift');
        $data['staff'] = $this->mdl_staff->get_staff_list();
        if($data['staff']) {
            foreach($data['staff'] as $row => $staff) {
                $data['select_staff'][$row]['staff_id'] = $staff['staff_id'];
                $data['select_staff'][$row]['staff_name'] = $staff['staff_name'];
            }
        }
        $shifts = $this->mdl_staff_shift->select_shift_data();
        if($shifts) {
            foreach($shifts as $row => $shift) {
                $data['shift'][$row]['staff_id'] = $shift['staff_id'];
                $data['shift'][$row]['shift_id'] = $shift['shift_id'];
                $data['shift'][$row]['title'] = $shift['staff_name'];
                $data['shift'][$row]['start'] = $shift['shift_start'];
                $data['shift'][$row]['end'] = $shift['shift_end'];
                $data['shift'][$row]['color'] = $shift['staff_color'];
            }
        } else {
            $data["shift"] = null;
        }
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/staff/view_staff_list', $data);
    }

    public function reserve()
    {
        $data = $this->get_reserve();
        $id = $this->input->get('id');
        $data["content"] = $this->mdl_reserve->get_reserve_data($id);
        $data['staffs'] = $this->get_staff_data();
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/reserve/view_reserve', $data);
    }

    public function reserve_view()
    {
        
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/reserve/view_reserve_content', $data);
    }

    public function reserve_new_form()
    {
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/reserve/view_new_reserve_form');
    }

    public function pet_table()
    {
        $this->load->view('view_pet.html');
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

    private function get_reserve()
    {
        $this->load->model('mdl_reserve');
        $reserves = $this->mdl_reserve->get_reserve_list();
        if($reserves) {
            foreach($reserves as $row => $reserve) {
                $data["events"][$row]["event_id"] = $reserve['event_id'];
                $data["events"][$row]["title"] = $reserve['event_customer'];
                $data["events"][$row]["start"] = $reserve['event_start'];
                $data["events"][$row]["end"] = $reserve['event_end'];
                $data["events"][$row]["color"] = $reserve['staff_color'];
                $data["events"][$row]["content"] = $reserve['event_content'];
            }
        } else {
            $data["events"] = null;
        }
        return $data;
    }

    private function get_staff_data()
    {
        $this->load->model('mdl_staff');
        return $this->mdl_staff->get_staff_data();
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
