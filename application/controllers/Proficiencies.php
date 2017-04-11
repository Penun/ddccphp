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
}
