<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_main extends CI_Controller {

	/**
	 * Undocumented function
	 *
	 * @return 
	 */
	public function index()
	{
        $this->load->view('index.html');
	}

	public function cms()
	{
		$this->load->view('cms/pages/parts/header.html');
		$this->load->view('cms/pages/parts/sidebars.html');
		$this->load->view('cms/main.html');
	}

    public function login()
    {
        $this->load->view('cms/pages/login.html');
    }

	public function signup()
	{
		$this->load->view('signup');
	}
	public function pet_table()
	{
		$this->load->view('view_pet.html');
	}


	public function load_customer_table()
	{
		$this->load->model("mdl");
	}
}
