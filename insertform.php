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
.reg_bt{margin-top: 30px; margin-left: 390px;}
.reg_bt{width: 300px; height: 40px; background-color: black; color: white; border: none;}
.reg_bt:hover{text-decoration: none; animation: a 0.5s ease-in-out; -webkit-animation: a 0.5s ease-in-out; 
      color: #fff;}
      @-webkit-keyframes a {0%{color: #000}100%{color: #fff}}
      @keyframes a {0%{color: #000}100%{color: #fff}}
</style>
</head>
<body>
<div>
  <!-- 입력 폼을 만든다 -->
  <form method="POST" action="insert_member.php" class="reg">
    <p id=an><label id=ad>* </label> 전부 다 채워주셔야 됩니다.</p>
    <table>
      <tr>
        <td class="label-w"><label>아이디</label><label id=ad> *</label></td>
        <td><input type="text" name="uid" placeholder="아이디" class="ip"></td>
      </tr>
      <tr>
        <td><label>비밀번호</label><label id=ad> *</label></td>
        <td><input type="password" name="pwd" placeholder="비번" class="ip"></td>
      </tr>
       <tr>
       <td><label>이름</label><label id=ad> *</label></td>
       <td><input type="text" name="name" placeholder="이름" class="ip"></td>
      </tr>
      <tr>
        <td><label>전화번호</label><label id=ad> *</label></td>
        <td><input type="text" name="phone" placeholder="전화번호" class="ip"></td>
      </tr>
      <tr>
        <td><label>나이</label><label id=ad> *</label></td>
        <td><input type="number" name="age" placeholder="나이" class="ip"></td>  
      </tr>
      <tr><td>성별<label id=ad> *</label></td>
        <td><label><input type="radio" name="sex" value="남" checked >남성</label>
        <label><input type="radio" name="sex" value="여" >여성</label></td>
      </tr>
      <tr><td>이메일<label id=ad> *</label></td>
         <td><input type="text" name="email" placeholder="이메일" class="ip"></td>
      </tr>
      <tr>
        <td><label>주소<label id=ad> *</label></label></td>
        <td><input type="text" name="juso" placeholder="주소" class="ip"></td>
      </tr>
    </table>
     <input type="submit" value="회원가입" class="reg_bt">
  </form>
</div>
</body>
</html>
