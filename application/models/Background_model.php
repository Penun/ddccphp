<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Background_model extends CI_Model {

    var $background_table = 'background';
    var $feature_table = 'feature';

    public function __construct() {
        parent::__construct();
    }

    public function getBGs(){
        $this->db->select('T0.`background_id`');
        $this->db->select('T0.`name AS bg_name`');
        $this->db->select('T0.`description AS bg_desc`');
        $this->db->select('T0.`feature_id`');
        $this->db->select('T0.`characteristic`');
        $this->db->select('T1.`name AS feat_name`');
        $this->db->select('T1.`description AS feat_desc`');
        $this->db->select('T1.`options`');
        $this->db->from($this->background_table.' AS T0');
        $this->db->join($this->feature_table.' AS T1', 'T1.`feature_id` = T0.`feature_id`', 'inner');

        $result = $this->db->get();
        if ($result->num_rows() > 0 ){
            return $result->result_array();
        } else {
            return FALSE;
        }
    }
}
