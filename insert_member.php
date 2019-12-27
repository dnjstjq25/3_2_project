<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>레코드 추가</title>
<link href="../../../css/style.css" rel="stylesheet">
<!-- 테이블 용의 스타일시트 -->
<link href="../../css/tablestyle.css" rel="stylesheet">
</head>
<?php
require_once("util.php");
$gobackURL = "./index.php";

// 문자 인코드 검증
if (!cken($_POST)){
  header("Location:{$gobackURL}");
  exit();
}

// 간단한 오류 처리
$errors = [];
if (!isset($_POST["name"])||($_POST["name"]==="")){
  $errors[] = "이름이 비었습니다. ";
}
if (!isset($_POST["uid"])||($_POST["uid"]==="")){
  $errors[] = "아이디를 입력해주세요! ";
}
if (!isset($_POST["pwd"])||($_POST["pwd"]==="")){
  $errors[] = "비밀번호를 입력해주세요! ";
}
if (!isset($_POST["age"])||(!ctype_digit($_POST["age"]))){
  $errors[] = "나이에는 수치를 입력해주세요. ";
}
if (!isset($_POST["sex"])||!in_array($_POST["sex"], ["남","여"])) {
  $errors[] = "성별이 남자 또는 여자가 아닙니다. ";
}
if (!isset($_POST["email"])||($_POST["email"]==="")){
  $errors[] = "이메일을 입력해주세요! ";
}
if (!isset($_POST["juso"])||($_POST["juso"]==="")){
  $errors[] = "주소를 입력해주세요! ";
}
if (!isset($_POST["phone"])||($_POST["phone"]==="")){
  $errors[] = "전화번호를 입력해주세요! ";
}

// 오류가 있었을 때
if (count($errors)>0){
  echo '<ol class="error">';
  foreach ($errors as $value) {
    echo "<li>", $value , "</li>";
  }
  echo "</ol>";
  echo "<hr>";
  echo "<a href=", $gobackURL, ">돌아가기</a>";
  exit();
}

// 데이터 베이스 사용자
$user = 'dnjstjq25';
$password = 'tjq475869';
// 이용할 데이터베이스
$dbName = 'dnjstjq25';
// MySQL 서버
$host = 'localhost';
// MySQL의 DSN 문자열
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
?>
<body>
<div>
  <?php
  $uid = $_POST["uid"];
  $pwd = $_POST["pwd"];
  $name = $_POST["name"];
  $phone = $_POST["phone"];
  $age = $_POST["age"];
  $sex = $_POST["sex"];
  $email = $_POST["email"];
  $juso = $_POST["juso"];
  // MySQL 데이터베이스에 접속한다
  try {
    $pdo = new PDO($dsn, $user, $password);
    // 프리페어 스테이트먼트의 에뮬레이션을 무효로 한다
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // 예외가 쓰로우되도록 설정한다
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
    // SQL 문을 만든다
    $sql = "INSERT INTO member (uid, pwd, name, phone, age, sex, email, juso) VALUES (:uid, :pwd, :name, :phone, :age, :sex, :email, :juso)";
    // PDO에 쿼리 문장을 등록한다
    $stm = $pdo->prepare($sql);
    // 플레이스 홀더에 값을 바인드한다
    $stm->bindValue(':uid', $uid, PDO::PARAM_STR);
    $stm->bindValue(':pwd', $pwd, PDO::PARAM_STR);
    $stm->bindValue(':name', $name, PDO::PARAM_STR);
    $stm->bindValue(':phone', $phone, PDO::PARAM_STR);
    $stm->bindValue(':age', $age, PDO::PARAM_INT);
    $stm->bindValue(':sex', $sex, PDO::PARAM_STR);
    $stm->bindValue(':email', $email, PDO::PARAM_STR);
    $stm->bindValue(':juso', $juso, PDO::PARAM_STR);
    // SQL 문을 실행한다
    if ($stm->execute()){
      // 레코드 추가 후의 레코드 목록을 얻는다
      $sql = "SELECT * FROM member";
      // PDO에 쿼리 문장을 등록한다
      $stm = $pdo->prepare($sql);
      // SQL문을 실행한다
      $stm->execute();
      // 결과 얻기(연관 배열로 받는다)
      $result = $stm->fetchAll(PDO::FETCH_ASSOC);
      // 테이블의 타이틀 행
       echo "<script>
       alert('가입완료!');
       document.location.href='index.php';
       </script>"; 
      
    } else {
      echo '<span class="error">추가 오류가 있습니다. </span><br>';
    };
  } catch (Exception $e) {
    echo '<span class="error">오류가 있습니다. </span><br>';
    echo $e->getMessage();
  }
  ?>
  <hr>
</div>
</body>
</html>
