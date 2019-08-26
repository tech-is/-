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
        $this->load->helper(["url"]);
        // $this->load->model("mdl_members");
    }

    /**
     * index
     *
     * @return require('index.html')
     */
    public function index()
    {
        $this->load->view('index.html');
    }

    public function main()
    {
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/main/view_main');
    }

    public function reserve()
    {
        // $data["events"] = [
        //     [
        //         "event_id" => 1,
        //         "title" => 'トリミング',
        //         "start" => '2019-08-03T10:30',
        //         "end" => '2019-08-03T11:00',
        //         "color" => '#FF0000'
        //     ],
        //     [
        //         "event_id" => 2,
        //         "title" => 'シャンプー',
        //         "start" => '2019-08-20T10:30',
        //         "end" => '2019-08-20T12:30',
        //         "color" => '#9c27b0'
        //     ],
        //     [
        //         "event_id" => 3,
        //         "title" => 'トリミング',
        //         "start" => '2019-08-12T10:30',
        //         "end" => '2019-08-12T11:00',
        //         "color" => '#ffc107'
        //     ],
        //     [
        //         "title" => 'トリミング',
        //         "start" => '2019-08-12T12:30',
        //         "end" => '2019-08-12T13:30',
        //         "color" => 'blue'
        //     ],
        //     [
        //         "title" => 'カラー',
        //         "start" => '2019-08-16T15:30',
        //         "end" => '2019-08-16T16:30',
        //         "color" => 'green'
        //     ],
        //     [
        //         "title" => 'シャンプー',
        //         "start" => '2019-08-28T10:30',
        //         "end" => '2019-08-28T12:30',
        //         "color" => 'green'
        //     ],
        //     [
        //         "title" => 'シャンプー',
        //         "start" => '2019-08-07T10:30',
        //         "end" => '2019-08-07T12:30',
        //         "color" => '#9c27b0'
        //     ],
        //     [
        //         "title" => 'シャンプー',
        //         "start" => '2019-08-29T10:30',
        //         "end" => '2019-08-29T12:30',
        //         "color" => '#ffc107'
        //     ]
        // ];
        $this->load->model('mdl_reserve');
        $result = $this->mdl_reserve->get_reserve_list();
        for($i=0; $i <count($result); $i++) {
            $data["events"][$i]["event_id"] = $result[$i]['event_id'];
            $data["events"][$i]["title"] = $result[$i]['event_customer'];
            $data["events"][$i]["start"] = $result[$i]['event_start'];
            $data["events"][$i]["end"] = $result[$i]['event_end'];
            $data["events"][$i]["content"] = $result[$i]['event_content'];
        }
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/reserve/view_reserve', $data);
    }

    public function reserve_view()
    {
        $id = $this->input->get("id");
        $this->load->model('mdl_reserve');
        $data["content"] = $this->mdl_reserve->get_reserve_data($id);
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

    public function login()
    {
        $this->load->view('sign-in');
    }

    public function signup()
    {
        $this->load->view('sign-up');
    }

    public function forgot_password()
    {
        $this->load->view("forgot-password.html");
    }

    public function register()
    {
        $tmp = $this->input->get("code");
        if($tmp == null) {
            redirect("cl_main/login");
        } else {
            $this->load->model("mdl_members");
            $data = $this->mdl_members->check_tmp($tmp);
            if(!$data) {
                echo "dbにありませんす";
                exit;
            } else {
                $this->load->view("register", $data);
            }
        }
    }
    public function pet_table()
    {
        $this->load->view('view_pet.html');
    }

    public function magazine()
    {
        $data = [
            "template_name" => ["sample1", "sample2", "sample3"],
            "from_name" => ["cipher", "galm", "pixy"],
            "mail" => ["cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp"],
            "mail_subject" => ["システムテスト", "やっはろー！", "ヤバいですね！"],
            "mail_detail" => ["Hello World<br>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa", "やばいですね！", "yahoooooooooooooo"]
        ];
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view("cms/pages/magazine/view_magazine", $data);
    }

    public function magazine_send()
    {
        $data = [
            "template_name" => ["sample1", "sample2", "sample3"],
            "from_name" => ["cipher", "galm", "pixy"],
            "mail" => ["cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp"],
            "mail_subject" => ["システムテスト", "やっはろー！", "ヤバいですね！"],
            "mail_detail" => ["Hello World", "やばいですね！", "yahoooooooooooooo"],
            "name" => ["aaa", "bbb", "ccc", "ddd"]
        ];
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view("cms/pages/magazine/view_magazine_send", $data);
    }

    public function magazine_new_form()
    {
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view("cms/pages/magazine/view_new_magazine");
    }

    public function magazine_form()
    {
        $data = [
            "template_name" => ["sample1", "sample2", "sample3"],
            "mail_from_name" => ["cipher", "galm", "pixy"],
            "mail" => ["cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp"],
            "mail_subject" => ["システムテスト", "やっはろー！", "ヤバいですね！"],
            "mail_detail" => ["Hello World", "やばいですね！", "yahoooooooooooooo"],
            "name" => ["aaa", "bbb", "ccc", "ddd"]
        ];
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view("cms/pages/magazine/view_magazine_form", $data);
    }
}
