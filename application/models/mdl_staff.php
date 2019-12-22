<?php

class Mdl_staff extends CI_Model
{

    public function get_staff($where)
    {
        return $this->db->where($where)->select("staff_id, staff_name, staff_tel, staff_mail, staff_color, staff_remarks")
        ->from('staff')->get()->result_array();
    }

    public function insert_staff($data)
    {
        return $this->db->insert('staff', $data);
    }

    public function update_staff($id, $data)
    {
        return $this->db->set($data)->where($id)->update('staff');
    }

    public function delete_staff($id)
    {
        return $this->db->set("staff_state", 999)->where($id)->update('staff');
    }

}