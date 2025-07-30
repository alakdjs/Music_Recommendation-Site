<?php
    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $mp4     = $_POST["mp4"];
    $content = $_POST["content"];
          
    $con = mysqli_connect("localhost", "root", "1234", "sample");
    $sql = "update board set subject='$subject', mp4='$mp4', content='$content' ";
    $sql .= " where num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'board_list.php?page=$page';
	      </script>
	  ";
?>

   
