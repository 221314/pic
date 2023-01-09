<?php
class Topic_model extends CI_Model{
    function __construct(){ //생성자 : 클래스가 생성될 때 함께 생성되는 초기화 함수. 공통적으로 필요한 동작이 있을때 작성
        parent::__construct();
    }

    public function gets(){ //본문내용 전체
        return $this->db->query('SELECT * FROM topic')->result(); // result에 query결과를 담는다
                                                                        // result() : 객체로 반환
                                                                        // result_array() : 배열로 반환
    }
    public function get($topic_id){ //선택된 id의 내용
    	$this->db->select('id'); //다음에 실행될 get_where에 영향을 줌. (아래 결과에서 id col만 가져온다)
		$this->db->select('title');
		$this->db->select('description');
		//$this->db->select('created');
		$this->db->select('UNIX_TIMESTAMP(created) AS created');
						  //created col의 값을 unix_timestamp(초로 표현됨)으로 바꾸어 가져옴 (기존은 timestamp(YY:MM:DD...)형식)
        return $this->db->get_where('topic',array('id'=>$topic_id))->row(); //액티브레코드로 작성함. 표준 sql 문법임.(공용어 정도)
        //return $this->db->query('SELECT * FROM topic WHERE id='.$topic_id)->row(); //mysql 문법으로 작성함. 위와 같은 동작을 함.
        //                          토픽에서 id가 선택된(전달받은 파라미터)와 같은 것을 select해서 return
    }
    public function add($title,$description){
    	$this->db->set('created','NOW()',false); //set은 수정쿼리? 대입동작이 될 듯. false가 붙으면 문자가 아니라 now()로 인식된다네...
    	$this->db->insert('topic',array( //액티브레코드로 작성한 insert query
    		'title'=>$title,
			'description'=>$description,
//			'created'=>'now()' //created(등록시간) col에 now() : 현재시간을 반환하는 php 함수 를 대입한다.
							   //그러나 이렇게 작성하면 now()가 작은따옴표를 포함한 문자열로 인식되기 때문에, line25로 작성한다.
		));
    	return $this->db->insert_id(); //마지막으로 추가된 id값을 가져오는 api
		//return $this->db->query('SELECT id FROM topic WHERE title='.$title);
	}
	public function del($id){
//		$this->db->delete_where('topic',array('title'=>$title,'description'=>$description));
		$this->db->query('DELETE FROM topic WHERE id='.$id);
//		return $this->db->insert_id();
    }
}
