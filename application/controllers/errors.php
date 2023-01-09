<?php
class Errors extends CI_Controller{
	public function notfound(){
		$this->load->view('head');
//		echo '페이지가 존재하지 않습니다!';
		$this->load->view('errors/404');
		$this->load->view('footer');
	}
}
