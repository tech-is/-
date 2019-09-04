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
        $this->db->select("staff_id, staff_name, staff_color, staff_remarks, staff_created_at, staff_updated_at");
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

    public function update_reserve_data($data)
    {
        $upt_data = [
            'event_customer' => $data['event_customer'],
            'event_pet' => $data['event_pet'],
            'event_start' => $data['event_start'],
            'event_end' => $data['event_end'],
            'event_content' => $data['event_content'],
            'event_staff_id' => $data['event_staff']
        ];
        $this->db->set($upt_data);
        $this->db->where('event_id', $data['event_id']);
        $query = $this->db->update('calender_event');
        return $query;
    }

}