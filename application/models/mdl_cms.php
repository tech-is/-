<?php

class Mdl_cms extends CI_Model {

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
    }

    /**
     * get_customer_table
     * custmoerテーブルからデータを配列で取得
     * @return $query->result();
     */
    public function get_customer_table()
    {
        $query = $this->db->get("customer");
        return $query->result();
    }

    /**
     * get_pets_table
     * petsテーブルからデータを配列で取得
     * @return $query->result();
     */
    public function get_pets_table()
    {   
        $query = $this->load->get("pet");
        return $query->result();
    }
}