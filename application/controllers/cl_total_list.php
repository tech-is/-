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
        //GET.POST.インサート分の中身を確認。コンストラクタ内で利用する
        // $this->output->enable_profiler();
    }

    public function index()
    {       
        $data["customers"] = $this->c_get_customer();
        $data["pets"] = $this->c_get_pet();
        $data["staffes"] = $this->c_get_staff();
        $data["reserve"] = $this->c_get_reserve();
        //print_r($data);
        
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/vi_total_list', $data);
    }

    private function c_get_customer(){
       return $this->Mdl_total_list->m_get_customer();
    }

    public function c_get_pet(){
        return $this->Mdl_total_list->m_get_pet(); 
     }

     public function c_get_staff(){
        // return $this->Mdl_total_list->m_get_staff(); 
     }

     public function c_get_reserve(){
        // return $this->Mdl_total_list->m_get_reserve();
     }

}
