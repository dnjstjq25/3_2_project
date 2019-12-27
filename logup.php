<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>회원가입</title>
<style type="text/css">
.label-w{width: 200px; padding-left: 20px;}
.reg{width: 1080px;}
.reg td{padding: 5px; border: 1px solid black; height: 40px;}
table,th,td{
  border-collapse: collapse;
}
#ad{color: red;}
#an{font-size: 12px;}
.ip{width: 900px; height: 25px;}
.update_bt{margin-top: 30px; margin-left: 390px;}
.update_bt{width: 300px; height: 40px; background-color: black; color: white; border: none;}
.update_bt:hover{text-decoration: none; animation: a 0.5s ease-in-out; -webkit-animation: a 0.5s ease-in-out; 
      color: #fff;}
      @-webkit-keyframes a {0%{color: #000}100%{color: #fff}}
      @keyframes a {0%{color: #000}100%{color: #fff}}
</style>
</head>
<?php 
  $uid = $_REQUEST["uid"];

  require_once("db.php");
  require_once("util.php");

  $pdo = db_connect();

  try{
    $sql = "select * from dnjstjq25.member where uid = ?";
    $stmh = $pdo->prepare($sql);
    $stmh->bindValue(1, $uid, PDO::PARAM_STR);
    $stmh->execute();
    $count = $stmh->rowCount();
  } catch(PDOException $Exception){
    print "오류: ".$Exception->getMessage();
  }

  if($count<1){
    print "검색결과가 없습니다.<br>";
  } else {
    while($row = $stmh->fetch(PDO::FETCH_ASSOC)){

      $email=explode("0", $row["email"]);
    ?>
<body>
<div>
  <!-- 입력 폼을 만든다 -->
  <form name="member_form" method="POST" action="update.php?uid=<?=$uid?>" class="reg">
     <p id=an><label id=ad>* </label> 전부 다 채워주셔야 됩니다.</p>
    <table>
      <tr>
        <td class="label-w"><label>아이디</label><label id=ad> *</label></td>
        <td><?=$row["uid"]?></td>
      </tr>
      <tr>
        <td><label>비밀번호</label><label id=ad> *</label></td>
        <td><input type="password" name="pwd" value="<?$row["pwd"]?>" required class="ip"></td>
      </tr>
       <tr>
       <td><label>이름</label><label id=ad> *</label></td>
       <td><?=$row["name"]?></td>
      </tr>
      <tr>
        <td><label>전화번호</label><label id=ad> *</label></td>
        <td><input type="text" name="phone" value="<?$row["phone"]?>" required class="ip"></td>
      </tr>
      <tr>
        <td><label>나이</label><label id=ad> *</label></td>
        <td><input type="number" name="age" value="<?$row["age"]?>" required class="ip"></td>  
      </tr>
      <tr><td>성별<label id=ad> *</label></td>
        <td><?=$row["sex"]?></td>
      </tr>
      <tr><td>이메일<label id=ad> *</label></td>
         <td><input type="text" name="email" value="<?$row["email"]?>" required class="ip"></td>
      </tr>
      <tr>
        <td><label>주소</label><label id=ad> *</label></td>
        <td><input type="text" name="juso" value="<?$row["juso"]?>" required class="ip"></td>
      </tr>     
    </table>
     <input type="submit" value="수정하기" class="update_bt">
  </form>
</div>
<?php }
}?>
</body>
</html>
