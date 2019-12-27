<?php
    $session_start();
    $num=$_REQUEST["num"];
    $page=$_REQUEST["page"];

    require_once("db.php");
    require_once("util.php");
    $pdo = db_connect();
        
     try{
       $pdo->beginTransaction();
       $sql = "delete from dnjstjq25.mtm where num = ?";   
       $stmh = $pdo->prepare($sql);
       $stmh->bindValue(1,$num,PDO::PARAM_STR);
       $stmh->execute();   
       $pdo->commit();
                
        header("Location:http://dnjstjq25.dothome.co.kr/mtm.php?page=$page");
       } catch (Exception $ex) {
                $pdo->rollBack();
                print "오류: ".$Exception->getMessage();
       }
  ?>