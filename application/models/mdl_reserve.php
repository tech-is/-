<?php

class Mdl_reserve extends CI_Model
{

    public function get_reserve_data($id)
    {
        $this->db->where(["reserve_id" => $id]);
        $this->db->select('reserve_content, reserve_start, reserve_end');
        $query = $this->db->get('reserve');
        return $query->result_array();
    }

    public function get_reserve_list()
    {
        // $this->db->where('reserve', ['shop_id' => $_SESSION["shop_id"]]);
        $this->db->where(['reserve_shop_id' => 1, 'reserve_state' => 1]);
        $this->db->select("reserve_id, reserve_start, reserve_end, reserve_content, staff_id, staff_name, staff_color");
        $this->db->from('reserve');
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
            '=> $data[',
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