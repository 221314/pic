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
        return $this->db->get_where('topic',array('id'=>$topic_id))->row(); //액티브레코드로 작성함. 표준 sql 문법임.(공용어 정도)
        //return $this->db->query('SELECT * FROM topic WHERE id='.$topic_id)->row(); //mysql 문법으로 작성함. 위와 같은 동작을 함.
        //                          토픽에서 id가 선택된(전달받은 파라미터)와 같은 것을 select해서 return
    }
}