<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Races extends MY_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('race_model');
	}

    public function listr(){
        $resp['success'] = FALSE;
        $resp['error'] = '';
        $races = $this->race_model->getRaces();
        if ($races !== FALSE){
            $resp['races'] = $races;
            $resp['success'] = TRUE;
        }
        header("Content-Type: application/json");
        echo json_encode($resp);
    }

    public function subs(){
        $subm_data = json_decode(file_get_contents('php://input'), TRUE);
        $resp['success'] = FALSE;
        $resp['error'] = '';
        $subs = $this->race_model->getSubs($subm_data['r_id']);
        if ($subs !== FALSE){
            $resp['sub_races'] = $subs;
            $resp['success'] = TRUE;
            $resp['r_id'] = $subm_data['r_id'];
        }
        header("Content-Type: application/json");
        echo json_encode($resp);
    }

    public function features(){
        $subm_data = json_decode(file_get_contents('php://input'), TRUE);
        $resp['success'] = FALSE;
        $resp['error'] = '';
        $feats = $this->race_model->getFeats($subm_data['r_id']);
        if ($feats !== FALSE){
            $fec = count($feats);
            for ($i = 0; $i < $fec; $i++){
                $resp['race_features'][$i]['race_feature_id'] = $feats[$i]['race_feature_id'];
                $resp['race_features'][$i]['feature']['feature_id'] = $feats[$i]['feature_id'];
                $resp['race_features'][$i]['feature']['name'] = $feats[$i]['name'];
                $resp['race_features'][$i]['feature']['description'] = $feats[$i]['description'];
                $resp['race_features'][$i]['feature']['options'] = $feats[$i]['options'];
            }
            $resp['success'] = TRUE;
        }
		$resp['r_in'] = $subm_data['r_in'];
        header("Content-Type: application/json");
        echo json_encode($resp);
    }
}
