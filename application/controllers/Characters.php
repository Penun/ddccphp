<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Characters extends MY_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('playchar_model');
	}

    public function index(){
        $user = $this->auth->getUser();
        $subm_data = json_decode(file_get_contents('php://input'), TRUE);
        $resp['success'] = FALSE;
        $resp['error'] = '';
        $resp['playchars'] = $this->playchar_model->getNonNPCChars($subm_data['user_id']);
        $resp['user_id'] = $subm_data['user_id'];

        if ($resp['playchars'] !== FALSE){
            $resp['success'] = TRUE;
        } else {
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
			$resp['resp_obj']['playchar']['b_str'] = $chara['b_str'];
			$resp['resp_obj']['playchar']['b_dex'] = $chara['b_dex'];
			$resp['resp_obj']['playchar']['b_con'] = $chara['b_con'];
			$resp['resp_obj']['playchar']['b_int'] = $chara['b_int'];
			$resp['resp_obj']['playchar']['b_wis'] = $chara['b_wis'];
			$resp['resp_obj']['playchar']['b_cha'] = $chara['b_cha'];
			$resp['resp_obj']['playchar']['exp'] = $chara['exp'];
			$resp['resp_obj']['playchar']['hit_points'] = $chara['hit_points'];
			$resp['resp_obj']['playchar']['is_npc'] = $chara['is_npc'];
			$resp['resp_obj']['playchar']['is_partial'] = $chara['is_partial'];
			$resp['resp_obj']['playchar']['level'] = $chara['level'];
			$resp['resp_obj']['playchar']['name'] = $chara['playchar_name'];
			$resp['resp_obj']['playchar']['playchar_id'] = $chara['playchar_id'];
			$resp['resp_obj']['playchar']['sex'] = $chara['sex'];
			$resp['resp_obj']['playchar']['background_build']['background_build_id'] = $chara['background_build_id'];
			$resp['resp_obj']['playchar']['background_build']['background']['background_id'] = $chara['background_id'];
			$resp['resp_obj']['playchar']['background_build']['background']['characteristic'] = $chara['characteristic'];
			$resp['resp_obj']['playchar']['background_build']['background']['description'] = $chara['background_description'];
			$resp['resp_obj']['playchar']['background_build']['background']['name'] = $chara['background_name'];
			$resp['resp_obj']['playchar']['background_build']['background']['feature']['feature_id'] = $chara['feature_id'];
			$resp['resp_obj']['playchar']['background_build']['background']['feature']['name'] = $chara['feature_name'];
			$resp['resp_obj']['playchar']['background_build']['background']['feature']['options'] = $chara['feature_options'];
			$resp['resp_obj']['playchar']['background_build']['background']['feature']['description'] = $chara['feature_description'];
			$resp['resp_obj']['playchar']['background_build']['background']['bond']['bond_id'] = $chara['bond_id'];
			$resp['resp_obj']['playchar']['background_build']['background']['bond']['description'] = $chara['bond_description'];
			$resp['resp_obj']['playchar']['background_build']['background']['flaw']['flaw_id'] = $chara['flaw_id'];
			$resp['resp_obj']['playchar']['background_build']['background']['flaw']['description'] = $chara['flaw_description'];
			$resp['resp_obj']['playchar']['background_build']['background']['trait']['trait_id'] = $chara['trait_id'];
			$resp['resp_obj']['playchar']['background_build']['background']['trait']['description'] = $chara['trait_description'];
			$resp['resp_obj']['playchar']['background_build']['background']['ideal']['ideal_id'] = $chara['ideal_id'];
			$resp['resp_obj']['playchar']['background_build']['background']['ideal']['description'] = $chara['ideal_description'];
			$resp['resp_obj']['playchar']['class_build']['class_build_id'] = $chara['class_build_id'];
			$resp['resp_obj']['playchar']['class_build']['class']['class_id'] = $chara['class_id'];
			$resp['resp_obj']['playchar']['class_build']['class']['name'] = $chara['class_name'];
			$resp['resp_obj']['playchar']['class_build']['class']['hit_dice'] = $chara['hit_dice'];
			$resp['resp_obj']['playchar']['class_build']['class']['skill_profs'] = $chara['skill_profs'];
			$resp['resp_obj']['playchar']['class_build']['class']['abil_prefs'] = $chara['abil_prefs'];
			$resp['resp_obj']['playchar']['class_build']['class_path']['class_path_id'] = $chara['class_path_id'];
			$resp['resp_obj']['playchar']['class_build']['class_path']['name'] = $chara['class_path_name'];
			$resp['resp_obj']['playchar']['race_build']['race_build_id'] = $chara['race_build_id'];
			$resp['resp_obj']['playchar']['race_build']['age'] = $chara['age'];
			$resp['resp_obj']['playchar']['race_build']['alignment'] = $chara['alignment'];
			$resp['resp_obj']['playchar']['race_build']['height_in'] = $chara['height_in'];
			$resp['resp_obj']['playchar']['race_build']['options'] = $chara['race_build_options'];
			$resp['resp_obj']['playchar']['race_build']['weight'] = $chara['weight'];
			$resp['resp_obj']['playchar']['race_build']['race']['race_id'] = $chara['race_id'];
			$resp['resp_obj']['playchar']['race_build']['race']['ability_mods'] = $chara['race_ability_mods'];
			$resp['resp_obj']['playchar']['race_build']['race']['name'] = $chara['race_name'];
			$resp['resp_obj']['playchar']['race_build']['race']['speed'] = $chara['speed'];
			$resp['resp_obj']['playchar']['race_build']['sub_race']['sub_race_id'] = $chara['sub_race_id'];
			$resp['resp_obj']['playchar']['race_build']['sub_race']['ability_mods'] = $chara['sub_race_ability_mods'];
			$resp['resp_obj']['playchar']['race_build']['sub_race']['name'] = $chara['sub_race_name'];
        }

        header('Content-Type: application/json');
        echo json_encode($resp);
    }
}
