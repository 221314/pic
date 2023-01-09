<?php if( ! defined('BASEPATH')) exit('No direct script access allowed.');
		//해당 파일의 직접적인 호출을 방지하는 코드임.

if(!function_exists('kdate')){ //'kdate'라는 function이 존재하지 않는다면=즉 중복검사 절차임
											 //helper는 전역함수의 성격을 갖기 때문에 중복을 방지하는게 좋음

	function kdate($stamp){
		return date('o년 n월 j일 | G시 i분 s초',$stamp); //<!--timestamp-->
			//php의 date함수(o,n,j...에 unix_timestamp(초)가 포맷에 맞게(년,월,일...)로 계산되어 치환됨)-->);
	}
}

//Helper와 Library의 차이점은 Helper가 객체지향이 아닌 독립된 함수라면 Libary는 객체지향인 클래스다.
