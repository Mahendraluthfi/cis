<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tps extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->auth->is_logged_in() == false)
	    {	     
	        redirect('login');
	    }
	    $this->load->model('mtps');
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
		$data['content'] = 'tps';
		$data['row'] = $this->db->get('qc_tps')->result();
		$this->load->view('index', $data);
	}

	public function save()
	{
		$cek = $this->db->get_where('qc_tps', array('userTps' => $this->input->post('username')))->num_rows();
		if (empty($cek)) {			
			$data = array(				
					'userTps' => $this->input->post('username'),
					'namaTps' => $this->input->post('nama'),
					'alamat' => $this->input->post('alamat'),
					'namaPic' => $this->input->post('pic'),
					'contactPic' => $this->input->post('hp')
				);
			$this->db->insert('qc_tps', $data);		
			$user = array(
					'idUser' => $this->input->post('username'),	
					'userName' => $this->input->post('nama'),	
					'password' => md5($this->input->post('username')),	
					'level' => 'tps'
				);
			$this->db->insert('qc_user', $user);
			$this->session->set_flashdata('msg', 
	            '<div class="alert alert-info">
	                <strong>Simpan Berhasil !</strong>                
	            </div>');	
		}else{
			$this->session->set_flashdata('msg', 
	            '<div class="alert alert-danger">
	                <strong>Username sudah terdaftar !</strong>                
	            </div>');
		}
		echo json_encode(array("status" => TRUE));
	}

	public function edit($id)
	{
		$data = array(					
				'namaTps' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'namaPic' => $this->input->post('pic'),
				'contactPic' => $this->input->post('hp')
			);
		$this->db->where('userTps', $id);
		$this->db->update('qc_tps', $data);
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-info">
                <strong>Edit Berhasil !</strong>                
            </div>');	
		echo json_encode(array("status" => TRUE));		
	}

	public function get($id)
	{
		$data = $this->db->get_where('qc_tps', array('userTps' => $id))->row();
		echo json_encode($data);
	}

	public function delete($id)
	{
		$this->db->where('userTps', $id);
		$this->db->delete('qc_tps');

		$this->db->where('idUser', $id);
		$this->db->delete('qc_user');		
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-info">
                <strong>Hapus Berhasil !</strong>                
            </div>');	
		redirect('tps','refresh');
	}

	public function reset($id)
	{
		$data['password'] = md5($id);
		$this->db->where('idUser', $id);
		$this->db->update('qc_user', $data);
		$this->session->set_flashdata('msg', 
            '<div class="alert alert-success">
                <strong>Reset Password Berhasil !</strong>                
            </div>');	
		redirect('tps','refresh');
	}
}

/* End of file Tps.php */
/* Location: ./application/controllers/Tps.php */