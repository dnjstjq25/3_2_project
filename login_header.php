<head>
  <?error_reporting(E_ALL&~E_NOTICE&~E_WARNING); session_start();?>
  <style>
  .a a{font-size: 13px;}
  </style>
</head>
<body>
  <div class="a">
  <?php
    if(!isset($_SESSION["uid"]))
    {
?>
        <a href="./login_form.php">로그인</a> | <a href="./log_insert.php">회원가입</a>
<?php
  }
  else
  {
?>
      <?=$_SESSION["uid"]?>님 | <a href="./logout.php">로그아웃</a> <br> <a href="./log_update.php?uid=<?=$_SESSION["uid"]?>">정보수정</a> | <a href="./mypage.php?uid=<?=$_SESSION["uid"]?>">마이페이지</a> <br>
<?php
    if($_SESSION["uid"]=="admin")
    {
      ?>
      <a href="./write_per.php">상품올리기</a>
    <?php
    }
  }
?>
  </div>
</body>
