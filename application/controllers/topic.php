<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//클래스명의 첫글자는 반드시 대문자(나머지는 소문자로 쓰는게 좋을듯!)
class Topic extends MY_Controller {
    function __construct(){ //생성자 : 클래스가 생성될 때 함께 생성되는 초기화 함수. 공통적으로 필요한 동작이 있을때 작성
        parent::__construct();

        $this->load->database();
        $this->load->model('Topic_model');
		$this->load->helper('url');
		log_message('debug', 'topic 초기화'); //log_message(로그타입, 로그메시지);
									//application/logs 디렉토리에 로그파일이 생성되고, log_message의 내용이 기록된다.
    }
	public function index() //URI 입력할때 호출할 함수 안쓰면 디폴트로 index()로 들어옴
	{
		$this->_head();
		$this->_sidebar();
        $this->load->view('main');
       	$this->_footer();
    }
    function get($id){ //localhost/index.php/get/전달하려는파라미터
		log_message('debug', 'get 호출');
		$this->_head();
		$this->_sidebar();

		$topic = $this->Topic_model->get($id); //본문 내용
		if(empty($topic)){
			log_message('error', 'topic의 값이 없습니다');
			show_error('topic의 값이 없습니다');
		}

        $this->load->helper(array('url','HTML','kor')); //_helper는 생략할 수 있음. 다 써도 상관없음. array를 이용해 복수의 helper를 호출함.
		log_message('debug', 'get view 로딩');
        $this->load->view('get',array('topic'=>$topic)); //('확장자를 제외한 파일 이름',데이터 배열) <=그래서 배열로 만들어줌 array();

		log_message('debug', 'footer view 로딩');
		$this->_footer();
    }
    function add(){
    	//게시글을 추가하려면 로그인이 필요

		//로그인이 되어 있지 않다면 로그인 페이지로 리다이렉션
		if(!$this->session->userdata('is_login')){
			redirect('/auth/login?returnURL='.rawurlencode(site_url('/topic/add')));
									// URL에서 ? 는 뒤로 오는 문자는 파라미터 임을 의미함.
									// rawurlencode() : '?'같은 특수한 성질을 갖는 문자가 여러개 사용될 때, 단순한 문자열이 아님을 표시하기위해 사용하는 php api
									// site_url() : 자동으로 site의 url을 생성하는 php 함수. 도메인이 바뀌어도 자동으로 인식한다
		}
		$this->_head();
		$this->_sidebar();

		$this->load->library('form_validation'); //CI의 lib를 로드 https://codeigniter-kr.org/user_guide_2.1.0/libraries/form_validation.html
		$this->form_validation->set_rules('title','제목','required'); //검사루틴(규칙) 설정. 전달인자는 3개가 필요함.
		$this->form_validation->set_rules('description','본문','required'); // (필드이름(form name), 알아보기 쉬운 이름(에러메세지에 표시됨), 필요한 검사규칙들(|로 구분하여 복수입력)
		if ($this->form_validation->run() == FALSE) //정보(form)의 유효성을 검사하는 CI의 lib class 가 false면(혹은 최초 진입시)
		{
			$this->load->view('add');			//다시 form 화면을 출력함 = 반응이 없음
		}
		else										//false가 아니라면=정보가 유효하다면 아래를 출력함
		{
			$topic_id = $this->Topic_model->add($this->input->post('title'), $this->input->post('description'));
			//$this->load->helper('url'); //url CI_helper를 load함 <생성자로 옮김
			redirect('Topic/get/'.$topic_id); //redirect : 결과페이지로 바로 이동시키는 동작의 api (URI)
												  //url이 [::1]으로 잡혀서 config.php에서 base_url을 수정함
		}
//		echo $this->input->post('title');	//CI의 lib class를 사용한 것임. https://codeigniter-kr.org/user_guide_2.1.0/libraries/input.html
//		echo "내용 : ";
//		echo $this->input->post('description');

		$this->_footer();
	}
	function del($id){

//		echo $id;
		$this->_head();
		$this->_sidebar();
		$this->Topic_model->del($id);
		redirect($this->load->view('main'));

		$this->_footer();
	}
}
?>
