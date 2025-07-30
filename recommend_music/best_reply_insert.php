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
                    alert('댓글 달기는 로그인 후 이용해 주세요!');
                    history.go(-1)
                    </script>
        ");
                exit;
    }
    $bo_num = $_POST["bo_num"]; // 게시글 고유번호
    $page = $_POST["page"];     // 게시글 페이지
    $re_content = $_POST["re_content"];

	$re_content = htmlspecialchars($re_content, ENT_QUOTES);

	$re_regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	
	$con = mysqli_connect("localhost", "root", "1234", "sample");

	$sql = "insert into reply (bo_num, re_id, re_name, re_content, re_regist_day) ";
	$sql .= "values('$bo_num', '$userid', '$username', '$re_content', '$re_regist_day')";
	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

	// 댓글 작성 시 포인트 10점
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
	    location.href = 'best_view.php?num=$bo_num&page=$page';
	   </script>
	";
?>