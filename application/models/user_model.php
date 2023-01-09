<?php
class User_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function add($option)
	{
		$this->db->set('email', $option['email']);
		$this->db->set('password', $option['password']);
		$this->db->set('created', 'NOW()', false);
		$this->db->insert('user');
		$result = $this->db->insert_id();
		return $result;
	}

	function getByEmail($option)//구체적이지 않는 네이밍을 사용하여 데이터를 유용하게 활용하기 위함.
	{
		$result = $this->db->get_where('user', array('email'=>$option['email']))->row(); //액티브레코드로 작성함. 표준 sql 문법임.(공용어 정도)
		return $result;
	}

}
