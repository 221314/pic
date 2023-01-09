<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//클래스명의 첫글자는 반드시 대문자(나머지는 소문자로 쓰는게 좋을듯!)
class Auth extends MY_Controller
{
	function __construct()
	{ //생성자 : 클래스가 생성될 때 함께 생성되는 초기화 함수. 공통적으로 필요한 동작이 있을때 작성
		parent::__construct();
		$this->load->helper('url');
	}
	function login(){
		$this->_head();
		$this->load->view('login', array('returnURL'=>$this->input->get('returnURL')));
		$this->_footer();
	}
	function logout(){
		$this->session->sess_destroy(); //세션을 삭제하는 api
		redirect("/");
	}
	function register(){ //회원가입
		$this->_head();

		$this->load->library('form_validation'); //유효성 검사
		$this->form_validation->set_rules('email', '이메일 주소', 'required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('nickname', '닉네임', 'required|min_length[5]|max_length[20]');
		$this->form_validation->set_rules('password', '비밀번호', 'required|min_length[6]|max_length[30]|matches[re_password]');
		$this->form_validation->set_rules('re_password', '비밀번호 확인', 'required');
		// (필드이름(form name), 알아보기 쉬운 이름(에러메세지에 표시됨), 필요한 검사규칙들(|로 구분하여 복수입력)
		if($this->form_validation->run() === false){ //유효하지않음
			$this->load->view('register');	 //다시 회원가입 페이지를 표시함
		}else{ //유효함=데이터를 DB에 insert함
			$this->load->model('user_model');
			if(!function_exists('password_hash'))
				$this->load->helper('password'); //helper로 추가한 password 암호화 lib를 로드함
			$hash = password_hash($this->input->post('password'),PASSWORD_BCRYPT); //전송할 데이터, 암호화 규칙(php제공)

			$this->user_model->add(array(
				'email'=>$this->input->post('email'),
				'password'=>$hash,
				'nickname'=>$this->input->post('nickname')
			));

			$this->session->set_flashdata('message', '회원가입에 성공했습니다.');
			redirect('/');
		}
		$this->_footer();
	}

	function authentication(){
		$this->load->model('user_model');
		$user = $this->user_model->getByEmail(array('email'=>$this->input->post('email')));
		if(!function_exists('password_hash')){
			$this->load->helper('password');
		}
		if(
			$this->input->post('email') == $user->email &&
			password_verify($this->input->post('password'), $user->password)//password_verify:비밀번호 확인용 php api
		) {
			$this->session->set_userdata('is_login', true);
			$returnURL = $this->input->get('returnURL');
			if($returnURL === false){
				$returnURL = '/';
			}
			redirect($returnURL);
		} else {
			echo "불일치";
			$this->session->set_flashdata('message', '로그인에 실패 했습니다.');//1회 출력 후 삭제되는 메세지
			//view/head에 flashdata('message')를 구현하고, 이후 다른 위치에서 set_flashdata를 작성하면 1회용 메세지를 활용할 수 있다
			redirect('/auth/login');
		}
	}
}
