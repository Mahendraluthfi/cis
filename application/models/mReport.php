<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MReport extends CI_Model {

	public function report()
	{
		$this->db->select('*');	
		$this->db->from('qc_suara');
		$this->db->join('qc_profile', 'qc_suara.noUrut = qc_profile.noUrut');
		$this->db->join('qc_tps', 'qc_suara.userTps = qc_tps.userTps');
		$db = $this->db->get();
		return $db;
	}	


}

/* End of file mReport.php */
/* Location: ./application/models/mReport.php */