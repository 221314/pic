<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topic extends CI_Controller {
    function __construct(){ //생성자 : 클래스가 생성될 때 함께 생성되는 초기화 함수. 공통적으로 필요한 동작이 있을때 작성
        parent::__construct();

        $this->load->database();
        $this->load->model('Topic_model');
    }

	public function index() //URI 입력할때 호출할 함수 안쓰면 디폴트로 index()로 들어옴
	{
        $topics = $this->Topic_model->gets(); //내용전체

        $this->load->view('head');
        $this->load->view('topic_list',array('topics'=>$topics)); 
        $this->load->view('main');
        $this->load->view('footer');
    }
    function get($id){ //localhost/index.php/get/전달하려는파라미터
    
        $topics = $this->Topic_model->gets();
        $topic = $this->Topic_model->get($id);

        $this->load->view('head');
        $this->load->view('topic_list', array('topics'=>$topics));
        $this->load->view('get',array('topic'=>$topic)); //('확장자를 제외한 파일 이름',데이터 배열) <=그래서 배열로 만들어줌 array();
        $this->load->view('footer');
    }
}
?>