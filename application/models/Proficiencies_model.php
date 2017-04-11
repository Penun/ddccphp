<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Proficiencies_model extends CI_Model {

    var $cb_chosen_table = 'cb_chosen_proficiency';

    public function __construct() {
        parent::__construct();
    }

    public function getCbChosen($cb_id){
        $this->db->select('T0.`cb_chosen_proficiency_id`');
        $this->db->select('T0.`class_proficiency_id`');
        $this->db->select('T0.`class_build_id`');
        $this->db->select('T1.`proficiency_id`');
        $this->db->select('T1.`class_id`');
        $this->db->select('T2.`name`');
        $this->db->select('T2.`type`');
        $this->db->select('T2.`s_code`');
        $this->db->from('`cb_chosen_proficiency` AS T0');
        $this->db->join('`class_proficiency` AS T1', 'T1.`class_proficiency_id` = T0.`class_proficiency_id`', 'inner');
        $this->db->join('`proficiency` AS T2', 'T2.`proficiency_id` = T1.`proficiency_id`', 'inner');
        $this->db->join('`class_build` AS T3', 'T3.`class_build_id` = T0.`class_build_id`', 'inner');
        $this->db->where('T0.`class_build_id`', $cb_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
}
