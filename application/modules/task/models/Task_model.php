<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function generate()
	{
		if(!$this->_valid_generate()) return FALSE;

		$data = array();
		$date_end = date_create('2017-01-01');
		$date_start = date_create('2017-01-10');
		for($i = 1; $i < 1001; $i++)
		{
			$data[$i]['id'] = $i;
			$data[$i]['name'] = 'taskname_' . $i;
			$data[$i]['description'] = $i . 'descr' . $i . 'ption';
			date_modify($date_start, '+1 day');
			$data[$i]['start'] = date_format($date_start, 'Y-m-d');
			date_modify($date_end, '+1 day');
			$data[$i]['end'] = date_format($date_end, 'Y-m-d');
			$data[$i]['important'] = rand(1, 5);
			$data[$i]['director_id'] = rand(1, 1000);

			if(strtotime($data[$i]['start']) > strtotime('now'))
			{
				$data[$i]['status_id'] = 2;
			}
			else
			{
				$data[$i]['status_id'] = rand(1, 2);
			}
		}

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";

		$this->db->insert_batch('task', $data);

		return TRUE;
	}

	public function generate_user_task()
	{
		if(!$this->_valid_generate_user_task()) return FALSE;

		$data = array();
		for($i = 1; $i < 1001; $i++)
		{
			$data[$i]['user_id'] = rand(1, 1000);
			$data[$i]['task_id'] = rand(1, 1000);
		}

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";

		$this->db->insert_batch('user_task', $data);

		return TRUE;
	}

	public function get_task($length, $start, $order, $columns)
	{
		$query = $this->_get_task_query();
		$query = $query->limit($length, $start);
		$column_name = $columns[$order[0]['column']]['data'];
		$query = $query->order_by($column_name, $order[0]['dir']);
		$query = $query->get();

		if($result = $query->result_array())
		{
			return $result;
		}
		else
		{
			return FALSE;
		}
	}

	public function get_task_count()
	{
		$query = $this->_get_task_query()->get();

		return $query->num_rows();
	}

	private function _get_task_query()
	{
		$this->db->select('task.*, user.firstname as director_firstname, user.middlename as director_middlename, user.lastname as director_lastname, status.name as status_name');
		$this->db->from('task');
		$this->db->join('user', 'user.id = task.director_id');
		$query = $this->db->join('status', 'status.id = task.status_id');
		

		return $query;
	}

	private function _valid_generate_user_task()
	{
		if($this->db->get('user_task')->num_rows() > 999)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	private function _valid_generate()
	{
		$query = $this->db->select('*')
			->from('task')
		->get();

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

/* End of file Task_model.php */
/* Location: ./application/modules/task/models/Task_model.php */