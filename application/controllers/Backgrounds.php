<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Backgrounds extends MY_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('background_model');
	}

    public function list(){
        $resp['success'] = FALSE;
        $resp['error'] = '';
        $BGs = $this->background_model->getBGs();
        if ($BGs !== FALSE){
            $bgc = count($BGs);
            for ($i = 0; $i < $bgc; $i++){
                $resp['backgrounds'][$i]['background_id'] = $BGs[$i]['background_id'];
                $resp['backgrounds'][$i]['characteristic'] = $BGs[$i]['characteristic'];
                $resp['backgrounds'][$i]['description'] = $BGs[$i]['bg_desc'];
                $resp['backgrounds'][$i]['name'] = $BGs[$i]['bg_name'];
                $resp['backgrounds'][$i]['feature']['feature_id'] = $BGs[$i]['feature_id'];
                $resp['backgrounds'][$i]['feature']['name'] = $BGs[$i]['feat_name'];
                $resp['backgrounds'][$i]['feature']['description'] = $BGs[$i]['feat_desc'];
                $resp['backgrounds'][$i]['feature']['options'] = $BGs[$i]['options'];
            }
            $resp['success'] = TRUE;
        }
        header("Content-Type: application/json");
        echo json_encode($resp);
    }
}
