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

    public function getCharDetails($playchar_id){
        $this->db->select('T0.`name` AS playchar_name');
        $this->db->select('T0.`level`');
        $this->db->select('T0.`hit_points`');
        $this->db->select('T0.`exp`');
        $this->db->select('T0.`b_str`');
        $this->db->select('T0.`b_dex`');
        $this->db->select('T0.`b_con`');
        $this->db->select('T0.`b_int`');
        $this->db->select('T0.`b_wis`');
        $this->db->select('T0.`b_cha`');
        $this->db->select('T0.`sex`');
        $this->db->select('T0.`user_id`');
        $this->db->select('T0.`is_partial`');
        $this->db->select('T0.`race_build_id`');
        $this->db->select('T0.`class_build_id`');
        $this->db->select('T0.`background_build_id`');
        $this->db->select('T0.`is_npc`');
        $this->db->select('T1.`race_build_id`');
        $this->db->select('T1.`race_id`');
        $this->db->select('T1.`sub_race_id`');
        $this->db->select('T1.`playchar_id`');
        $this->db->select('T1.`alignment`');
        $this->db->select('T1.`height_in`');
        $this->db->select('T1.`weight`');
        $this->db->select('T1.`age`');
        $this->db->select('T1.`options` AS race_build_options');
        $this->db->select('T2.`race_id`');
        $this->db->select('T2.`name` AS race_name');
        $this->db->select('T2.`speed`');
        $this->db->select('T2.`max_age`');
        $this->db->select('T2.`adult_age`');
        $this->db->select('T2.`min_height_in`');
        $this->db->select('T2.`max_height_in`');
        $this->db->select('T2.`min_weight`');
        $this->db->select('T2.`max_weight`');
        $this->db->select('T2.`size`');
        $this->db->select('T2.`ability_mods` AS race_ability_mods');
        $this->db->select('T3.`sub_race_id`');
        $this->db->select('T3.`race_id`');
        $this->db->select('T3.`name` AS sub_race_name');
        $this->db->select('T3.`ability_mods` AS sub_race_ability_mods');
        $this->db->select('T4.`class_build_id`');
        $this->db->select('T4.`class_id`');
        $this->db->select('T4.`class_path_id`');
        $this->db->select('T4.`playchar_id`');
        $this->db->select('T5.`class_id`');
        $this->db->select('T5.`name` AS class_name');
        $this->db->select('T5.`hit_dice`');
        $this->db->select('T5.`skill_profs`');
        $this->db->select('T5.`abil_prefs`');
        $this->db->select('T6.`class_path_id`');
        $this->db->select('T6.`class_id`');
        $this->db->select('T6.`name` AS class_path_name');
        $this->db->select('T7.`background_build_id`');
        $this->db->select('T7.`background_id`');
        $this->db->select('T7.`playchar_id`');
        $this->db->select('T7.`trait_id`');
        $this->db->select('T7.`ideal_id`');
        $this->db->select('T7.`bond_id`');
        $this->db->select('T7.`flaw_id`');
        $this->db->select('T8.`background_id`');
        $this->db->select('T8.`name` AS background_name');
        $this->db->select('T8.`description` AS background_description');
        $this->db->select('T8.`feature_id`');
        $this->db->select('T8.`characteristic`');
        $this->db->select('T9.`feature_id`');
        $this->db->select('T9.`name` AS feature_name');
        $this->db->select('T9.`description` AS feature_description');
        $this->db->select('T9.`options` AS feature_options');
        $this->db->select('T10.`trait_id`');
        $this->db->select('T10.`background_id`');
        $this->db->select('T10.`description` AS trait_description');
        $this->db->select('T11.`ideal_id`');
        $this->db->select('T11.`background_id`');
        $this->db->select('T11.`description` AS ideal_description');
        $this->db->select('T12.`bond_id`');
        $this->db->select('T12.`background_id`');
        $this->db->select('T12.`description` AS bond_description');
        $this->db->select('T13.`flaw_id`');
        $this->db->select('T13.`background_id`');
        $this->db->select('T13.`description` AS flaw_description');
        $this->db->from('`playchar` AS T0');
        $this->db->join('`race_build` AS T1', 'T1.`race_build_id` = T0.`race_build_id`', 'left');
        $this->db->join('`race` AS T2', 'T2.`race_id` = T1.`race_id`', 'left');
        $this->db->join('`sub_race` AS T3', 'T3.`sub_race_id` = T1.`sub_race_id`', 'left');
        $this->db->join('`class_build` AS T4', 'T4.`class_build_id` = T0.`class_build_id`', 'left');
        $this->db->join('`class` AS T5', 'T5.`class_id` = T4.`class_id`', 'left');
        $this->db->join('`class_path` AS T6', 'T6.`class_path_id` = T4.`class_path_id`', 'left');
        $this->db->join('`background_build` AS T7', 'T7.`background_build_id` = T0.`background_build_id`', 'left');
        $this->db->join('`background` AS T8', 'T8.`background_id` = T7.`background_id`', 'left');
        $this->db->join('`feature` AS T9', 'T9.`feature_id` = T8.`feature_id`', 'left');
        $this->db->join('`trait` AS T10', 'T10.`trait_id` = T7.`trait_id`', 'left');
        $this->db->join('`ideal` AS T11', 'T11.`ideal_id` = T7.`ideal_id`', 'left');
        $this->db->join('`bond` AS T12', 'T12.`bond_id` = T7.`bond_id`', 'left');
        $this->db->join('`flaw` AS T13', 'T13.`flaw_id` = T7.`flaw_id`', 'left');
        $this->db->where('T0.`playchar_id`', $playchar_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query->row_array();
        } else {
            return false;
        }
    }
}
