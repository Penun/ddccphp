<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Classes extends MY_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('class_model');
	}

    public function list(){
        $resp['success'] = FALSE;
        $resp['error'] = '';
        $classes = $this->class_model->getClasses();
        if ($classes !== FALSE){
            $resp['classes'] = $classes;
            $resp['success'] = TRUE;
        }
        header("Content-Type: application/json");
        echo json_encode($resp);
    }

	public function paths(){
		$subm_data = json_decode(file_get_contents('php://input'), TRUE);
		$resp['success'] =  FALSE;
		$resp['error'] = '';
		$clasps = $this->class_model->getPaths($subm_data['c_id']);
		if ($clasps !== FALSE){
			$resp['success'] = TRUE;
			$resp['c_id'] = $subm_data['c_id'];
			$resp['class_paths'] = $clasps;
		}
		header("Content-Type: application/json");
		echo json_encode($resp);
	}
}
