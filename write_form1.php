<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<style>
		.col1{ float: left; width: 100px; background-color: #ededed; text-align: center; height: 25px;}
		.col2{ float: left;	margin-left: 10px;}
		#write_form #write_row1 { width:99%; height:25px; margin:2px 0 2px 0; }
		#write_form #write_row2 { width:99%; height:25px; margin:8px 0 2px 0; }
		#write_form #write_row3 { width:99%; height:251px; margin:8px 0 2px 0; }
		#write_form #write_row3 .col1{ height:111px; padding-top:120px;}
		#write_button{ width: 476px; float: right; margin-right: 30px;}
	</style>
</head>
<body>
	<form name="borad_form" method="POST" action="./insert1.php">
		<div id="write_form">
			<div class="write_line"></div>
			<div id = "write_row1">
				<div class="col1">아이디</div>
				<div class="col2"><?=$_SESSION["uid"]?></div>
			</div>
			
			<div id="write_row2"><div class="col1"> 제목   </div>
				<div class="col2"><input type="text" name="subject" required></div>				
			</div>

			<div class="write_line"></div>
			<div id="write_row3"><div class="col1"> 내용   </div>
				<div class="col2"><textarea rows="15" cols="79" name="content" required></textarea></div>				
			</div>
			<div class="write_line"></div>
			<div id="write_button"><input type="image" src="./ok.png">&nbsp;<a href="./qna.php"><input type="image" src="./list.png"></a></div>
		</div>
	</form>
</body>
</html>