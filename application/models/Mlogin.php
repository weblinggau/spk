<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Mlogin extends CI_Model {

    public function proseslogin($user,$pass,$level)
    {
        $this->db-> select('username,password,level');
        $this->db-> from('user');
        $this->db-> where('username', $user);
        $this->db-> where('password', $pass);
        $this->db-> where('level', $level);

        $query=$this->db->get();

        if($query->num_rows()===1)
        {
            return $query->result();
        }
        else
        {
           return false;
        }
    }
}