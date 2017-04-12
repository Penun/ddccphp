<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	var $form_rules = array();

    public function __construct() {
        parent::__construct();
        $this->load->library('Auth');
		$this->_populate_form_rules();
    }

	public function index() {
        if ($this->auth->is_logged_in())
        {
            header('Refresh:0; url=http://127.0.0.1/index.php/main');
            //header('Location: http://www.dafrank.com');
        }

		//$salt = $this->config->item('salt');
		//$data['pass'] = sha1($salt . 'test');

        $this->load->library('form_validation');
		$subm_data = json_decode(file_get_contents('php://input'), true);
        if ($subm_data != null){
			$this->form_validation->set_data($subm_data);
		}
        $this->form_validation->set_rules($this->form_rules['login']);
        if (!$this->form_validation->run())
        {
            $this->load->view('login');
        }
        else
        {
			$resp = array('success' => false, 'error' => '');
            $resp['user_name'] = $username = $subm_data['user_name'];
			$resp['password'] = $password = $subm_data['password'];
			$resp['password_hash'] = sha1($this->config->item('salt') . $password);
			$user = $this->auth->login($username,$password);
			if($user !== FALSE && is_array($user)) {
				$resp['success'] = true;
            } else {
				$resp['error'] = 'User not found.';
			}
			header('Content-Type: application/json');
			echo json_encode($resp);
        }
    }

	public function logout(){
		$this->auth->verify();
		if ($this->auth->is_logged_in()){
			$this->auth->logout();
			$resp['success'] = TRUE;
			$resp['error'] = '';
		}
	}

    private function _populate_form_rules() {
		$this->form_rules = array(
			'login'=>array(
				array(
					'field'=>'user_name',
					'label'=>'Username',
					'rules'=>'required|trim'
				),
				array(
					'field'=>'password',
					'label'=>'Password',
					'rules'=>'required|trim'
				)
			)
		);
	}
}
