<?session_start(); ob_start(); ?>
<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	<?
		 require_once("db.php");
		 require_once("util.php");

		 $pdo = db_connect();

		 $no=$_REQUEST[no];
		 $ctg=$_REQUEST[ctg];
		 $count=$_REQUEST['_count'];//수량
		 $totals=$_REQUEST['totals'];//결제금액
		 $subject=$_REQUEST[subject];
		 $file_dir = './data/'; 

		 $uid = $_REQUEST["uid"];
		 $name = $_SESSION["name"];
		 $juso = $_SESSION["juso"];
		 $phone = $_SESSION["phone"];

		if(!isset($_SESSION["uid"]))
		{
			?>
			<script>
			alert('로그인이 필요합니다.');
			history.back();
			</script>
	<?php
		}
	?>
	
	<style type="text/css">
	@font-face{
		font-family: 'menu-font';
		src: url(./fonts/NanumGothic.ttf) format("truetype");
	}
	@font-face{
		font-family: 'copy';
		src: url(./fonts/Dosis-Light.ttf) format("truetype");
	}
	@font-face{
		font-family: 'logo-font';
		src: url(./fonts/BOKEH.ttf) format("truetype");
	}

	body{background-color: #fff; overflow-x:hidden; }
	
	.sub-menu{ width: 100%; font-family: menu-font; font-size: 17px; position: absolute; z-index: 1703;
		display: none; margin-left: -370px; margin-top: 15px; padding-left: 370px; background-color: #fff; height: 300px;
	    border-bottom: 2px solid black;}
	.sub-menu div{margin-top: 7px; }
	.sub-menu2{ width: 100%; font-family: menu-font; font-size: 17px; position: absolute; z-index: 1702;
		display: none; margin-left: -450px; margin-top: 15px; padding-left: 450px; background-color: #fff; height: 300px;
	border-bottom: 2px solid black;}
	.sub-menu2 div{margin-top: 7px; }
	.sub-menu3{ width: 100%; font-family: menu-font; font-size: 17px; position: absolute; z-index: 1701;
		display: none; margin-left: -530px; margin-top: 15px; padding-left: 530px; background-color: #fff; height: 300px;
	border-bottom: 2px solid black;}
	.sub-menu3 div{margin-top: 7px; }
	.sub-menu4{ width: 100%; font-family: menu-font; font-size: 17px; position: absolute; z-index: 1700;
		display: none; margin-left: -625px; margin-top: 15px; padding-left: 625px; background-color: #fff; height: 300px;
	border-bottom: 2px solid black;}
	.sub-menu4 div{margin-top: 7px; }

	.menu-list-b{z-index: 1600; height: 100%; margin-left: 370px; margin-top: 35px; position: absolute;}
	.menu-list-s{z-index: 1601; height: 100%; margin-left: 450px; margin-top: 35px; position: absolute;}
	.menu-list-n{z-index: 1602; height: 100%; margin-left: 530px; margin-top: 35px; position: absolute;}
	.menu-list-c{z-index: 1603; height: 100%; margin-left: 625px; margin-top: 35px; position: absolute;}

	.sname {font-family: logo-font; font-size: 50px; color: #000; margin-top: 20px; width: 100px;
		z-index: 1100; position: absolute; margin-left: 250px;}
	.sname a:link{text-decoration: none; color: #fff;}
	
	.top1{ 
		height: 100px;
		width: 100%;
		z-index: 1000;
		position: absolute;
		border-bottom: 2px solid black;
	}
	
	.menu-list-b:hover{width: 100%;}
	.menu-list-b:hover .sub-menu{display: block;}
	.menu-list-s:hover{width: 100%;}
	.menu-list-s:hover .sub-menu2{display: block;}
	.menu-list-n:hover{width: 100%;}
	.menu-list-n:hover .sub-menu3{display: block;}
	.menu-list-c:hover{width: 100%;}
	.menu-list-c:hover .sub-menu4{display: block;}

		input[type=checkbox]{display: none;}
			.slide_box{width: 250px; height: 100%; position: fixed; top:0; right:-250px; background: #fff; transition: right 0.2s ease-out; -webkit-transition:right 0.2s ease-out;}
			input.menutr1:checked ~ .slide_box{right: 0; transition: right 0.2s ease-out; -webkit-transition:right 0.2s ease-out;}
			input.menutr1:checked ~ .tree{right: 250px; transition: right 0.2s ease-out; -webkit-transition:right 0.2s ease-out;}
		.tree{width: 32px; height: 30px; position: absolute; top:35px; right:250px; cursor: pointer; transition: right 0.2s ease-out; -webkit-transition:right 0.2s ease-out;}
			.tbox{width: 20px; margin: 0 auto; margin-top: 6px; position: relative; z-index: 1;}
			.tree .line1{width: 20px; height: 2px; background: #000;}
			.tree .line2{width: 20px; height: 2px; background: #000; margin-top: 5px;}
			.tree .line3{width: 20px; height: 2px; background: #000; margin-top: 5px;}
		.tree:hover .line1{animation: line1 0.5s ease-in-out; -webkit-animation:line1 0.5s ease-in-out; background: #000;}
			@-webkit-keyframes line1 {0%{background: #fff}100%{background: #000}}
			@keyframes line1 {0%{background: #fff}100%{background: #000}}

		.tree:hover .line2{animation: line2 0.5s ease-in-out; -webkit-animation:line2 0.5s ease-in-out; background: #000;}
			@-webkit-keyframes line2 {0%{background: #fff}100%{background: #000}}
			@keyframes line2 {0%{background: #fff}100%{background: #000}}

		.tree:hover .line3{animation: line3 0.5s ease-in-out; -webkit-animation:line3 0.5s ease-in-out; background: #000;}
			@-webkit-keyframes line3 {0%{background: #fff}100%{background: #000}}
			@keyframes line3 {0%{background: #fff}100%{background: #000}}
		
	
		.login{margin-top: 130px;}
		
		.slide_box a:visited{text-decoration: none; color: #000;}
		.slide_box a:link{text-decoration: none; color: #000;}
		a:visited{text-decoration: none; color: #000;}
		.menu-list-b a:link{text-decoration: none; font-size: 17px; color: #000; font-family:menu-font;}
		.sub-menu a:link{text-decoration: none; font-size: 13px; color: #000; font-family:menu-font;}
		.menu-list-s a:link{text-decoration: none; font-size: 17px; color: #000; font-family:menu-font;}
		.sub-menu2 a:link{text-decoration: none; font-size: 13px; color: #000; font-family:menu-font;}
		.menu-list-n a:link{text-decoration: none; font-size: 17px; color: #000; font-family:menu-font;}
		.sub-menu3 a:link{text-decoration: none; font-size: 13px; color: #000; font-family:menu-font;}
		.menu-list-c a:link{text-decoration: none; font-size: 17px; color: #000; font-family:menu-font;}
		.sub-menu4 a:link{text-decoration: none; font-size: 13px; color: #000; font-family:menu-font;}
		a:hover{text-decoration: none; animation: a 0.5s ease-in-out; -webkit-animation: a 0.5s ease-in-out; 
			color: #000;}
			@-webkit-keyframes a {0%{color: #fff}100%{color: #000}}
			@keyframes a {0%{color: #fff}100%{color: #000}}

	 .wrap{margin-top: 10px; overflow: hidden; padding-bottom: 50px; background-color: #ededed; }
	 .wrap2{margin : 0 auto; width: 1080px; height: 100%; overflow: hidden;}
	 
	 #view_title{margin-top: 20px; overflow: hidden; float:left; margin-left: 55px; width: 100%; }
	 #view_img{ float:left;}
	 .view_subject{float: left; margin-left: 20px; margin-top: 20px;}
	 .pay_info{float: left; width: 960px; margin-top: 10px;}
	 .pay_infom{margin-top: 10px;}
	 .pay_bt{float: left; width: 80%; margin-left: 900px;}

	 .catalog-caption{text-align: center; font-weight: lighter; }
	 .menu-arrow{margin-top: 120px;}
	 .menu-arrow a{text-decoration: none; font-size: 15px; color: #000; font-family:menu-font;}
	 
	 #pay_name{width: 70px;}
	 #pay_juso{width: 700px;}
	 #pay_phone{width: 200px;}
	 #pay_per{width: 70px;}
	 #pay_num{width: 200px;}
	 #pay_noti{color: red;}

	 .copy{width: 100%;}
	 .copy-t{width: 100%;}
	 .copy-t li{list-style: none; display: inline-block; vertical-align: top; border-right: 1px solid #cdcdcd;
	 			width: 24%; height: 180px;}
	 .copy-t p{font-weight: lighter; font-size: 0.8em; line-height: 7px; }
	 .copy-t h2{font-weight: lighter; font-size: 1.5em; font-weight: 200; font-family: copy;}
	</style>
	<meta charset="utf-8">
	<title>M'CR</title>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" oncontextmenu="return false" ondragstart="return false"
onselectstart="return false">
	<div class="top1">
		<div class="sname"><a href="./index.php">M'CR</a></div>
			<div class="menu-list-b" >
				<a href="./brand.php"><b>브랜드</b></a>
					<div class="sub-menu">
						<div class="gucci"><a href="./gucci.php">구찌</a></div>
						<div><a href="./dior.php">디올</a></div> 
						<div><a href="./louis.php">루이 비통</a></div> 
						<div><a href="./bbr.php">버버리</a></div> 
						<div><a href="./chan.php">샤넬</a></div> 
						<div><a href="./given.php">지방시</a></div> 
						<div><a href="./ck.php">캘빈 클라인</a></div> 
						<div><a href="./prada.php">프라다</a></div> 
					</div>
			</div>
		<div class="menu-list-s" ><a href="./store.php"><b>스토어</b></a>
				<div class="sub-menu2">
					<div><a href="./store.php">서울점</a></div> 
					<div><a href="./store-sw.php">수원점</a></div> 
					<div><a href="./store-ca.php">천안점</a></div> 
					<div><a href="./store-bs.php">부산점</a></div> 
				</div>
		</div>
		<div class="menu-list-n" ><a href="./notice.php"><b>공지사항</a></b>
				<div class="sub-menu3">
					<div><a href="./introduce.php">사이트 소개</a></div> 
					<div><a href="./notice.php">공지사항</a></div> 
				</div>
		</div>
		<div class="menu-list-c" ><a href="./qna.php"><b>고객센터</a></b>
				<div class="sub-menu4">
					<div><a href="./qna.php">자주 묻는 질문</a></div> 
					<div><a href="./mtm.php">문의하기</a></div> 
				</div>
		</div>
		<input name="menu_tree" id="menu_tr1" type="checkbox" class="menutr1">
		<label for="menu_tr1" class="tree">
			<div class="tbox">
				<div class="line1"></div>
				<div class="line2"></div>
				<div class="line3"></div>
			</div>
		</label>

		<div class="slide_box">
		      <div class="login" align="center">
		          <?php include "./login_header.php";?>
		       </div>
   		 </div>

<div class="menu-arrow">결제</div>
<form name='buys_post' action='./buys_post.php' method='post' enctype='multipart/form-data'>
	<input type='hidden' name='totals' value="<?=$totals?>">
	<input type='hidden' name='_count' value="<?=$count?>"> 
	<input type='hidden' name='uid' value="<?=$_SESSION["uid"]?>">
	
<div class = "wrap">
	<div class ="wrap2">		
		<?php
		 
		 try{
		     $sql = "select * from dnjstjq25.per_up where no='$no' ";
		     $stmh = $pdo->prepare($sql);  
		     $stmh->bindValue(1, $no, PDO::PARAM_STR);      
		     $stmh->execute();            
		      
		    while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
		 	
		    $item_file01  = $row["file01"];  //사진
		    $item_subject = str_replace(" ", "&nbsp;", $row["subject"]); //상품명
		    $item_price   = $row["price"]; //가격
		 ?>
		
        <div id="view_title">
	         <div id="view_img">
				<img src="./data/<?=$row['file01']?>" width="150px" height="150px"></a>
	         </div>
	         <div class="view_subject">
		  		* 상품명 : <?=$row['subject'] ?><br>
		  		<input type='hidden' name='subject' value="<?=$item_subject?>"><!--상품명 저장-->
	         	* 가격 : ₩<?=number_format($row['price'])?><br>
	         	* 수량 : <?=$count?>개<br>
	         	<?$totals=$row['price'] * $count?>
				* 총 결제 금액 : <?=number_format($totals)?>원	 	
	         </div>
	         <div class="pay_info">
	         	* 수신자 <input type="text" class="pay_infom" id="pay_name" name="name" value="<?=$_SESSION["name"]?>"><br>
	         	* 주소 <input type="text" class="pay_infom" id="pay_juso" name="juso" value="<?=$_SESSION["juso"]?>"><br>
	         	* 전화번호 <input type="text" class="pay_infom" id="pay_phone" name="phone" value="<?=$_SESSION["phone"]?>"><br>
	         	<p id=pay_noti>* 결제는 무통장입금만 가능합니다.</p>
	         	* 송신자명 <input type="text" class="pay_infom" id="pay_per" name="pay_per"><br>
	         	* 계좌번호 <input type="text" class="pay_infom" id="pay_num" name="pay_num"> (' - ' 없이 입력하시고 은행명도 함께 적어주세요.)
	         </div>
	         <div class="pay_bt"><input type="submit" name="buys_post" value="결제하기"></div>
		</div>
		<?php  
		  }
		  } catch (PDOException $Exception) {
		       print "오류: ".$Exception->getMessage();
		  }
		 ?> 
		</form> 
	</div>
</div>
<div class="copy">
	<ul class="copy-t">
		<li>
		<h2>ACCOUNT NO</h2>
		<p>국민 475402-04-158972</p>
		<p>농협 485081-51-093625</p>
		<p>예금주 : 이원섭</p>
		</li>

		<li>
		<h2>M'CR</h2>
		<p>대표: 이원섭 | 상호: M'CR</p>
		<p>전자우편:dnjstjq25@naver.com</p>
		<p>주소 : 충청남도 천안시 서북구 직산읍</p>
		</li>

		<li>
		<h2>CS CENTER</h2>
		<p>문의는 고객센터 메뉴를 이용해주세요.</p>
		<p>토요일/일요일/공휴일 OFF</p>
		<p>반품주소지 : 충청남도 천안시 서북구 직산읍</p>
		</li>

		<li>
		<h2>Copyright</h2>
		<p>@M'CR all right reserved</p>
		<p>Designed by M'CR</p>
		</li>
	</ul>
</div>	

</body>
</html>
