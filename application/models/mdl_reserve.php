<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_reserve extends CI_Model
{

    public function get_reserve_list($shop_id)
    {
        $this->db->where(['reserve_shop_id' => $shop_id, 'reserve_state' => 1]);
        $this->db->select("reserve_id, reserve_start, reserve_end, reserve_content, pet_name, staff_id, staff_name");
        $this->db->from('reserve');
        $this->db->join('pet', 'pet_id = reserve_pet_id', 'left');
        $this->db->join('staff', 'staff_id = reserve_staff_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_reserve_data($data)
    {
        return $this->db->insert('reserve', $data);
    }

    public function select_reserve_data($reserve_id)
    {
        $this->db->where(['reserve_id' => $reserve_id]);
        $this->db->select("reserve_id, reserve_pet, reserve_start, reserve_end, reserve_content");
        $query = $this->db->get('reserve');
        return $query->result_array();
    }

    public function update_reserve_data($data)
    {
        $upt_data = [
            'reserve_pet' => $data['reserve_pet'],
            'reserve_start' => $data['reserve_start'],
            'reserve_end' => $data['reserve_end'],
            'reserve_content' => $data['reserve_content'],
            'reserve_staff_id' => $data['reserve_staff']
        ];
        $this->db->set($upt_data);
        $this->db->where('reserve_id', $data['reserve_id']);
        $query = $this->db->update('reserve');
        return $query;
    }

}