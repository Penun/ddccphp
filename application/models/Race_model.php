<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Race_model extends CI_Model {

    var $race_feature_table = 'race_feature';
    var $race_table = 'race';
    var $sub_race_table = 'sub_race';
    var $feature_table = 'feature';

    public function __construct() {
        parent::__construct();
    }

    public function getRaceFeatures($r_id){
        $this->db->select('T0.`race_feature_id`');
        $this->db->select('T0.`race_id`');
        $this->db->select('T0.`feature_id`');
        $this->db->select('T1.`feature_id`');
        $this->db->select('T1.`name`');
        $this->db->select('T1.`description`');
        $this->db->select('T1.`options` ');
        $this->db->from($this->race_feature_table.' AS T0');
        $this->db->join($this->feature_table.' AS T1', 'T1.`feature_id` = T0.`feature_id` ', 'inner');
        $this->db->join($this->race_table.' AS T2', 'T2.`race_id` = T0.`race_id`', 'inner');
        $this->db->where('T0.`race_id`', $r_id);

        $result = $this->db->get();
        if ($result->num_rows() > 0){
            return $result->result_array();
        } else {
            return FALSE;
        }
    }

    public function getRaces(){
        $result = $this->db->get($this->race_table);
        if ($result->num_rows() > 0 ){
            return $result->result_array();
        } else {
            return FALSE;
        }
    }

    public function getSubs($r_id){
        $this->db->where('race_id', $r_id);
        $result = $this->db->get($this->sub_race_table);
        if ($result->num_rows() > 0 ){
            return $result->result_array();
        } else {
            return FALSE;
        }
    }

    public function getFeats($r_id){
        $this->db->select('T0.`race_feature_id`');
        $this->db->select('T0.`feature_id`');
        $this->db->select('T1.`name`');
        $this->db->select('T1.`description`');
        $this->db->select('T1.`options`');
        $this->db->from($this->race_feature_table.' AS T0');
        $this->db->join($this->feature_table.' AS T1', 'T1.`feature_id` = T0.`feature_id`', 'inner');
        $this->db->where('T0.`race_id`', $r_id);

        $result = $this->db->get();
        if ($result->num_rows() > 0){
            return $result->result_array();
        } else {
            return FALSE;
        }
    }
}
