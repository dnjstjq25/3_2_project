<?php session_start(); ?>
	<meta charset="utf-8">
<?php
	if(!isset($_SESSION["uid"])){
?>
	<script>
		alert('로그인 후 이용해 주세요.');
		history.back();
	</script>
<?php
	}
	if(isset($_REQUEST["mode"]))
		$mode=$_REQUEST["mode"];
	else
		$mode="";

	if(isset($_REQUEST["num"]))
		$num=$_REQUEST["num"];
	else
		$num="";

	$subject=$_REQUEST["subject"];
	$content=$_REQUEST["content"];

	require_once("db.php");
	require_once("util.php");
	$pdo = db_connect();

	if($mode=="modify"){
		try{
			$pdo->beginTransaction();
			$sql = "update dnjstjq25.greet set subject=?, content=? where num=?";
			$stmh = $pdo->prepare($sql);
			$stmh -> bindValue(1, $subject, PDO::PARAM_STR);
			$stmh -> bindValue(2, $content, PDO::PARAM_STR);
			$stmh -> bindValue(3, $num, PDO::PARAM_STR);
			$stmh -> execute();
			$pdo -> commit();

			header("Location:http://dnjstjq25.dothome.co.kr/notice.php");
		} catch (PDOException $Exception) {
			$pdo->rollBack();
			print "오류:".$Exception->getMessage();
		}
	}
	else{
	try{
		$pdo->beginTransaction();
		$sql = "insert into dnjstjq25.greet(id,name,subject,content,regist_day,hit)";
		$sql .= "values(?, ?, ?, ?, now(), 0)";
		$stmh = $pdo->prepare($sql);
		$stmh -> bindValue(1, $_SESSION["uid"], PDO::PARAM_STR);
		$stmh -> bindValue(2, $_SESSION["name"], PDO::PARAM_STR);
		$stmh -> bindValue(3, $subject, PDO::PARAM_STR);
		$stmh -> bindValue(4, $content, PDO::PARAM_STR);
		$stmh -> execute();
		$pdo -> commit();

		header("Location:http://dnjstjq25.dothome.co.kr/notice.php");
	}catch (PDOException $Exception) {
			$pdo->rollBack();
			print "오류:".$Exception->getMessage();
		}
	}
?>