<?php

class Mdl_staff_shift extends CI_Model
{
    public function select_shift_data($sfatt_shift)
    {
        $this->db->where(['staff_shift' => $sfaff_shift]);
        $this->db->select("shift_staff_id, shift_start, shift_end");
        $query = $this->db->get('staff_shitt');
        return $query->result_array();
    }

    public function insert_shift_data($data)
    {
        $this->db->insert('staff_shift', $data)? $result = true: $result = false;
        return $result;
    }

    public function update_shift_data($id, $data)
    {
        $this->db->set($data);
        $this->db->where(['staff_id'=> $id['staff_id'], 'staff_shop_id' => $id['staff_shop_id']]);
        return $this->db->update('staff');
    }

    public function delete_shift_data($id)
    {
        $this->db->set("staff_state", 999);
        $this->db->where(['staff_id'=> $id['staff_id'], 'staff_shop_id' => $id['staff_shop_id']]);
        return $this->db->update('staff');
    }
}