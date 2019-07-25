<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_main extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url"]);
        $this->load->model("mdl_members");
    }
	
	/**
	 * index
	 *
	 * @return require('index.html')
	 */
	public function index()
	{
		$this->load->view('index.html');
		// $this->main();
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

    public function login()
    {
        $this->load->view('sign-in.html');
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
			redirect("index.php/cl_main/login");
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

	public function magazine()
	{
		// $this->load->model("mdl_cms");
		// $data = $this->get_magazine_setting();
		$data = [
			"template_name" => ["sample1", "sample2", "sample3"],
			"from_name" => ["cipher", "galm", "pixy"],
			"mail" => ["cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp"],
			"mail_subject" => ["システムテスト", "やっはろー！", "ヤバいですね！"],
			"mail_detail" => ["Hello World", "やばいですね！", "yahoooooooooooooo"]
		];
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
		$this->load->view("cms/pages/magazine/view_new_magazine.html");
	}

	public function magazine_form()
	{
		$this->load->view('cms/pages/parts/header.html');
		$this->load->view('cms/pages/parts/sidebars.html');
		$this->load->view("cms/pages/magazine/view_magazine_form.html");
	}

	public function load_customer_table()
	{
		$this->load->model("mdl_cms");
	}
}
