<?php

class Mdl_shift extends CI_Model
{
    public function get_shift($id)
    {
        return $this->db->where(['shift_shop_id' => $id, 'shift_state' => 1, 'staff_state' => 1])
            ->select('staff_id, shift_id, staff_name, shift_start, shift_end, staff_color')
            ->from('staff_shift')->join('staff', 'staff_id = shift_staff_id', 'inner')
            ->get()->result_array();
    }

    public function insert_shift($data)
    {
        return $this->db->insert('staff_shift', $data);
    }

    public function update_shift($id, $data)
    {
        return $this->db->set($data)->where($id)->update('staff_shift');
}

    public function delete_shift($id)
    {
        $this->db->set("shift_state", 999)->where($id)->update('staff_shift');
    }
}