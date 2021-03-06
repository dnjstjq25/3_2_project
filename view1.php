<?php
	session_start();

	$num=$_REQUEST["num"];

	require_once("db.php");
	require_once("util.php");

	$pdo=db_connect();

	try{
		$sql = "select * from dnjstjq25.greet1 where num=?";
		$stmh = $pdo->prepare($sql);
		$stmh->bindValue(1, $num, PDO::PARAM_STR);
		$stmh->execute();

		while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
			$item_num = $row["num"];
			$item_id = $row["id"];
			$item_name = $row["name"];
			$item_subject = str_replace(" ", "&nbsp;", $row["subject"]);
			$item_content = $row["content"];
		?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<script>
		function del(href)
		{
			if(confirm("정말 삭제하시겠습니까?")){
				document.location.href = href;
			}
		}
	</script>
<style>				
	#view_title {height:18px; padding:10px 8px 8px 8px; border-top:solid 2px #aaaaaa; background-color:#eeeeee; margin-bottom:5px;}
	#view_title1 {float:left; width:70%;}
	#view_title2 {float:left; width:28%; text-align:right;}
	#view_content {	width:96%; min-height:200px; padding:15px; overflow:hidden; line-height:150%; border-bottom:solid 1px #cccccc;}
	#view_button {width:98%; text-align:right; margin-top:15px; margin-bottom:15px;}
	#view_button a:link{text-decoration: none; color: #000;}
	#view_button a:hover{animation: a 0.5s ease-in-out; -webkit-animation: a 0.5s ease-in-out; 
			color: #000;}
			@-webkit-keyframes a {0%{color: #000}100%{color: #000}}
			@keyframes a {0%{color: #000}100%{color: #000}}
	#view_button a:visited{text-decoration: none; color: #000;}
</style>
</head>
<body>
		<div id="view_title">
			<div id="view_title1"><?= $item_subject ?></div>
			<div id="view_title2"><?= $item_name ?></div>
			</div>
			<div id="view_content"><?= $item_content ?></div>
			<div id="view_button"><a href="./qna.php">목록</a> &nbsp;
<?php
			if(isset($_SESSION["uid"])) {
				if($_SESSION["uid"]=="admin"){
			?>
				<a href="./qna_modi.php?num=<?=$num?>">수정</a> &nbsp;
				<a href="javascript:del('./delete1.php?num=<?=$num?>')">삭제</a> &nbsp;
				<?php	
				?>
				<a href="./write_form1.php">글쓰기</a>
				<?php
			}
			}
			}
	}catch(PDOException $Exception){
			print "오류: ".$Exception->getMessage();
		}
?>
	</div>
	<div class="clear"></div>
</body>
</html>