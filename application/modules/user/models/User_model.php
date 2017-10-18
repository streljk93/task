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
		for($i = 1; $i < 2001; $i++)
		{
			$data[$i]['firstname'] = 'first_' . $i;
			$data[$i]['middlename'] = 'middle_' . $i;
			$data[$i]['lastname'] = 'last_' . $i;
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

	public function get_top_5($daterange)
	{
		$this->db->select('"user".*, COUNT("user_task"."user_id") as "task_count"', FALSE);
		$this->db->from('user');
		$this->db->join('user_task', 'user_task.user_id = user.id');
		$this->db->join('task', 'task.id = user_task.task_id');

		if($daterange !== 'false')
		{
			$daterange = json_decode($daterange, TRUE);
			$this->db->where('("start", "end") OVERLAPS (\'' . $daterange['start'] . '\'::DATE, \'' . $daterange['end'] . '\'::DATE)', NULL, FALSE);
		}

		$this->db->group_by('user.id');
		$this->db->order_by('task_count', 'desc');
		$this->db->limit(5);
		$query = $this->db->get();

		if($result = $query->result_array())
		{
			return $result;
		}
		else
		{
			return FALSE;
		}

	}

}

/* End of file User_model.php */
/* Location: ./application/modules/user/models/User_model.php */