<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cl_total_list extends CI_Controller {

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
        $this->load->view('cms/vi_total_list.html');
    }

}
