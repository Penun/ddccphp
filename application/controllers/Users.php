<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

    public function index(){
        $user = $this->auth->getUser();
        $resp['success'] = false;
        $resp['error'] = '';
        $resp['users'] = $this->user_model->get_users($user['clearance'], $user['group']);
        $resp['cur_us'] = $user['user_id'];

        if ($resp['users'] !== false){
            $resp['success'] = true;
            for ($i = 0; $i < count($resp['users']); $i++){
                unset($resp['users'][$i]['password']);
            }
            $resp['users'] = $this->_SortUsers($resp['users'], $user['user_id'], 0);
        }

        header('Content-Type: application/json');
        echo json_encode($resp);
    }

    private function _SortUsers($users, $lead_id, $cur_in){
        $return_users = $users;
        if ($users[$cur_in]['user_id'] != $lead_id){
            $return_users = $this->_SortUsers($users, $lead_id, $cur_in + 1);
            $temp = $return_users[$cur_in + 1];
            $return_users[$cur_in + 1] = $return_users[$cur_in];
            $return_users[$cur_in] = $temp;
        }
        return $return_users;
    }
}
