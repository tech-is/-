<?php
class Mdl_magazine extends CI_Model
{
    public function select_magazine()
    {
        $this->db->where('mail_shop_id', $data["shops_id"]);
        $this->db->select('mail_from_name, mail_subject, mail_detail');
        $this->db->get('mail_magazine');
    }

    public function update_sended_at($data)
    {
        $this->db->set("mail_semdend_at", $data);
        $this->db->update("mail_magazine");
    }

    public function insert_magazine($data)
    {
        return $this->db->insert('mail_magazine', $data);
    }

    public function update_magazine($data)
    {
        $this->db->set($data);
        $this->db->update("mail_magazine");
    }

    public function delete_magazine()
    {

    }
}