<div id="board_box">
        <br>
	    <h1>
	    	댓글 목록
		</h1>
        <br>
        <hr>
	    <ul id="board_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">댓글</span>
					<span class="col3">작성자</span>
					<span class="col4">날짜</span>
				</li>
<?php
	if (isset($_GET["re_page"]))
		$re_page = $_GET["re_page"];
	else
		$re_page = 1;

            
    $bo_num = $num; //현재페이지의 번호를 변수에 저장
            
	$con = mysqli_connect("localhost", "root", "1234", "sample");
	$sql = "select * from reply where bo_num='$bo_num' order by re_num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 10; //댓글 10개씩 보임

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($re_page - 1) * $scale;      

	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      // 하나의 레코드 가져오기
	  $re_num         = $row["re_num"];
	  $re_id          = $row["re_id"];
	  $re_name        = $row["re_name"];
	  $re_content     = $row["re_content"];
      $re_regist_day  = $row["re_regist_day"];
?>
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col2"><?=$re_content?></span>
					<span class="col3"><?=$re_name?></span>
					<span class="col5"><?=$re_regist_day?></span>
				</li>	
<?php
   	   $number--;
   }
   mysqli_close($con);

?>
	    	</ul>
			<ul id="page_num"> 	
<?php
	if ($total_page>=2 && $re_page >= 2)	
	{
		$new_page = $re_page-1;
		echo "<li><a href='board_view.php?num=$num&page=$page&re_page=$new_page'>◀ 이전</a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

 
   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($re_page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='board_view.php?num=$num&page=$page&re_page=$i'> $i </a> <li>";
		}
   	}
   	if ($total_page>=2 && $re_page != $total_page)		
   	{
		$new_page = $re_page+1;	
		echo "<li> <a href='board_view.php?num=$num&page=$page&re_page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->	    	
	</div> <!-- board_box -->