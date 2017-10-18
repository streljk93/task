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
		$date_start = date_create('2017-01-01');
		$date_end = date_create('2017-01-10');
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
		for($i = 1; $i < 2001; $i++)
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

	public function get_task($length, $start, $order, $columns, $pagination_data)
	{
		$query = $this->_get_task_query($pagination_data);
		$query = $query->limit($length, $start);
		$column_name = $columns[$order[0]['column']]['data'];
		if($column_name === 'firstname')
			$query = $query->order_by('userlist.' . $column_name, $order[0]['dir']);
		else
			$query = $query->order_by($column_name, $order[0]['dir']);
		$query = $query->get();

		if($result = $query->result_array())
		{
			return $result;
		}
		else
		{
			return array();
		}
	}

	public function get_task_count($pagination_data)
	{
		$query = $this->_get_task_query($pagination_data)->get();

		return $query->num_rows();
	}

	private function _get_task_query($pagination_data)
	{
		$this->db->select('task.*, director.firstname as director_firstname, director.middlename as director_middlename, director.lastname as director_lastname, status.name as status_name');
		$this->db->from('task');
		$this->db->join('user as director', 'director.id = task.director_id');
		$this->db->join('user_task', 'user_task.task_id = task.id');
		$this->db->join('user as userlist', 'userlist.id = user_task.user_id');

		// get date range
		if($pagination_data && isset($pagination_data['daterange']))
			$this->db->where('("start", "end") OVERLAPS (\'' . $pagination_data['daterange']['start'] . '\'::DATE, \'' . $pagination_data['daterange']['end'] . '\'::DATE)', NULL, FALSE);

		// get overdue date
		if($pagination_data && isset($pagination_data['overdue']))
		{
			$this->db->where('"end" < ', 'now()', FALSE);
			$this->db->where('status_id', 2);
		}

		// get user list
		if($pagination_data && isset($pagination_data['not_once_user']))
		{
			$this->db->group_by('task.id, director.id, status.id');
			$this->db->having('COUNT(userlist.id) > 1');
		}

		// get director (search)
		if($pagination_data && isset($pagination_data['query_director']))
		{
			$this->db->like('director.firstname', $pagination_data['query_director']);
		}

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

	public function get_max_date()
	{
		$query = $this->db->select('MAX("end") as max_date', FALSE)
			->from('task')
		->get();

		if($result = $query->row_array())
		{
			return $result['max_date'];
		}
		else
		{
			return FALSE;
		}
	}

	public function get_min_date()
	{
		$query = $this->db->select('MIN("start") as min_date', FALSE)
			->from('task')
		->get();

		if($result = $query->row_array())
		{
			return $result['min_date'];
		}
		else
		{
			return FALSE;
		}
	}

}

/* End of file Task_model.php */
/* Location: ./application/modules/task/models/Task_model.php */