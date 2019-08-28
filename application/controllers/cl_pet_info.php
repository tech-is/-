<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cl_pet_info extends CI_Controller {

	/**
	 * Undocumented function
	 *
	 * @return
	 */
	public function index()
	{
		// $this->load->view('index.html');
		$this->cms();
	}

	public function cms()
	{
		$this->load->view('cms/pages/parts/header');
		$this->load->view('cms/pages/parts/sidebars.html');
		// $this->load->view('cms/main.html');
		// $this->load->view('cms/Customer_view.html');
		//顧客管理一覧
		// $this->load->view('cms/view_pet.html');
		//ペットカルテ
		$this->load->view('cms/pet_info_view.html');
	}

    public function login()
    {
        $this->load->view('cms/pages/login.html');
    }

	public function signup()
	{
		$this->load->view('signup');
	}
}
