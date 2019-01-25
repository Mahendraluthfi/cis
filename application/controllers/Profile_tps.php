<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_tps extends CI_Controller {

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
		$data['menu'] = $this->_menu();								
		$data['view'] = $this->db->get_where('qc_tps', array('userTps' => $this->session->userdata('idUsers')))->row();
		$data['content'] = 'profile_tps';
		$this->load->view('index', $data);
	}

}

/* End of file Profile_tps.php */
/* Location: ./application/controllers/Profile_tps.php */