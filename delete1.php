<?php
    $num=$_REQUEST["num"];
        
    require_once("db.php");
    require_once("util.php");
    $pdo = db_connect();
        
     try{
       $pdo->beginTransaction();
       $sql = "delete from dnjstjq25.greet where num = ?";   
       $stmh = $pdo->prepare($sql);
       $stmh->bindValue(1,$num,PDO::PARAM_STR);
       $stmh->execute();   
       $pdo->commit();
                
        header("Location:http://dnjstjq25.dothome.co.kr/notice.php");
       } catch (Exception $ex) {
                $pdo->rollBack();
                print "오류: ".$Exception->getMessage();
       }
  ?>