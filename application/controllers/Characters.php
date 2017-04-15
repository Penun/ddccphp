<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Characters extends MY_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('playchar_model');
        $this->load->model('race_model');
	}

    public function index(){
        $subm_data = json_decode(file_get_contents('php://input'), TRUE);
        $resp['success'] = FALSE;
        $resp['error'] = '';
        $resp['playchars'] = $this->playchar_model->getNonNPCChars($subm_data['user_id']);

        if ($resp['playchars'] !== FALSE){
			$resp['u_i'] = $subm_data['u_i'];
            $resp['success'] = TRUE;
        } else {
			$resp['u_i'] = $subm_data['u_i'];
			$resp['error'] = "1";
		}

        header('Content-Type: application/json');
        echo json_encode($resp);
    }

    public function details(){
        $subm_data = json_decode(file_get_contents('php://input'), TRUE);
        $resp['success'] = FALSE;
        $resp['error'] = '';
        $resp['u_i'] = $subm_data['u_i'];
        $resp['p_i'] = $subm_data['p_i'];

		$chara = $this->playchar_model->getCharDetails($subm_data['playchar_id']);
		if ($chara !== FALSE){
            $resp['success'] = TRUE;
			$resp['resp_obj']['playchar'] = $this->_condenseDetQuery($chara);

			$rac_fe = $this->race_model->getRaceFeatures($chara['race_id']);
			if ($rac_fe !== FALSE) {
				$resp['resp_obj']['race_features'] = $this->_condenseRaceFeat($rac_fe);
			}
		}

        header('Content-Type: application/json');
        echo json_encode($resp);
    }

	public function insert(){
		$subm_data = json_decode(file_get_contents('php://input'), TRUE);
        $resp['success'] = FALSE;
        $resp['error'] = '';
		if (isset($subm_data['playchar']) && isset($subm_data['chosen_profs'])){
			$user = $this->auth->getUser();
			$subm_data['playchar']['user_id'] = $user['user_id'];
			$subm_data['playchar']['is_npc'] = 0;
			$pl_ch = $this->playchar_model->insert($subm_data['playchar'], $subm_data['chosen_profs']);
			if ($pl_ch !== FALSE) {
				$resp['success'] = TRUE;
				$resp['playchar'] = $pl_ch;
			}
		} else {
			$resp['error'] = "Missing data.";
		}
		header("Content-Type: application/json");
		echo json_encode($resp);
	}

	public function update(){
		$subm_data = json_decode(file_get_contents('php://input'), TRUE);
        $resp['success'] = FALSE;
        $resp['error'] = '';
		if (isset($subm_data['playchar']) && isset($subm_data['update_chosen'])){
			unset($subm_data['playchar']['bo_str']);
			unset($subm_data['playchar']['bo_dex']);
			unset($subm_data['playchar']['bo_con']);
			unset($subm_data['playchar']['bo_int']);
			unset($subm_data['playchar']['bo_wis']);
			unset($subm_data['playchar']['bo_cha']);
			unset($subm_data['playchar']['m_str']);
			unset($subm_data['playchar']['m_dex']);
			unset($subm_data['playchar']['m_con']);
			unset($subm_data['playchar']['m_int']);
			unset($subm_data['playchar']['m_wis']);
			unset($subm_data['playchar']['m_cha']);
			unset($subm_data['playchar']['t_str']);
			unset($subm_data['playchar']['t_dex']);
			unset($subm_data['playchar']['t_con']);
			unset($subm_data['playchar']['t_int']);
			unset($subm_data['playchar']['t_wis']);
			unset($subm_data['playchar']['t_cha']);
			unset($subm_data['playchar']['profBonus']);
			unset($subm_data['playchar']['raceRef']);
			unset($subm_data['playchar']['fetchDetails']);
			unset($subm_data['playchar']['showBonuses']);
			unset($subm_data['playchar']['showFeatures']);
			unset($subm_data['playchar']['showInfo']);
			unset($subm_data['playchar']['showSkills']);
			unset($subm_data['playchar']['showBackground']);
			$resp['success'] = $this->playchar_model->update($subm_data['playchar'], $subm_data['update_chosen']);
			$chara = $this->playchar_model->GetCharDetails($subm_data['playchar']['playchar_id']);
			$resp['playchar'] = $this->_condenseDetQuery($chara);
			$rac_fe = $this->race_model->getRaceFeatures($chara['race_id']);
			if ($rac_fe !== FALSE) {
				$resp['race_features'] = $this->_condenseRaceFeat($rac_fe);
			}
		} else {
			$resp['error'] = "Missing data.";
		}
		header("Content-Type: application/json");
		echo json_encode($resp);
	}

	public function delete(){
		$subm_data = json_decode(file_get_contents('php://input'), TRUE);
		$resp['success'] = FALSE;
		$resp['error'] = '';
		if (isset($subm_data['playchar_id'])){
			$user = $this->auth->getUser();
			$bas_pla = $this->playchar_model->getBase($subm_data['playchar_id']);
			if ($bas_pla !== FALSE && $bas_pla['user_id'] == $user['user_id']){
				$resp['success'] = $this->playchar_model->delete($subm_data['playchar_id']);
			}
			$resp['p_i'] = $subm_data['p_i'];
			$resp['u_i'] = $subm_data['u_i'];
		} else {
			$resp['error'] = "Missing data.";
		}
		header("Content-Type: application/json");
		echo json_encode($resp);
	}

	private function _condenseDetQuery($chara){
		$playchar = array();
		$playchar['b_str'] = $chara['b_str'];
		$playchar['b_dex'] = $chara['b_dex'];
		$playchar['b_con'] = $chara['b_con'];
		$playchar['b_int'] = $chara['b_int'];
		$playchar['b_wis'] = $chara['b_wis'];
		$playchar['b_cha'] = $chara['b_cha'];
		$playchar['exp'] = $chara['exp'];
		$playchar['hit_points'] = $chara['hit_points'];
		$playchar['is_npc'] = $chara['is_npc'];
		$playchar['is_partial'] = $chara['is_partial'];
		$playchar['level'] = $chara['level'];
		$playchar['name'] = $chara['playchar_name'];
		$playchar['playchar_id'] = $chara['playchar_id'];
		$playchar['sex'] = $chara['sex'];
		$playchar['background_build']['background_build_id'] = $chara['background_build_id'];
		$playchar['background_build']['background']['background_id'] = $chara['background_id'];
		$playchar['background_build']['background']['characteristic'] = $chara['characteristic'];
		$playchar['background_build']['background']['description'] = $chara['background_description'];
		$playchar['background_build']['background']['name'] = $chara['background_name'];
		$playchar['background_build']['background']['feature']['feature_id'] = $chara['feature_id'];
		$playchar['background_build']['background']['feature']['name'] = $chara['feature_name'];
		$playchar['background_build']['background']['feature']['options'] = $chara['feature_options'];
		$playchar['background_build']['background']['feature']['description'] = $chara['feature_description'];
		$playchar['background_build']['background']['bond']['bond_id'] = $chara['bond_id'];
		$playchar['background_build']['background']['bond']['description'] = $chara['bond_description'];
		$playchar['background_build']['background']['flaw']['flaw_id'] = $chara['flaw_id'];
		$playchar['background_build']['background']['flaw']['description'] = $chara['flaw_description'];
		$playchar['background_build']['background']['trait']['trait_id'] = $chara['trait_id'];
		$playchar['background_build']['background']['trait']['description'] = $chara['trait_description'];
		$playchar['background_build']['background']['ideal']['ideal_id'] = $chara['ideal_id'];
		$playchar['background_build']['background']['ideal']['description'] = $chara['ideal_description'];
		$playchar['class_build']['class_build_id'] = $chara['class_build_id'];
		$playchar['class_build']['class']['class_id'] = $chara['class_id'];
		$playchar['class_build']['class']['name'] = $chara['class_name'];
		$playchar['class_build']['class']['hit_dice'] = $chara['hit_dice'];
		$playchar['class_build']['class']['skill_profs'] = $chara['skill_profs'];
		$playchar['class_build']['class']['abil_prefs'] = $chara['abil_prefs'];
		if (isset($chara['class_path_id'])){
			$playchar['class_build']['class_path']['class_path_id'] = $chara['class_path_id'];
			$playchar['class_build']['class_path']['name'] = $chara['class_path_name'];
		}
		$playchar['race_build']['race_build_id'] = $chara['race_build_id'];
		$playchar['race_build']['age'] = $chara['age'];
		$playchar['race_build']['alignment'] = $chara['alignment'];
		$playchar['race_build']['height_in'] = $chara['height_in'];
		$playchar['race_build']['options'] = $chara['race_build_options'];
		$playchar['race_build']['weight'] = $chara['weight'];
		$playchar['race_build']['race']['race_id'] = $chara['race_id'];
		$playchar['race_build']['race']['ability_mods'] = $chara['race_ability_mods'];
		$playchar['race_build']['race']['name'] = $chara['race_name'];
		$playchar['race_build']['race']['speed'] = $chara['speed'];
		if (isset($chara['sub_race_id'])){
			$playchar['race_build']['sub_race']['sub_race_id'] = $chara['sub_race_id'];
			$playchar['race_build']['sub_race']['ability_mods'] = $chara['sub_race_ability_mods'];
			$playchar['race_build']['sub_race']['name'] = $chara['sub_race_name'];
		}

		return $playchar;
	}

	private function _condenseRaceFeat($rac_fe){
		$raceFeats = array();
		$rfc = count($rac_fe);
		for ($i = 0; $i < $rfc; $i++){
			$raceFeats[$i]['race_feature_id'] = $rac_fe[$i]['race_feature_id'];
			$raceFeats[$i]['feature']['feature_id'] = $rac_fe[$i]['feature_id'];
			$raceFeats[$i]['feature']['name'] = $rac_fe[$i]['name'];
			$raceFeats[$i]['feature']['description'] = $rac_fe[$i]['description'];
			$raceFeats[$i]['feature']['options'] = $rac_fe[$i]['options'];
		}
		return $raceFeats;
	}
}
