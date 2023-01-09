<?php
class MY_Controller extends CI_Controller{
	function __construct()
	{
		parent::__construct();
	}
	function _footer(){
		$this->load->view('footer');
	}
	function _head(){ //앞에 _(언더바)가 붙으면 URI 라우팅에 대해 프라이빗한 함수가 된다. (URI에 입력함으로서 접근할 수 없음)
		var_dump($this->session->userdata('session_test')); //userdata의 ''이름의 정보를 var_dump타입으로 표시함
		$this->session->set_userdata('session_test','username'); //userdata 이름, 저장할 정보를 'set' = 덮어쓰기? 아무튼 저장함

		$this->load->config('opentutorials');
		$this->load->view('head');
	}
	function _sidebar(){
		$topics = $this->Topic_model->gets(); //topic list 즉 제목들...메뉴들
		$this->load->view('topic_list',array('topics'=>$topics));
	}
}
