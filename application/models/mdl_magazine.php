<?php
class Mdl_magazine extends CI_Model
{
    public function select_magazine()
    {
        $this->db->where('mail_shop_id', 1);
        $this->db->select('mail_from_name, mail_subject, mail_detail');
        $this->db->get('mail_magazine');
    }

    public function update_sended_at($data)
    {
        $this->db->set("mail_semdend_at", $data);
        $this->db->update("mail_magazine");
    }

    public function insert_magazine()
    {
        $data = [
            "mail_shop_id" => "",
            "mail_shop_mail" => "",
            "mail_from_name" => "",
            "mail_subject" => "",
            "mail_detail" => ""
        ];
        return $this->db->insert('mail_magazine', $data);
    }

    public function update_magazine()
    {
        $data = [
            "mail_shop_mail" => "",
            "mail_from_name" => "",
            "mail_subject" => "",
            "mail_detail" => ""
        ];
        $this->db->set($data);
        $this->db->update("mail_magazine");
    }

    public function delete_magazine()
    {

    }
}