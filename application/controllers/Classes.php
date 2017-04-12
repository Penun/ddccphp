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
}
