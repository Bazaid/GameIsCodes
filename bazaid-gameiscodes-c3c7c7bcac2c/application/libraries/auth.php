<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth
{
    public $team  = array();
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('auth_model');
		$this->CI->load->library('session');
	}
    
    public function login($username,$password)
    {
   if ($this->CI->auth_model->check_user($username,$password) > 0){
    $id = $this->CI->auth_model->get_id($username);
    $newdata = array(
                   'username'  => $username,
                   'user_id' => $id,
                   'logged_in' => TRUE
               );
$this->CI->session->set_userdata($newdata);
 return true;
}else{
return false;
}
    }
    
	
    public function register($username,$password,$email)
    {
		return $this->CI->auth_model->register($username,$password,$email);
    }
    
    public function logout()
    {
    $this->session->sess_destroy();
    
    }
    public function check_login()
    {
    if ($this->CI->session->userdata('logged_in'))
    {
    return TRUE;
    }else{
    return FALSE;
    }
    
    }
}

