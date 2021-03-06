<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->auth->is_logged_in() == false)
	    {	     
	        redirect('login');
	    }
	    $this->load->model('mprofile');
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
		$data['num_tps'] = $this->db->get('qc_tps')->num_rows();
		$data['num_profile'] = $this->db->get('qc_profile')->num_rows();
		$data['show'] = $this->mprofile->show()->result();		
		$data['menu'] = $this->_menu();									
		$data['content'] = 'dashboard';
		$this->load->view('index', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */