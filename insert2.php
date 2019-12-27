<?php session_start(); ?>
	<meta charset="utf-8">
<?php
	if(!isset($_SESSION["uid"])){
?>
	<script>
		alert('로그인 후 이용해 주세요.');
		history.back();
	</script>
<?php }
	if(isset($_REQUEST["page"]))
    	$page=$_REQUEST["page"];
  	else 
    	$page=1;

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
			$sql = "update dnjstjq25.mtm set subject=?, content=? where num=?";
			$stmh = $pdo->prepare($sql);
			$stmh -> bindValue(1, $subject, PDO::PARAM_STR);
			$stmh -> bindValue(2, $content, PDO::PARAM_STR);
			$stmh -> bindValue(3, $num, PDO::PARAM_STR);
			$stmh -> execute();
			$pdo -> commit();

			header("Location:http://dnjstjq25.dothome.co.kr/mtm.php?page=$page");
		} catch (PDOException $Exception) {
			$pdo->rollBack();
			print "오류:".$Exception->getMessage();
		}
	}
	else{

	if($mode=="response")
	{
	try{

	    $sql = "select * from dnjstjq25.mtm where num = $num"; // 부모 글 가져오기
        $stmh = $pdo->prepare($sql);  
        $stmh->bindValue(1, $num, PDO::PARAM_STR);      
        $stmh->execute();       

        $row = $stmh->fetch(PDO::FETCH_ASSOC);  
        $group_num = $row["group_num"];      // group_num, depth, ord 설정
        $depth = $row["depth"] + 1;
        $ord = $row["ord"] + 1;
        
        $pdo->beginTransaction();
        $sql = "update dnjstjq25.mtm set ord = ord + 1 where group_num = ? and ord > ?";
        $stmh = $pdo->prepare($sql); 
        $stmh->bindValue(1, $row["group_num"], PDO::PARAM_STR);  
        $stmh->bindValue(2, $row["ord"], PDO::PARAM_STR);  
        $stmh->execute();
        $pdo->commit(); 

		$pdo->beginTransaction();
		$sql = "insert into dnjstjq25.mtm(group_num, depth, ord, id, name, subject,";
		$sql .= "content, regist_day, hit) ";
		$sql .= "values(?, ?, ?, ?, ?, ?, ?, now(), 0)";
		$stmh = $pdo->prepare($sql);
        $stmh->bindValue(1, $group_num, PDO::PARAM_STR);  
        $stmh->bindValue(2, $depth, PDO::PARAM_STR);  
        $stmh->bindValue(3, $ord, PDO::PARAM_STR);   
        $stmh->bindValue(4, $_SESSION["uid"], PDO::PARAM_STR);  
        $stmh->bindValue(5, $_SESSION["name"], PDO::PARAM_STR);  
        $stmh->bindValue(6, $subject, PDO::PARAM_STR);   
        $stmh->bindValue(7, $content, PDO::PARAM_STR);  
 		$stmh -> execute();
		$pdo -> commit();

		header("Location:http://dnjstjq25.dothome.co.kr/mtm.php?page=$page");
	}catch (PDOException $Exception) {
			$pdo->rollBack();
			print "오류:".$Exception->getMessage();
		}
	} else {
		$depth = 0;
		$ord = 0;

		try {
	    $pdo->beginTransaction();  
        $sql = "insert into dnjstjq25.mtm(depth,ord,id,name,subject,content,regist_day,hit)";
        $sql .= "values(?, ?, ?, ?, ?, ?, now(), 0)";
        $stmh = $pdo->prepare($sql); 
        $stmh->bindValue(1, $depth, PDO::PARAM_STR);  
        $stmh->bindValue(2, $ord, PDO::PARAM_STR);        
        $stmh->bindValue(3, $_SESSION["uid"], PDO::PARAM_STR);  
        $stmh->bindValue(4, $_SESSION["name"], PDO::PARAM_STR);    
        $stmh->bindValue(5, $subject, PDO::PARAM_STR);  
        $stmh->bindValue(6, $content, PDO::PARAM_STR);        
        $stmh->execute();
        $lastId = $pdo->lastInsertId(); 
        $pdo->commit();

        $pdo->beginTransaction();   
        $sql = "update dnjstjq25.mtm set group_num = ? where num=?";
        $stmh1 = $pdo->prepare($sql); 
        $stmh1->bindValue(1, $lastId, PDO::PARAM_STR);  
        $stmh1->bindValue(2, $lastId, PDO::PARAM_STR);  
        $stmh1->execute();
        $pdo->commit(); 

        header("Location:http://dnjstjq25.dothome.co.kr/mtm.php?page=$page");
		} catch (PDOException $Exception) {
			$pdo->rollBack();
            print "오류: ".$Exception->getMessage();
		}
	}
}
?>