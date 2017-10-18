<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('user/user_model', 'user');
	}

	public function generate()
	{
		$this->user->generate();
	}

	public function load_top_5()
	{
		$daterange = $this->input->get('daterange');

		if($user_list = $this->user->get_top_5($daterange))
		{
			$this->_message['success'] = TRUE;
			$this->_message['info'] = $user_list;
		}

		echo json_encode($this->_message);
	}

}

/* End of file User.php */
/* Location: ./application/modules/user/controllers/User.php */