<meta charset="utf-8">
<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";

    if ( !$userid )
    {
        echo("
                    <script>
                    alert('좋아요는 로그인 후 이용해 주세요!');
                    history.go(-1)
                    </script>
        ");
                exit;
    }


    $bo_num = $_POST["bo_num"]; // 게시글 고유번호
    $page = $_POST["page"];     // 게시글 페이지

	
	$con = mysqli_connect("localhost", "root", "1234", "sample");

	$sql = "insert into love (bo_num, lo_id, lo_name) ";
	$sql .= "values('$bo_num', '$userid', '$username')";
	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행


	// 추천(좋아요) 포인트 10점
  	$point_up = 10;

	$sql = "select point from members where id='$userid'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$new_point = $row["point"] + $point_up;
	
	$sql = "update members set point=$new_point where id='$userid'";
	mysqli_query($con, $sql);

	mysqli_close($con);                // DB 연결 끊기

	echo "
	   <script>
	    location.href = 'board_view.php?num=$bo_num&page=$page';
	   </script>
	";
?>