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
		$data = [
			"template_name" => ["sample1", "sample2"],
			"from_name" => ["cipher", "galm"],
			"mail" => ["cipher_galm01@outlook.jp", "cipher_galm01@outlook.jp"],
			"mail_header_name" => ["忍者わんわん", "忍者あんあん"],
			"mail_subject" => ["システムテスト", "やっはろー！"],
			"mail_detail" => ["Hello World", "やばいですね！"]
		];
		$this->load->view('cms/pages/parts/header.html');
		$this->load->view('cms/pages/parts/sidebars.html');
		$this->load->view("cms/pages/magazine/view_magazine", $data);
	}

	public function magazine_form()
	{
		$this->load->view('cms/pages/parts/header.html');
		$this->load->view('cms/pages/parts/sidebars.html');
		$this->load->view("cms/pages/magazine/view_magazine_form.html");
	}

	public function load_customer_table()
	{
		$this->load->model("mdl");
	}
}
