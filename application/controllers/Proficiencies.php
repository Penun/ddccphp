<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Proficiencies extends MY_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('proficiencies_model');
	}

    public function index(){}

    public function chosen(){
        $subm_data = json_decode(file_get_contents('php://input'), TRUE);
        $resp['success'] = FALSE;
        $resp['error'] = '';
        $resp['p_in'] = $subm_data['p_in'];
        $resp['u_in'] = $subm_data['u_in'];

        $cbs = $this->proficiencies_model->getCbChosen($subm_data['class_build_id']);
        if ($cbs !== FALSE){
            $resp['success'] = TRUE;
            $cbsc = count($cbs);
            $resp['cb_chosen_proficiencies'] = array();
            for ($i = 0; $i < $cbsc; $i++){
                $resp['cb_chosen_proficiencies'][$i]['cb_chosen_proficiency_id'] = $cbs[$i]['cb_chosen_proficiency_id'];
                $resp['cb_chosen_proficiencies'][$i]['class_proficiency']['class_proficiency_id'] = $cbs[$i]['class_proficiency_id'];
                $resp['cb_chosen_proficiencies'][$i]['class_proficiency']['proficiency']['proficiency_id'] = $cbs[$i]['proficiency_id'];
                $resp['cb_chosen_proficiencies'][$i]['class_proficiency']['proficiency']['name'] = $cbs[$i]['name'];
                $resp['cb_chosen_proficiencies'][$i]['class_proficiency']['proficiency']['s_code'] = $cbs[$i]['s_code'];
                $resp['cb_chosen_proficiencies'][$i]['class_proficiency']['proficiency']['type'] = $cbs[$i]['type'];
            }
        }

        header("Content-Type: application/json");
        echo json_encode($resp);
    }

    public function background(){
        $subm_data = json_decode(file_get_contents('php://input'), TRUE);
        $resp['success'] = FALSE;
        $resp['error'] = '';
        $bg_prof = $this->proficiencies_model->getBackground($subm_data['background_id']);
        if ($bg_prof !== FALSE) {
			$resp['p_in'] = $subm_data['p_in'];
			if (isset($subm_data['u_in'])){
				$resp['u_in'] = $subm_data['u_in'];
			}
            $resp['success'] = TRUE;
            $resp['background_proficiencies'] = array();
            $bgc = count($bg_prof);
            for ($i = 0; $i < $bgc; $i++){
                $resp['background_proficiencies'][$i]['background_proficiency_id'] = $bg_prof[$i]['background_proficiency_id'];
                $resp['background_proficiencies'][$i]['proficiency']['proficiency_id'] = $bg_prof[$i]['proficiency_id'];
                $resp['background_proficiencies'][$i]['proficiency']['name'] = $bg_prof[$i]['name'];
                $resp['background_proficiencies'][$i]['proficiency']['s_code'] = $bg_prof[$i]['s_code'];
                $resp['background_proficiencies'][$i]['proficiency']['type'] = $bg_prof[$i]['type'];
            }
        }

        header("Content-Type: application/json");
        echo json_encode($resp);
    }

	public function skills(){
		$resp['success'] = FALSE;
		$resp['error'] = '';
		$skills = $this->proficiencies_model->getSkills();
		if ($skills !== FALSE){
			$resp['proficiencies'] = $skills;
			$resp['success'] = TRUE;
		}

		header("Content-Type: application/json");
        echo json_encode($resp);
	}

	public function classp(){
		$subm_data = json_decode(file_get_contents('php://input'), TRUE);
		$resp['success'] = FALSE;
		$resp['error'] = '';
		$clapro = $this->proficiencies_model->getClassProfs($subm_data['c_id']);
		if ($clapro !== FALSE){
			$resp['success'] = TRUE;
			$resp['c_in'] = $subm_data['c_in'];
			$claproc = count($clapro);
			for ($i = 0; $i < $claproc; $i++){
				$resp['class_profs'][$i]['class_proficiency_id'] = $clapro[$i]['class_proficiency_id'];
				$resp['class_profs'][$i]['proficiency']['proficiency_id'] = $clapro[$i]['proficiency_id'];
				$resp['class_profs'][$i]['proficiency']['name'] = $clapro[$i]['name'];
				$resp['class_profs'][$i]['proficiency']['s_code'] = $clapro[$i]['s_code'];
				$resp['class_profs'][$i]['proficiency']['type'] = $clapro[$i]['type'];
			}
		}
		header("Content-Type: application/json");
		echo json_encode($resp);
	}
}
