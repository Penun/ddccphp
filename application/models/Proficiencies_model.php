<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Proficiencies_model extends CI_Model {

    var $cb_chosen_table = 'cb_chosen_proficiency';
    var $proficiency_table = 'proficiency';

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

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return FALSE;
        }
    }

    public function getBackground($bg_id){
        $this->db->select('T0.`background_proficiency_id`');
        $this->db->select('T1.`proficiency_id`');
        $this->db->select('T1.`name`');
        $this->db->select('T1.`type`');
        $this->db->select('T1.`s_code`');
        $this->db->from('`background_proficiency` AS T0');
        $this->db->join('`proficiency` AS T1', 'T1.`proficiency_id` = T0.`proficiency_id` ', 'inner');
        $this->db->join('`background` AS T2', 'T2.`background_id` = T0.`background_id` ', 'inner');
        $this->db->where('T0.`background_id`', $bg_id);
        $this->db->where('T1.`type`', 'skill');

        $result = $this->db->get();
        if ($result->num_rows() > 0){
            return $result->result_array();
        } else {
            return FALSE;
        }
    }

    public function getSkills(){
        $result = $this->db->get($this->proficiency_table);
        if ($result->num_rows() > 0){
            return $result->result_array();
        } else {
            return FALSE;
        }
    }
}
