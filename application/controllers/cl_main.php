<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        $this->load->model("mdl_members");
    }

    /**
     * index
     *
     * @return require('index.html')
     */
    public function index()
    {
        $this->load->view('landing.html');
    }

    /**
     * main
     *
     * @return require('cms/main.html')
     */
    public function main()
    {
        $this->load->view('cms/pages/parts/header.html');
        $this->load->view('cms/pages/parts/sidebars.html');
        $this->load->view('cms/main.html');
    }

    public function reserve()
    {
        $this->load->view('cms/pages/parts/header.html');
        $this->load->view('cms/pages/parts/sidebars.html');
        $this->load->view('cms/reserve');
    }

    public function login()
    {
        $this->load->view('sign-in');
    }

    public function signup()
    {
        $this->load->view('sign-up');
    }

    public function signup_db_error()
    {
        $data["error"] = '<div class="msg" style="color: red">データベースに登録できませんでした<br>しばらく時間をおいて登録してください</div>';
        $this->load->view('sign-up' ,$data);
    }

    public function forgot_password()
    {
        $this->load->view("forgot-password.html");
    }

    public function register()
    {
        $code = $this->input->get("code");
        if($code == null) {
            redirect("index.php/cl_main/login");
        } else {
            $this->load->model("mdl_members");
            $data = $this->mdl_members->check_code($code);
            if(!$data) {
                echo "dbにありませんす";
                exit;
            } else {
                $this->load->view("register", $data);
            }
        }
    }

    public function magazine()
    {
        $data = "";
        // $data = [
        //     "template_name" => ["sample1", "sample2", "sample3"],
        //     "from_name" => ["cipher", "galm", "pixy"],
        //     "mail" => ["cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp"],
        //     "mail_subject" => ["システムテスト", "やっはろー！", "ヤバいですね！"],
        //     "mail_detail" => ["Hello World<br>aaa", "やばいですね！", "yahoooooooooooooo"]
        // ];
        $this->load->view('cms/pages/parts/header.html');
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
        $this->load->view('cms/pages/parts/header.html');
        $this->load->view('cms/pages/parts/sidebars.html');
        $this->load->view("cms/pages/magazine/view_magazine_send", $data);
    }

    public function magazine_new_form()
    {
        $this->load->view('cms/pages/parts/header.html');
        $this->load->view('cms/pages/parts/sidebars.html');
        $this->load->view("cms/pages/magazine/view_new_magazine");
    }

    public function magazine_form()
    {
        $data = [
            "template_name" => ["sample1", "sample2", "sample3"],
            "from_name" => ["cipher", "galm", "pixy"],
            "mail" => ["cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp"],
            "mail_subject" => ["システムテスト", "やっはろー！", "ヤバいですね！"],
            "mail_detail" => ["Hello World\r\naaa", "やばいですね！", "yahoooooooooooooo"]
        ];
        $this->load->view('cms/pages/parts/header.html');
        $this->load->view('cms/pages/parts/sidebars.html');
        $this->load->view("cms/pages/magazine/view_magazine_form", $data);
    }

    public function load_customer_table()
    {
        $this->load->model("mdl_cms");
    }
}
