<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=gbk"> 
<link rel="icon" href="image/log1.gif" type="image/gif" />
<TITLE>micro result</TITLE>
<script>
window.onload=agenda;
var h = 0;
var w = 0;
var t;
var judge_1=0;
function agenda()
{
	t = setInterval("move()",1);
	document.getElementById("back_1").onclick=function(){back()};
}
function move()
{
	h = h + 8;
	w = w + 23;
	var a = 302 - h;
	var b = w;
	document.getElementById("div2").style.height = a + "px";
	document.getElementById("group1").style.width = b + "px";
	if( h > 301 ){
			document.getElementById("group1").style.width = "900px";
			document.getElementById("div2").style.height = "0px";
			clearInterval(t);
	}
}
function back()
{
window.location.href="micro_login.php";
}
function mOver1()
{	
	document.getElementById("arrow").src="image/arrow1.png";
	document.getElementById("pp").style.color = "orange";
}

function mOut1()
{	
	document.getElementById("arrow").src="image/arrow.png";
	document.getElementById("pp").style.color = "gray";
}
</script>
<link href="micro_result.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>

	
<?php
$host='172.18.33.223:3306';
$user_name='root';
$password='1234';
$id=mysql_connect($host,$user_name,$password);
mysql_select_db('book_information',$id);
mysql_query("SET CHARACTER SET GBK");
$type=$_POST["type"];
$key = $_POST["key"];
$successful = false;
if($type &&  $key){
$query = "SELECT distinct *
          FROM book_information B,publisher_place A,book_pages C,book_type D
          WHERE (B.book_name='$key' OR B.publisher_name='$key') AND A.publisher_name = B.publisher_name   AND C.book_name = B.book_name AND D.book_name = B.book_name AND D.book_type = '$type'";
$result = mysql_query($query,$id);
}
if($type && ! $key) {
$query = "SELECT distinct *
          FROM book_information B,publisher_place A,book_pages C,book_type D
          WHERE A.publisher_name = B.publisher_name  AND C.book_name = B.book_name AND D.book_name = B.book_name AND D.book_type = '$type'";
$result = mysql_query($query,$id);
}
if(!$type && $key) {
$query = "SELECT distinct *
          FROM book_information B,publisher_place A,book_pages C,book_type D
          WHERE (B.book_name='$key' OR B.publisher_name='$key' ) AND A.publisher_name = B.publisher_name  AND C.book_name = B.book_name AND D.book_name = B.book_name";
$result = mysql_query($query,$id);
}
if(! $type && ! $key) {
$query = "SELECT distinct *
          FROM book_information B,publisher_place A,book_pages C,book_type D
          WHERE A.publisher_name = B.publisher_name AND C.book_name = B.book_name AND D.book_name = B.book_name";
$result = mysql_query($query,$id);
}


$datanum=mysql_num_rows($result);
if($datanum != 0) {


echo"<div id='div1'>
	<img src='imagenew/logo.gif' class='logo'/> 		
</div>
<div id='div2'>
	<p2>BOOK FLOOD</p2>
</div>
<div id='div3'>
<div id='left'><img src='image/img4.gif' class='img4'/> </div>
<div id='left'>
	<div><img src='image/img5.gif' class='img5'/></div>
	
	<div id='contain'>";
	for($i=0;$i<=$datanum;$i++) {
$info = mysql_fetch_array($result,MYSQL_ASSOC);
if($info['book_name']) {
		echo "<div id='group1'>
			<div id='informations'>
				<div class='title'>".$info['book_name']."</div>
				<div class='introduction'>".$info['book_introduction']."
				</div>
				<div id = 'others'>
				<span class='label'>出版社</span><span class='infor'>".$info['publisher_name']."</span>
				<div class='other'><span class='label'>书籍信息</span><span class='infor'> ".$info['place_name']." | ".$info['year_id']."   |   ".$info['book_pages']." 页</span></div>
				<div class='other'><span class='label'>书籍类型</span><span class='infor'>".$info['book_type']."</span></div>
				<div class='other'><span class='label'>联系人信息</span><span class='infor'>".$info['owner_name'].":".$info['phone_number']."</span></div>
				</div>
			</div>
			<div class='poster'>
				<img src=".$info['book_image']." height='360px' width='232px'/>
			</div>
		</div>";
		}
		}
	echo"</div>
	
	
</div>";

echo"
<div id='right'><img src='image/img6.gif' class='img4'/>  </div>
<div id='div8'><img src='image/img41.gif' class='img4'/> </div>
<div id='right'><img src='image/img61.gif' class='img4'/> </div>
<div id='logo2'><img src='imagenew/logo.gif' height='80px' width='240px'></div>
<div id='div54'><button type='back' value='Back' id='back_1' onmouseover='mOver1()' onmouseout='mOut1()'> 
	<div id='left'><img src='image/arrow.png' id='arrow'></div>
	<div id='left'><p id='pp'>  Click here to return</p></div>
	</button>
</div>
<div><img src='image/img51.gif' class='img51'/> </div>
</div>";

}
else {
echo "<script>alert('no movie have been founded')</script>";
}



mysql_close($id);
?>
  </BODY>
 </html>