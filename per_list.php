 <?php
 session_start(); 
   
 $file_dir = './data/'; 
  
 $no=$_REQUEST["no"];
   
 require_once("db.php");
 require_once("util.php");

 $pdo = db_connect();
 
 try{
     $sql = "select * from dnjstjq25.per_up";
     $stmh = $pdo->prepare($sql);  
     $stmh->bindValue(1, $no, PDO::PARAM_STR);      
     $stmh->execute();            
      
    while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
 	
    $item_file01  = $row["file01"];  //사진
    $item_subject = str_replace(" ", "&nbsp;", $row["subject"]); //상품명
    $item_price   = $row["price"]; //가격
    $item_ctg   = $row["ctg"]; //구분

 ?>
 <!DOCTYPE HTML>
 <html>
 <head> 
   <meta charset="utf-8">
   <style>#view_title {border: 1px solid black; float: left; text-align: center; margin-left: 15px; margin-top: 15px;}</style>
   <title>전시된 상품 확인 페이지</title>
 </head>
 <body>
 <div id="wrap">
        <div id="view_title">
        	<div id="view_content">
			<img src="./data/<?=$row[file01]?>" width="290px" height="290px">
         </div>
         	브랜드: <?= $item_ctg ?> <br>
	  		상품명: <?= $item_subject ?><br>
         	가격: ₩<?= $item_price ?>
	</div>  
 <?php  
  }
  } catch (PDOException $Exception) {
       print "오류: ".$Exception->getMessage();
  }
 ?>
	</div>
  <div><a href="./write_per.php">상품등록</a></div>
</body>
</html>
