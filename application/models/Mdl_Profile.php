<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * タイトル：顧客・ペット管理
 * 説明    ：顧客・ペットの登録・変更・削除を行う
 *
 * 著作権  ：Copyright(c) 2019 TECH I.S
 * 会社名  ：TECH I.S
 *
 * 変更履歴：2019.8 開発
 */

class Mdl_Profile extends CI_Model
{
    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
        $this->load->database();
    }

    /**
     * プロフィールデータを取ってくる
     *
     * @param [int] $shop_id
     * @return boolian
     */
    public function update_shops($data)
    {
        $this->db->set($data['update']);
        $this->db->where($data['where']);
        return $this->db->update('shops');
    }

    /**
     * プロフィールデータを取ってくる
     *
     * @param [int] $shop_id
     * @return array || boolian
     */
    public function m_Profile_get($shop_id)
    {
        $where = ['shop_state' => 1,'shop_id'=>$shop_id];
        $this->db->where($where);
        $this->db->select('*');
        $this->db->from('shops');
        $query = $this->db->get();
        // SQL文を教えてくれる
        // echo $this->db->last_query();
        // exit;
        return $query->row_array(); //結果を配列で返す。
    }

    

    //待ち受けカルテからここで本登録登録
    public function main_insert_karute($data)
    {
        $this->db->set($data['update']);
        $this->db->where($data['where']);
        return $this->db->update('karute');
        // $this->db->last_query();
        // exit;
    }

    //更新処理
    // public function m_update_total_list($id, $customer_data, $pet_data)
    // {
    //     $this->db->trans_start();
    //     $this->db->set($customer_data);
    //     $this->db->where(['customer_id'=> $id['customer_id']]);
    //     $this->db->update('customer');
    //     $this->db->set($pet_data);
    //     $this->db->where(['pet_id'=> $id['pet_id']]);
    //     $this->db->update('pet');
    //     $this->db->trans_complete();
    //     if ($this->db->trans_status() === FALSE) {
    //     $this->db->trans_rollback();
    //         return false;
    //     } else {
    //     $this->db->trans_commit();
    //         return true;
    //     }
    // }
}
