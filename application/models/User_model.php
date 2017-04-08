<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {

    var $user_table = 'user';

    public function __construct() {
        parent::__construct();
    }

    public function add($user)
    {
        $this->db->insert($this->user_table, $user);
        return $this->db->insert_id();
    }

    public function edit($user_id, $home)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update($this->user_table, $home);
    }

    public function delete($user_id)
    {
        $this->db->where('id', $user_id);
        $this->db->delete($this->user_table);
    }

    public function get($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->user_table);
        if ($query->num_rows() > 0)
        {
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_users($u_clear, $u_group) {
		$this->db->where('clearance >=', $u_clear);
		$this->db->where('group', $u_group);
        $query = $this->db->get($this->user_table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function login($username, $password){
        $this->db->where('user_name', $username);
        $this->db->where('password', $password);
        $query = $this->db->get($this->user_table);
        if ($query->num_rows() > 0)
        {
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }
}
