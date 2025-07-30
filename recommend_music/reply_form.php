<style>
.reply { margin: 32px 0; background-color: aliceblue; }
.reply .reply_component { padding: 8px 24px 48px 24px; }
.reply .reply_component .reply_form { display:flex; justify-content: flex-start; align-items : center; padding: 8px 0; font-size: 12px; }
</style>

<script>
  function reply_input() {
      if (!document.reply_form.re_content.value)
      {
          alert("댓글을 입력하세요!");    
          document.reply_form.re_content.focus();
          return;
      }
      document.reply_form.submit();
   }
</script>

<div class="reply">

    <?php include_once "reply_list.php";?>
    <hr>

    <div class="reply_component">
        <form name="reply_form" method="post" action="reply_insert.php">
            <input type="hidden" name="bo_num" value="<?=$num?>">
            <input type="hidden" name="page" value="<?=$page?>">
             <ul id="board_form">
				<li>
					<span class="col1">작성자 : </span>
					<span class="col2"><?=$username?></span>
				</li>		
	    		<li id="text_area">	
	    			<span class="col1">댓글 내용 : </span>
	    			<span class="col2">
	    				<textarea name="re_content"></textarea>
	    			</span>
	    		</li>
	    	  </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="reply_input()">댓글 달기</button></li>
			</ul>
        </form>
    </div>
</div>

