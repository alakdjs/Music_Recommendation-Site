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

	$sql = "delete from love where bo_num='$bo_num' and lo_id='$userid'";
	mysqli_query($con, $sql); 

	mysqli_close($con);     

	echo "
	   <script>
	    location.href = 'board_view.php?num=$bo_num&page=$page';
	   </script>
	";
?>