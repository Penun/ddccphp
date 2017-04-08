<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
*  This is the auth class.  This handles all authorization matters.
*/


class Auth {

	private $ci;
	private $salt;
	private $login = FALSE;
	private $user = array();

	function __construct()
	{
		$this->ci =& get_instance();

		//Get the salt for user in login functions.
		$this->salt = $this->ci->config->item('salt');
		if(empty($this->salt))
		{
			show_error('Unable to retrieve salt.');
		}
		$this->__load_user();
	}

	/*
	* This function checks of the user is logged in.
	*/
	public function is_logged_in()
	{
		return $this->login;
	}

	/*
	* This function checks if the user is logged in.  If not, it redirects the user to the login url.
	*/
	public function verify()
	{
		if($this->login == FALSE)
		{
			header('Refresh:0; url=http://127.0.0.1/index.php/login');
			//header('Location: http://www.dafrank.com/login');
			exit();
		}
		else
		{
			return $this->user;
		}
	}

	/*
	* Logs in the user.
	*/
	public function login($username, $password)
	{
		$password = sha1($this->salt . $password);
        $user = $this->ci->user_model->login($username, $password);
		if($user == FALSE)
		{
			return $this->login;
		}
		else
		{
			$this->__load_user($user);
			$this->__set_session();
			return $user;
		}
	}

	public function getUser(){
		return $this->user;
	}

	/*
	*  Get the user's data and load them into a variable.
	*/
	private function __load_user($user = array())
	{
		if(empty($user))
		{
			$user = $this->ci->session->userdata('user');
		}
		$this->user = $user;
		if(!empty($this->user))
		{
			$this->login = TRUE;
		}
	}

	/*
	* Sets the session
	*/
	private function __set_session()
	{
		$this->ci->session->set_userdata('user',$this->user);
	}

	/*
	* Forces a user to login.
	*/
	public function force_login($id)
	{
		 if(!($user = $this->ci->manager_model->get($id)))
		 {
			$this->login = FALSE;
			$this->__load_user($user);
			$this->__set_session();
			return $this->login;
		 }
		 else
		 {
			return $user;
		 }

	}

	public function logout()
	{
		$this->ci->session->unset_userdata('userdata');
		$this->ci->session->sess_destroy();
	}

	//Takes a clean passwords and converts it to a salted/hashed password.
	//returns the safe password.
	public function safe_password($password)
	{
		return sha1($this->salt . $password);
	}

	public function reset_password($userid)
	{
		$pass = $this->generate_code();
		$data = array();
		$data['password'] = $this->safe_password($pass);
		$this->ci->manager_model->edit_user($userid,$data);
		return $pass;
	}

	//Generate a random string for a password.
	public function generate_code($len=8)
	{
		$base='ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz123456789';
		$max=strlen($base)-1;
		$code='';
		mt_srand((double)microtime()*1000000);
		while (strlen($code)<$len+1)
		{
		  $code.=$base{mt_rand(0,$max)};
		}

		return $code;
	}
}
