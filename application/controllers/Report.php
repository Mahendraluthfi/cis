<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->auth->is_logged_in() == false)
	    {	     
	        redirect('login');
	    }	  
	    $this->load->model('mreport');  
	}

	public function _menu()
	{
		if ($this->session->userdata('level') == "administrator") {
			$menu = 'menu_admin';			
		}else{
			$menu = 'menu_tps';						
		}			
		return $menu;
	}

	public function index()
	{		
		$data['view'] = $this->mreport->report()->result();
		$data['menu'] = $this->_menu();									
		$data['content'] = 'report';
		$this->load->view('index', $data);
	}

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */