<form action="/index.php/topic/add" method="post" class="span10">
	<?php echo validation_errors(); ?> <!--form 유효성 검사에서 문제가 발견되면 에러메세지를 출력해줌-->

	<input type="text" name="title" placeholder="제목" class="span12"/>
	<textarea name="description" placeholder="본문" class="span12" rows="15"></textarea>
	<input class="btn" type="submit" /> <!--form 태그의 action으로 전송하게 된다-->
</form>
