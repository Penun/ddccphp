<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Race_model extends CI_Model {

    var $race_feature_table = 'race_feature';

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
        $this->db->from('`race_feature` AS T0');
        $this->db->join('`feature` AS T1', 'T1.`feature_id` = T0.`feature_id` ', 'inner');
        $this->db->join('`race` AS T2', 'T2.`race_id` = T0.`race_id`', 'inner');
        $this->db->where('T0.`race_id`', $r_id);

        $result = $this->db->get();
        if ($result->num_rows() > 0){
            return $result->result_array();
        } else {
            return FALSE;
        }
    }
}
