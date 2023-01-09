<div class="span10">
	<article>
		<h1><?=$topic->title?></h1> <!--제목-->
		<div>
			<?=kdate($topic->created)?> <!--timestamp-->
				<!--kor_helper.kdate함수 호출(date함수를 이용해 timestamp를 포맷에 맞게 수정하는 함수임)-->
		</div>
			<?=$topic->description?> <!--본문-->
		</div>
	</article>
	<div>
		<a href="/index.php/topic/add" class="btn">추가</a>
		<a href="/index.php/topic/del/<?=$topic->id?>" class="btn">삭제</a>
	</div>
</div>
