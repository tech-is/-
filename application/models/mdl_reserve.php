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

    public function insert_reserve_data()
    {
        $_POST["staff_id"] == ""? $staff = null: $staff = $_POST["staff_id"];
        $data = [
            'event_customer' => $_POST["customer"],
            'event_start' => $_POST["start"],
            'event_end' => $_POST["end"],
            'event_content' => $_POST["content"],
            'event_staff_id' => $staff
        ];
        $this->db->insert('calender_event', $data)? $result = true: $result = false;
        return $result;
    }
}