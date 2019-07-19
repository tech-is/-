<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_main extends CI_Controller {

	/**
	 * index
	 * 
	 * @return require('index.html')
	 */
	public function index()
	{
		// $this->load->view('index.html');
		$this->main();
	}

	/**
	 * cms
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
        $this->load->view('cms/sign-in');
    }

	public function signup()
	{
		$this->load->view('sign-up.html');
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
