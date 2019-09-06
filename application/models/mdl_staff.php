<?php

class Mdl_staff extends CI_Model
{

    public function get_staff($id)
    {
        // $this->db->where(["event_id" => $id]);
        // $this->db->select('event_customer, event_content, event_start, event_end');
        // $query = $this->db->get('calender_event');
        // return $query->result_array();
    }

    public function get_staff_list()
    {
        $where = ['staff_shop_id' => 1, 'staff_state' => 1];
        $this->db->where($where);
        $this->db->select("staff_id, staff_name, staff_tel, staff_mail, staff_color, staff_remarks");
        $this->db->from('staff');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_staff_data($data)
    {
        $this->db->insert('staff', $data)? $result = true: $result = false;
        return $result;
    }

    public function select_reserve_data($event_id)
    {
        $this->db->where(['event_id' => $event_id]);
        $this->db->select("event_id, event_customer, event_pet, event_start, event_end, event_content");
        $query = $this->db->get('calender_event');
        return $query->result_array();
    }

    public function update_staff_data($id, $data)
    {
        $this->db->set($data);
        $this->db->where(['staff_id'=> $id['staff_id'], 'staff_shop_id' => $id['staff_shop_id']]);
        return $this->db->update('staff');
    }

    public function delete_staff_data($id)
    {
        $this->db->set("staff_state", 999);
        $this->db->where(['staff_id'=> $id['staff_id'], 'staff_shop_id' => $id['staff_shop_id']]);
        return $this->db->update('staff');
    }

}