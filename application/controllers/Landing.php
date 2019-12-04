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
     * ランディングページ出力
     *
     * @return void
     */
    public function index()
    {
        $this->load->view('view_landing');
    }
}
