<?php

class Mdl_reserve extends CI_Model
{
    public function get_reserve_data()
    {
        // $this->db->where('calender_event', ['shop_id' => $_SESSION["shop_id"]]);
        $where = ['event_shop_id' => 1, 'event_state' => 1];
        $this->db->where($where);
        $this->db->select("event_customer, event_content, event_start, event_end, staff_name");
        $this->db->from('calender_event');
        // $this->db->join('staff', 'event_shop_id = staff_shop_id', 'left outer');
        // $this->db->join('staff', 'event_staff_id = staff_id', 'left outer');
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