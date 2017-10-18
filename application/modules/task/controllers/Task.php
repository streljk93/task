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

		$count = $this->task->get_task_count();
    $task_list = $this->task->get_task($length, $start, $order, $columns);
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

}

/* End of file Task.php */
/* Location: ./application/modules/task/controllers/Task.php */