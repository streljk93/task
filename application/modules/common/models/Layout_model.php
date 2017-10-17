<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout_model extends CI_Model {

	private $_parts = array(
		'meta',
		'link',
		'script',
	);

	private $_data = array();

	public function __construct()
	{
		parent::__construct();
	}

	public function set($data)
	{
		$this->_data = $data;
	}

	public function get($layout_name)
	{
		foreach($this->_parts as $part)
		{
			$this->_data['part_' . $part] = $this->parser->parse('../layouts/parts/' . $part, $this->_data, TRUE);
		}
		$this->parser->parse('../layouts/' . $layout_name, $this->_data);
	}

}

/* End of file Layout_model.php */
/* Location: ./application/modules/common/models/Layout_model.php */