<?php
$uid = $_REQUEST["uid"];
$pwd = $_REQUEST["pwd"];
$name = $_REQUEST["name"];
$phone = $_REQUEST["phone"];
$age = $_REQUEST["age"];
$sex = $_REQUEST["sex"];
$email = $_REQUEST["email"];
$juso = $_REQUEST["juso"];

require_once("db.php");
require_once("util.php");

$pdo = db_connect();

try {
	$pdo->beginTransaction();
	$sql = "update dnjstjq25.member set pwd=?, phone=?, age=?, email=?, juso=? where uid = ?";
	$stmh = $pdo->prepare($sql);
	$stmh->bindValue(1, $pwd, PDO::PARAM_STR);
	$stmh->bindValue(2, $phone, PDO::PARAM_STR);
	$stmh->bindValue(3, $age, PDO::PARAM_STR);
	$stmh->bindValue(4, $email, PDO::PARAM_STR);
	$stmh->bindValue(5, $juso, PDO::PARAM_STR);
	$stmh->bindValue(6, $uid, PDO::PARAM_STR);

	$stmh->execute();
	$pdo->commit();

	header("Location:http://dnjstjq25.dothome.co.kr/index.php");

} catch (PDOException $Exception) {
	$pdo->rollback();
  print "오류: ".$Exception->getMessage();
}
?>