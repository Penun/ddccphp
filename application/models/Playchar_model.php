<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Playchar_model extends CI_Model {

    var $playchar_table = 'playchar';

    public function __construct() {
        parent::__construct();
    }

    public function getNonNPCChars($u_id){
        $this->db->where('user_id', $u_id);
		$this->db->where('is_npc', 0);
        $query = $this->db->get($this->playchar_table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
}
