<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MInput extends CI_Model {

	public function get()
	{
		$id = $this->session->userdata('idUsers');
		$this->db->select('*');
		$this->db->from('qc_profile');
		$this->db->join('qc_suara', 'qc_suara.noUrut = qc_profile.noUrut', 'left');
		$this->db->where('qc_suara.userTps', $id);
		$db = $this->db->get();
		return $db;
	}

	public function _get($id)
	{
		$this->db->select('*, qc_suara.id as idsuara');
		$this->db->from('qc_suara');
		$this->db->join('qc_profile', 'qc_suara.noUrut = qc_profile.noUrut');
		$this->db->where('qc_suara.id', $id);
		$db = $this->db->get();
		return $db;	
	}

	public function select_caleg()
	{
		$id = $this->session->userdata('idUsers');
		$db = $this->db->query("SELECT * FROM qc_profile WHERE NOT noUrut IN (SELECT noUrut FROM qc_suara WHERE userTps='$id')");		 
		return $db;	

	}

}

/* End of file mInput.php */
/* Location: ./application/models/mInput.php */