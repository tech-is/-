<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_total_list extends CI_Model {

  public function __construct()
  {
      // CI_Model constructor の呼び出し
      parent::__construct();
      $this->load->database();
  }

  //カスタマーのセレクトの分をとってくる
  public function m_get_customer(){
    //print_r($_SESSION);
        $where = ['customer_state ' => 1];
        //        $where = ['customer_state ' => 1, 'customer_shop_id '=>   ];
        $this->db->where($where);
        $this->db->select("customer_id , customer_name , customer_address , customer_tel , customer_mail ");
        $this->db->from('customer');
        $query = $this->db->get();
        return $query->result_array(); //結果を配列で返す。
  }

//ペット名をとってくる
  public function m_get_pet(){
    $where = ['pet_state ' => 1];
    $this->db->where($where);
    $this->db->select('pet_name');
    $this->db->from('pet');
    $query = $this->db->get();
    return $query->result_array();
  }

//担当スタッフをとってくる
  public function m_get_staff(){
    $where = ['staff_state ' => 1];
    $this->db->where($where);
    $this->db->select('staff_name');
    $this->db->from('staff');
    $query = $this->db->get();
    return $query->result_array();
  }

  //最終予約日をとってくる
  public function m_get_reserve(){
    $where = ['event_state ' => 1];
    $this->db->where($where);
    $this->db->select('event_start');
    $this->db->from('calender_event');
    $query = $this->db->get();
    return $query->result_array();
  }





}



