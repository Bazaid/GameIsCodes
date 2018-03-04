<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('auth');
	$this->load->library('form_validation');
	if ($this->auth->check_login())
	redirect('dashboard');
	}

	public function index($error = '')
	{
		$data['error'] = $error;
		 $this->load->view('main',$data);	
	}
	
	public function dashboard()
	{
		$this->load->view('dashboard');
	}
	
    public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$username = $this->input->post('username');
	    $password = $this->input->post('password');
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
		if($this->auth->login($username,$password)){
        redirect('dashboard');
		}else {
		$this->index('check your username or password :)');
		  }
		}

	}
	
    public function register()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		
		$username = $this->input->post('username');
	    $password = $this->input->post('password');
		$email = $this->input->post('email');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
		if($this->auth->register($username,$password,$email)){
        if($this->auth->login($username,$password))
		{
			redirect('dashboard');
		}
		}else {
		$this->index('username allready used :)');
		  }
		}

	}

}


/* End of file main.php */
/* Location: ./application/controllers/main.php */