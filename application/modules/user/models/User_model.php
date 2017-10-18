<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function generate()
	{
		if(!$this->_valid_generate()) return FALSE;

		$data = array();
		for($i = 1; $i < 1001; $i++)
		{
			$data[$i]['firstname'] = 'firstname_' . $i;
			$data[$i]['middlename'] = 'middlename_' . $i;
			$data[$i]['lastname'] = 'lastname_' . $i;
		}

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";

		$this->db->insert_batch('user', $data);
	}

	public function get_user()
	{
		$query = $this->db->select('*')
			->from('user')
			->join('user_task', 'user_task.user_id = user.id')
		->get();

		if($result = $query->result_array())
		{
			return $result;
		}
		else
		{
			return FALSE;
		}
	}

	private function _valid_generate()
	{
		$query = $this->db->get('user');

		if($query->num_rows() > 999)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

}

/* End of file User_model.php */
/* Location: ./application/modules/user/models/User_model.php */