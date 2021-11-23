<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_coa extends CI_Model {

	public function get_head_coa()
	{
		$this->db->where('neraca_lr','1');
		$this->db->order_by('id_head_coa', 'asc');
		return $this->db->get('head_coa')->result();
	}

	public function get_head_coalr()
	{
		$this->db->where('neraca_lr','0');
		$this->db->order_by('id_head_coa', 'asc');
		return $this->db->get('head_coa')->result();
	}

	public function get_main_coa()
	{	
		$this->db->select('*');
		$this->db->from('main_coa');
		$this->db->join('head_coa',"head_coa.no_coa_head = 'main_coa.no_coa_head'",'left');
		$this->db->where('neraca_lr','1');
		$this->db->order_by('id_main_coa', 'asc');
		return $this->db->get()->result();
	}

	public function get_main_coalr()
	{	
		$this->db->select('*');
		$this->db->from('main_coa');
		$this->db->join('head_coa', "head_coa.no_coa_head = 'main_coa.no_coa_head'",'left');
		$this->db->where('neraca_lr','0');
		$this->db->order_by('id_main_coa', 'asc');
		return $this->db->get()->result();
	}

	public function hapus($id)
	{
		$this->db->where('id_des_coa', $id);
		$this->db->delete('des_coa');
	}

	public function simpan_hc($arr)
	{
		return $this->db->insert('head_coa', $arr);
	}

	public function simpan_mcn($arr)
	{
		return $this->db->insert('main_coa', $arr);
	}

	public function simpan_dcn($arr)
	{
		return $this->db->insert('des_coa', $arr);
	}

	public function edit($id)
	{
		$this->db->select('*');
	    $this->db->from('head_coa');
	    $this->db->where('id_head_coa', $id);
	    $query = $this->db->get();
	    if ($this->db->affected_rows() > 0) {
	      foreach ($query->result() as $row) {
	        $data = array(
	                'id_head_coa' => $row->id_head_coa,
	                'no_coa_head' => $row->no_coa_head,
	                'head_coa'	  => $row->head_coa,
	                'neraca_lr'	  => $row->neraca_lr	                	
	        );
      }
	}
	return $data;
	}

	public function update($arr)
	{
		$this->db->where('id_head_coa',$arr['id_head_coa']);
		return $this->db->update('head_coa',$arr);
	}


	public function update_head($id_head,$head)
	{
		$this->db->where('id_head_coa', $id_head);
		$this->db->update('head_coa', $head);
	}

	public function update_main($id_main,$main)
	{
		$this->db->where('id_main_coa', $id_main);
		$this->db->update('main_coa', $main);
	}

	public function update_des($id_des,$arr)
	{
		$this->db->where('id_des_coa', $id_des);
		$this->db->update('des_coa', $arr);
	}

	// public function add_column()
	// {
	// 	$this->db->query('ALTER TABLE des_coa ADD no_coa_main varchar(255)');	
	// }

	// public function drop_column()
	// {
	// 	$this->db->query('ALTER TABLE des_coa DROP COLUMN no_coa_main');	
	// }

	// public function update_mains()
	// {
	// 	$get = $this->db->query('select id_des_coa,main_coa.id_main_coa,des_coa.no_coa_main,main_coa.id_main_coa as imc from des_coa join main_coa on des_coa.no_coa_main = main_coa.no_coa_main')->result();
	// 	foreach ($get as $var) {
	// 		$idm = array('id_main_coa' => $var->imc);
	// 		$ids = $var->id_des_coa;

	// 		$this->db->where('id_des_coa', $ids);
	// 		$this->db->update('des_coa', $idm);
	// 	}

	// }

}

/* End of file  */
/* Location: ./application/models/ */