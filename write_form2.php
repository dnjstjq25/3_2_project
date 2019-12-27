<?php
	session_start();
  if(isset($_REQUEST["page"]))  // 페이지 번호
   $page=$_REQUEST["page"];
  else
   $page=1;

  if(isset($_REQUEST["mode"]))  // 새로 쓰기, 수정, 답변 구분 
   $mode=$_REQUEST["mode"];
  else
   $mode="";
  
  if(isset($_REQUEST["num"]))  
   $num=$_REQUEST["num"];
  else
   $num="";
          
  if ($mode=="modify" || $mode=="response"){
   require_once("db.php");
   require_once("util.php");

   $pdo = db_connect();
      
    try{
      $sql = "select * from dnjstjq25.mtm where num = ? ";
      $stmh = $pdo->prepare($sql); 
      $stmh->bindValue(1,$num,PDO::PARAM_STR); 
      $stmh->execute();
      $count = $stmh->rowCount();              
    if($count<1){  
        print "검색결과가 없습니다.<br>";
     }else{
        $row = $stmh->fetch(PDO::FETCH_ASSOC);
        $item_subject = $row["subject"];
        $item_content = $row["content"];
      }
     
     if ($mode=="response")
     {
		$item_subject = "&nbsp;[re]".$item_subject;
		$item_content = "질문내용->".$item_content;
		$item_content = str_replace("\n", "\n>", $item_content);
		$item_content = "\n\n".$item_content;
     }
    }catch (PDOException $Exception) {
       print "오류: ".$Exception->getMessage();
    }
  }
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
	<?php
		if($mode=="modify"){
	?>
	<form name="borad_form" method="POST" action="insert2.php?mode=modify&num=<?=$num?>&page=<?=$page?>">
		<?php
			} elseif ($mode=="response") {
				?>
			<form  name="board_form" method="post" action="insert2.php?mode=response&num=<?=$num?>&page=<?=$page?>"> 
				<?php
			} else {
				?>
				<form  name="board_form" method="post" action="insert2.php"> 
				<?php
			}
			?>
		<div id="write_form">
			<div class="write_line"></div>
			<div id = "write_row1">
				<div class="col1">아이디</div>
				<div class="col2"><?=$_SESSION["uid"]?></div>
			</div>
			
			<div id="write_row2"><div class="col1"> 제목   </div>
				<div class="col2"><input type="text" name="subject" 
					<?php if ($mode=="modify" || $mode=="response") {?>
100               value="<?=$item_subject?>" <?php } ?> required></div>				
			</div>

			<div class="write_line"></div>
			<div id="write_row3"><div class="col1"> 내용   </div>
				<div class="col2"><textarea rows="15" cols="79" name="content" required>
					<?php if ($mode=="modify" || $mode=="response") {?><?=$item_content?> <?php } ?>
					</textarea></div>				
			</div>
			<div class="write_line"></div>
			<div id="write_button"><input type="image" src="./ok.png">&nbsp;<a href="./mtm.php?page=<?=$page?>"><input type="image" src="./list.png"></a></div>
		</div>
	</form>
</body>
</html>