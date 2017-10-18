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

}

/* End of file User.php */
/* Location: ./application/modules/user/controllers/User.php */