<?php
class Mdl_magazine extends CI_Model
{
    public function select_magazine()
    {
        $this->db->where('mail_shop_id', 1);
        $this->db->select('mail_from_name, mail_subject, mail_detail');
        $this->db->get('mail_magazine');
    }

    public function insert_magazine()
    {

    }

    public function update_magazine()
    {

    }

    public function delete_magazine()
    {

    }
}