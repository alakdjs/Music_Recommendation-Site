<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>음원 추천 사이트</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?ver=1">
<link rel="stylesheet" type="text/css" href="./css/board.css?ver=1">
<script>
  function check_input() {
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.board_form.subject.focus();
          return;
      }
      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }
</script>
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
	<img src="./img/main_img.jpg">
   	<div id="board_box">
	    <h3 id="board_title">
	    		음원 추천 게시판 > 글쓰기
		</h3>
	    <form name="board_form" method="post" action="board_insert.php" enctype="multipart/form-data"> <!-- enctype 파일첨부-->
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$username?></span>
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text"></span>
	    		</li>
                <li>		
	    			<span class="col1">영상 링크 : </span>
	    			<span class="col2"><input name="mp4" type="text"></span>
	    		</li>
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea>
	    			</span>
	    		</li>
	    		<li>
			        <span class="col1"> 첨부 파일</span>
			        <span class="col2"><input type="file" name="upfile"></span>
			    </li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">완료</button></li>
				<li><button type="button" onclick="location.href='board_list.php'">목록</button></li>
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
