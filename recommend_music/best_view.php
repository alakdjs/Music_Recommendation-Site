<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>음원 추천 사이트</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?ver=1">
<link rel="stylesheet" type="text/css" href="./css/board.css?ver=1">
</head>
    <script>

        function love_change()
        {
            document.getElementById("lo_img").src="./img/loved_image.jpg";
            
            document.love_form.submit();
        }
        
        function loved_change()
        {
            document.getElementById("lo_img").src="./img/love_image.jpg";
            
            document.loved_form.submit();
        
        }
    
    </script>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
	<img src="./img/main_img.jpg">
   	<div id="board_box">
	    <h3 class="title">
			인기 게시판 > 내용보기
		</h3>
<?php
	$num  = $_GET["num"];
	$page  = $_GET["page"];

	$con = mysqli_connect("localhost", "root", "1234", "sample");
	$sql = "select * from board where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$id      = $row["id"];
	$name      = $row["name"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
    $mp4        = $row["mp4"];
	$content    = $row["content"];
	$file_name    = $row["file_name"];
	$file_type    = $row["file_type"];
	$file_copied  = $row["file_copied"];
	$hit          = $row["hit"];

    $mp4 = str_replace(" ", "&nbsp;", $mp4);
	$mp4 = str_replace("\n", "<br>", $mp4);
        
	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	$new_hit = $hit + 1;
	$sql = "update board set hit=$new_hit where num=$num";   
	mysqli_query($con, $sql);
?>		
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?></span>
			</li>
			<li>
				<?php
					if($file_name) {
						$real_name = $file_copied;
						$file_path = "./data/".$real_name;
						$file_size = filesize($file_path);

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>
                        <img src = '$file_path'>";
			           	}
				?>
                <?=$mp4?>
                <div><embed src='<?=$mp4?>' width="750" height="500"></div><br>
				<?=$content?>
			</li>		
	    </ul>
	    <ul class="buttons">
            
                <li>
                    추천: <?php 
                            $sql = "select count(bo_num) from love where bo_num=$num";
                            $data = mysqli_query($con, $sql);
                            $like_count = mysqli_fetch_array($data);
                            $total_like = $like_count[0];
                            echo $total_like;
                
                    if($total_like >= 10) // 만약 좋아요가 10개가 넘으면
                    {
                        $sql = "update board set pop=1 where num=$num";
                        mysqli_query($con, $sql);
                    }
                            ?>
                </li>
                
                <li>
                    <?php
                    $sql = "select * from love where bo_num=$num and lo_id='$userid'";
                    $user_data = mysqli_query($con, $sql);
                    $da_row = mysqli_fetch_array($user_data);
                           

                    if($da_row["lo_id"]??'' === $userid)  // ??'' -> isset이랑 비슷
                    {
                    ?>
                    <form name="loved_form" method="post" action="best_love_delete.php" style="display:inline;">
                    <input type="hidden" name="bo_num" value="<?=$num?>">
                    <input type="hidden" name="page" value="<?=$page?>">
                        
                    <img id="lo_img" src="./img/loved_image.jpg" onclick="loved_change()" style="margin-right:10px; margin-left:10px; width:40px; height:40px; cursor: pointer;">
                    </form>
                    <?php
                    }
                    else
                    {
                    ?>
                    <form name="love_form" method="post" action="best_love.php" style="display:inline;">
                    <input type="hidden" name="bo_num" value="<?=$num?>">
                    <input type="hidden" name="page" value="<?=$page?>">
                    <img id="lo_img" src="./img/love_image.jpg" onclick="love_change()" style="margin-right:10px; margin-left:10px; width:40px; height:40px; cursor: pointer;">
                    </form>
                    <?php
                    }
                    ?>      
                </li>
                
                <li><button onclick="location.href='best_list.php?page=<?=$page?>'">목록</button></li>
            
		</ul>
        
        <?php include_once "best_reply_form.php"; ?>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>