<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->auth->is_logged_in() == false)
	    {	     
	        redirect('login');
	    }	 
	    $this->load->model('mInput');   
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
		$data['content'] = 'input';
		$data['view'] = $this->db->get_where('qc_tps', array('userTps' => $this->session->userdata('idUsers')))->row();		
		$data['caleg'] = $this->mInput->select_caleg()->result();
		$data['row'] = $this->mInput->get()->result();
		$this->load->view('index', $data);
	}

	public function get($id)
	{
		$data = $this->mInput->_get($id)->row();
		echo json_encode($data);
	}

	public function save()
	{
		$nmfile = 'IMG-'.date('dHis'); 		
		$config['upload_path']          = './asset/foto/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['max_width']            = 1900;
        $config['max_height']           = 1200;
        $config['file_name'] 			= $nmfile;         

        $this->load->library('upload', $config);

        if (!empty($_FILES['file']['name'])) {
	        if ( ! $this->upload->do_upload('file')){
	            $error = array('error' => $this->upload->display_errors());
	            //$this->load->view('upload_form', $error);
	            echo $error['error'];
	        }else{
	            $data = $this->upload->data();
	            $tmpname1 = $data['file_name'];
	            //$this->load->view('upload_success', $data);
	            //echo "sukses";
	        }
	    }else{
	    	$tmpname1 = '0';
	    }

	    $percent = ($this->input->post('sah') / $this->input->post('dari')) * 100;

	    $data = array(
	    	'noUrut' => $this->input->post('nourut'),
	    	'userTps' => $this->session->userdata('idUsers'),
	    	'date' => $this->input->post('date'),
	    	'suara_in' => $this->input->post('sah'),
	    	'suara_all' => $this->input->post('dari'),
	    	'suara_percent' => round($percent, 1),
	    	'file' => $tmpname1,
	    	'keterangan' => $this->input->post('ket')
	    );

	    $this->db->insert('qc_suara', $data);
		$this->session->set_flashdata('msg', 
	    '<div class="alert alert-info">
	        <strong>Simpan Berhasil !</strong>                
	    </div>');	
	    redirect('input','refresh');
	}

	public function edit($id)
	{
	    $percent = ($this->input->post('sah') / $this->input->post('dari')) * 100;
		$nmfile = 'IMG-'.date('dHis'); 		
		$config['upload_path']          = './asset/foto/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['max_width']            = 1900;
        $config['max_height']           = 1200;
        $config['file_name'] 			= $nmfile;         

        $this->load->library('upload', $config);

        if (!empty($_FILES['file']['name'])) {
	        if ( ! $this->upload->do_upload('file')){
	            $error = array('error' => $this->upload->display_errors());
	            //$this->load->view('upload_form', $error);
	            echo $error['error'];
	        }else{
	            $data = $this->upload->data();
	            $tmpname1 = $data['file_name'];
	            //$this->load->view('upload_success', $data);
	            //echo "sukses";
	        }
	        $data = array(
		    	'date' => $this->input->post('date'),
		    	'suara_in' => $this->input->post('sah'),
		    	'suara_all' => $this->input->post('dari'),
		    	'suara_percent' => round($percent, 1),	    	
		    	'file' => $tmpname1,	    	
		    	'keterangan' => $this->input->post('ket')
		    );
	    }else{	    	
		    $data = array(
		    	'date' => $this->input->post('date'),
		    	'suara_in' => $this->input->post('sah'),
		    	'suara_all' => $this->input->post('dari'),
		    	'suara_percent' => round($percent, 1),	    	
		    	'keterangan' => $this->input->post('ket')
		    );
	    }

	    $this->db->where('id', $id);
	    $this->db->update('qc_suara', $data);
		$this->session->set_flashdata('msg', 
	    '<div class="alert alert-info">
	        <strong>Editx Berhasil !</strong>                
	    </div>');	
	    redirect('input','refresh');
	}

	public function delete($id,$foto)
	{
		$file = './asset/foto/'.$foto;

		if ($foto !== '0') {
			unlink($file);			
		}
		$this->db->where('id', $id);
		$this->db->delete('qc_suara');

		redirect('input','refresh');
	}

}

/* End of file Input.php */
/* Location: ./application/controllers/Input.php */