<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Class_model extends CI_Model {

    var $class_table = 'class';
    var $class_path_table = 'class_path';

    public function __construct() {
        parent::__construct();
    }

    public function getClasses(){
        $result = $this->db->get($this->class_table);
        if ($result->num_rows() > 0 ){
            return $result->result_array();
        } else {
            return FALSE;
        }
    }

    public function getPaths($c_id){
        $this->db->where('class_id', $c_id);
        $this->db->from($this->class_path_table);
        $result = $this->db->get();
        if ($result->num_rows() > 0){
            return $result->result_array();
        } else {
            return FALSE;
        }
    }
}
