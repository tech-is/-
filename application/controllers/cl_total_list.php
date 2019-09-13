<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cl_total_list extends CI_Controller {

    /**
     * Undocumented function
     *
     * @return 
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        $this->load->model('Mdl_total_list');
        //GET.POST.インサート分の中身を確認。コンストラクタ内で利用するie
        // $this->output->enable_profiler();
    }

    public function index()
    {       
        $data["list"] = $this->get_total_list();
        //print_r($data);
        
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/vi_total_list', $data);
    }

    private function get_total_list(){
       return $this->Mdl_total_list->m_get_total_list();
    }

}
