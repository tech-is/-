<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_total_list extends CI_Model {

  public function __construct()
  {
      // CI_Model constructor の呼び出し
      parent::__construct();
      $this->load->database();
  }

  //画面表示分カスタマーのセレクトの分をとってくる
  public function m_get_total_list($shop_id){
    //print_r($_SESSION);
        $where = ['customer_state ' => 1, 'customer_shop_id '=> $shop_id]; 
        $this->db->where($where);
        $this->db->select("customer_name , pet_name , customer_tel , customer_mail");
        $this->db->from('customer');
        $this->db->join('pet', 'customer_id = pet_customer_id', 'left');
        $query = $this->db->get();
        return $query->result_array(); //結果を配列で返す。
  }

  //新規登録のペットと顧客をここで登録
  public function m_insert_total_list($customer_data, $pet_data)
  {
    $this->db->trans_start();
    $this->db->insert('customer', $customer_data);
    //insert_idを取得して今↑で登録されたお客さんの新規顧客IDを取得する
    //https://codeigniter.jp/user_guide/3/database/helpers.html
    //$pet_data に上のIDを追加する
    $id = $this->db->insert_id();
    $pet_data['pet_customer_id'] = $id;
    $this->db->insert('pet',$pet_data);
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
        return false;
    } else {
      $this->db->trans_commit();
        return true;
    }
  }





}