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
        $this->load->view('index.html');
	}

	/**
	 * cms
	 *
	 * @return require('cms/main.html')
	 */
	public function cms()
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

	public function load_customer_table()
	{
		$this->load->model("mdl");
	}
}
