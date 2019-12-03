<?php
defined('BASEPATH') or exit('No direct script access allowed');

class landing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
    }

    /**
     * index
     *
     * @return require('index.html')
     */
    public function index()
    {
        $this->load->view('view_landing');
    }
}
