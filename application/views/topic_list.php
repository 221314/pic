<div class="span2">
	<ul class="nav nav-tabs nav-stacked">
	<?php
	foreach($topics as $entry){ //topics의 갯수만큼 반복하면서 얻은 값에 $entry라는 별명을 붙이는 php함수
		?>
		<li><a href="/index.php/Topic/get/<?=$entry->id?>"><?=$entry->title?></a></li>
		<?php //href를 사용해서 링크를 걸어준다. (URI 구성)=>/컨트롤클래스/호출할함수/전달파라미터
	}
	?>
	</ul>
</div>
