<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
		$data['show'] = $this->mprofile->show()->result();
		$data['prov'] = $this->db->get('prov')->result();
		$data['content'] = 'profile';
		$this->load->view('index', $data);
	}

	public function get($id)
	{
		$data = $this->mprofile->get($id)->row();
		echo json_encode($data);
	}

	public function get_kabkot()
	{
		$id = $this->input->post('id');
		$data = $this->db->get_where('kabkot', array('id_prov' => $id))->result();
		echo json_encode($data);
	}

	public function save()
	{
		$cek = $this->db->get_where('qc_profile', array('noUrut' => $this->input->post('nourut')))->num_rows();
		if (empty($cek)) {			
			$data = array(				
					'noUrut' => $this->input->post('nourut'),
					'idKab' => $this->input->post('kabkot'),
					'calonLegislatif' => $this->input->post('caleg')
				);
			$this->db->insert('qc_profile', $data);		
			$this->session->set_flashdata('msg', 
	            '<div class="alert alert-info">
	                <strong>Simpan Berhasil !</strong>                
	            </div>');	
		}else{
			$this->session->set_flashdata('msg', 
	            '<div class="alert alert-danger">
	                <strong>Nomor Urut sudah terdaftar !</strong>                
	            </div>');
		}
		echo json_encode(array("status" => TRUE));
	}

	public function edit($id)
	{
		$data = array(								
				'idKab' => $this->input->post('kabkot'),
				'calonLegislatif' => $this->input->post('caleg')
		);
		$this->db->where('noUrut', $id);
		$this->db->update('qc_profile', $data);
			$this->session->set_flashdata('msg', 
	            '<div class="alert alert-info">
	                <strong>Edit Berhasil !</strong>                
	            </div>');
		echo json_encode(array("status" => TRUE));			
	}

	public function delete($id)
	{
		$this->db->where('noUrut', $id);
		$this->db->delete('qc_profile');
		$this->session->set_flashdata('msg', 
	            '<div class="alert alert-info">
	                <strong>Data berhasil dihapus !</strong>                
	            </div>');
		redirect('profile','refresh');
	}
}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */