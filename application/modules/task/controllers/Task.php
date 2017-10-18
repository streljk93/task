<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('common/layout_model', 'layout');

		$this->load->model('task/task_model', 'task');
		$this->load->model('user/user_model', 'user');
	}

	public function generate()
	{
		if($this->task->generate())
		{
			echo 'Success!';
		}
		else
		{
			echo 'Rows already insert to database! (1000 rows)';
		}
	}

	public function generate_user_task()
	{
		if($this->task->generate_user_task())
		{
			echo 'Success';
		}
		else
		{
			echo 'User_task already generate';
		}
	}

	public function index()
	{
		$this->layout->set(array(
			'page_name' => 'TASK',

			'script' => array(
				'controller' => 'task',
				'services' => array(
					'task',
					'user',
				),
			),

			'page_content' => $this->parser->parse('task_view', $this->_data, TRUE),
		));

		$this->layout->get('master');
	}

	public function pagination()
	{
		$length = $this->input->get('length');
		$start = $this->input->get('start');
		$order = $this->input->get('order');
		$columns = $this->input->get('columns');
		$pagination_data = $this->input->get('pagination_data');

		$count = $this->task->get_task_count($pagination_data);
    $task_list = $this->task->get_task($length, $start, $order, $columns, $pagination_data);
    if($user_list = $this->user->get_user())
		{
			foreach($user_list as $user)
			{
				foreach($task_list as $key => $task)
				{
					if($task['id'] === $user['task_id'])
					{
						$task_list[$key]['user_list'][] = $user;
					}
				}
			}
		}

		$config['draw'] = ($draw = $this->input->get('draw')) ? intval($draw) : 0;
    $config['recordsTotal'] = $count;
    $config['recordsFiltered'] = $config['recordsTotal'];
    $config['data'] = $task_list;
    // print_r($this->input->get());
    // exit;

    echo json_encode($config);
	}

	public function load_max_date()
	{
		if($max_date = $this->task->get_max_date())
		{
			$this->_message['success'] = TRUE;
			$this->_message['info'] = $max_date;
		}

		echo json_encode($this->_message);
	}

	public function load_min_date()
	{
		if($min_date = $this->task->get_min_date())
		{
			$this->_message['success'] = TRUE;
			$this->_message['info'] = $min_date;
		}

		echo json_encode($this->_message);
	}

}

/* End of file Task.php */
/* Location: ./application/modules/task/controllers/Task.php */