<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

    public function reserve()
    {
        $data["events"] = [
            [
                "title" => '田中太郎',
                "start" => '2019-06-12T10:30',
                "end" => '2019-06-12T12:30',
                "url" => 'reserve_view?id=1'
            ],
        ];
        // $this->load->model('mdl_reserve');
        // $result = $this->mdl_reserve->get_reserve_data();
        // for($i=0; $i <count($result); $i++) {
        //     $data["events"][$i]["title"] = $result[$i]['event_customer'];
        //     $data["events"][$i]["start"] = $result[$i]['event_start'];
        //     $data["events"][$i]["end"] = $result[$i]['event_end'];
        //     // $data["events"][$i]['staff_id'] = $result[$i]['event_staff_id'];
        // }
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebars.html');
        $this->load->view('cms/pages/reserve/view_reserve', $data);
    }

    public function reserve_new_form()
    {
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebars.html');
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
        $this->load->view('cms/pages/parts/sidebars.html');
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
        $this->load->view('cms/pages/parts/sidebars.html');
        $this->load->view("cms/pages/magazine/view_magazine_send", $data);
    }

    public function magazine_new_form()
    {
        $this->load->view('cms/pages/parts/header.html');
        $this->load->view('cms/pages/parts/sidebars.html');
        $this->load->view("cms/pages/magazine/view_new_magazine.html");
    }

    public function magazine_form()
    {
        $this->load->view('cms/pages/parts/header.html');
        $this->load->view('cms/pages/parts/sidebars.html');
        $this->load->view("cms/pages/magazine/view_magazine_form.html");
    }
}
