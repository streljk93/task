<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('common/layout_model', 'layout');
	}

	public function index()
	{
		$this->layout->set(array(
			'page_name' => 'TASK',
			'page_content' => $this->parser->parse('task_view', $this->_data, TRUE),
		));
		$this->layout->get('master');
	}

}

/* End of file Task.php */
/* Location: ./application/modules/task/controllers/Task.php */