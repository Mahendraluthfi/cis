<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MProfile extends CI_Model {

	public function show()
	{
		$this->db->select('*');
		$this->db->from('qc_profile');
		$this->db->join('kabkot', 'kabkot.id_kabkot = qc_profile.idKab');
		$this->db->where('qc_profile.status', '1');
		$db = $this->db->get();
		return $db;
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('qc_profile');
		$this->db->join('kabkot', 'kabkot.id_kabkot = qc_profile.idKab');
		$this->db->join('prov', 'prov.id_prov = kabkot.id_prov');		
		$this->db->where('qc_profile.noUrut', $id);
		$db = $this->db->get();
		return $db;	
	}
}

/* End of file mProfile.php */
/* Location: ./application/models/mProfile.php */