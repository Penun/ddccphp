<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Characters extends MY_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('playchar_model');
	}

    public function index(){
        $user = $this->auth->getUser();
        $subm_data = json_decode(file_get_contents('php://input'), true);
        $resp['success'] = false;
        $resp['error'] = '';
        $resp['playchars'] = $this->playchar_model->getNonNPCChars($subm_data['user_id']);
        $resp['user_id'] = $subm_data['user_id'];

        if ($resp['playchars'] !== FALSE){
            $resp['success'] = true;
        }

        header('Content-Type: application/json');
        echo json_encode($resp);
    }

    public function details(){
        $subm_data = json_decode(file_get_contents('php://input'), true);
        $resp['success'] = false;
        $resp['error'] = '';
        $resp['u_i'] = $subm_data['u_i'];
        $resp['p_i'] = $subm_data['p_i'];
        $resp['resp_obj']['playchar'] = $this->playchar_model->getCharDetails($subm_data['playchar_id']);
    }
}
