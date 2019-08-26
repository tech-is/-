<?php

class Mdl_reserve extends CI_Model
{

    public function get_reserve_data($id)
    {
        $this->db->where(["event_id" => $id]);
        $this->db->select('event_customer, event_content, event_start, event_end');
        $query = $this->db->get('calender_event');
        return $query->result_array();
    }

    public function get_reserve_list()
    {
        // $this->db->where('calender_event', ['shop_id' => $_SESSION["shop_id"]]);
        $where = ['event_shop_id' => 1, 'event_state' => 1];
        $this->db->where($where);
        $this->db->select("event_id, event_customer, event_start, event_end, event_content");
        $this->db->from('calender_event');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_reserve_data($data)
    {

        $data = [
            'event_customer' => $data['event_customer'],
            'event_pet' => $data['event_pet'],
            'event_start' => $data['event_start'],
            'event_end' => $data['event_end'],
            'event_content' => $data['event_content'],
            'event_staff_id' => $data['event_staff']
        ];
        $this->db->insert('calender_event', $data)? $result = true: $result = false;
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
        $data = [
            'event_customer' => $data['event_customer'],
            'event_pet' => $data['event_pet'],
            'event_start' => $data['event_start'],
            'event_end' => $data['event_end'],
            'event_content' => $data['event_content'],
            'event_staff_id' => $data['event_staff']
        ];
        $this->db->set();
        $this->db->where('event_id', $data['event_id']);
        $query = $this->db->update('calender_event', );
    }

}