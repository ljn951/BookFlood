<?php
$host='172.18.33.223:3306';
$user_name='root';
$password='1234';
$id=mysql_connect($host,$user_name,$password);
mysql_select_db("user_information",$id);
mysql_query("SET CHARACTER SET utf8");
$target_name = $_POST["name_1"];
$target_password = $_POST["password_1"];

$query = "SELECT *
          FROM  user A
          WHERE A.name='$target_name' AND A.password = '$target_password' ";
$result = mysql_query($query,$id);
$datanum=mysql_num_rows($result);
if($target_name && $target_password){
setcookie("login");
if($datanum != 0){


setcookie("login",$target_name,Time()+300);
echo "<script>alert('登陆成功')</script>";
echo "<script language=JavaScript> location.replace(location.href);</script>";
}
else{

setcookie("login","falsename",Time()+300);
echo "<script>alert('登陆失败')</script>";
echo "<script language=JavaScript> location.replace(location.href);</script>";
}
}
mysql_close($id);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<TITLE>micro film</TITLE>
<script>
function mOver(obj)
{	
	obj.src="image/button2.png";
}

function mOut(obj)
{	
	obj.src="image/button.png";
}


function $a(id,tag){var re=(id&&typeof id!="string")?id:document.getElementById(id);if(!tag){return re;}else{return re.getElementsByTagName(tag);}}


function movec()
{
	var o=$a("bd1lfimg","");
	var oli=$a("bd1lfimg","dl");
    var oliw=oli[0].offsetWidth; //每次移动的宽度	 
	var ow=o.offsetWidth-2;
	var dnow=0; //当前位置	
	var olf=oliw-(ow-oliw+10)/2;
		o["scrollLeft"]=olf+(dnow*oliw);
	var rqbd=$a("bd1lfsj","ul")[0];
	var extime;

	<!--for(var i=1;i<oli.length;i++){rqbd.innerHTML+="<li>"+i+"</li>";}-->
	var rq=$a("bd1lfsj","li");
	for(var i=0;i<rq.length;i++){reg(i);};
	oli[dnow].className=rq[dnow].className="show";
	var wwww=setInterval(uu,2000);

	function reg(i){rq[i].onclick=function(){oli[dnow].className=rq[dnow].className="";dnow=i;oli[dnow].className=rq[dnow].className="show";mv();}}
	function mv(){clearInterval(extime);clearInterval(wwww);extime=setInterval(bc,15);wwww=setInterval(uu,6000);}
	function bc()
	{
		var ns=((dnow*oliw+olf)-o["scrollLeft"]);
		var v=ns>0?Math.ceil(ns/10):Math.floor(ns/10);
		o["scrollLeft"]+=v;if(v==0){clearInterval(extime);oli[dnow].className=rq[dnow].className="show";v=null;}
	}
	function uu()
	{
		if(dnow<oli.length-2)
		{
			oli[dnow].className=rq[dnow].className="";
			dnow++;
			oli[dnow].className=rq[dnow].className="show";
		}
		else{oli[dnow].className=rq[dnow].className="";dnow=0;oli[dnow].className=rq[dnow].className="show";}
		mv();
	}
	o.onmouseover=function(){clearInterval(extime);clearInterval(wwww);}
	o.onmouseout=function(){extime=setInterval(bc,15);wwww=setInterval(uu,6000);}
}
</script>
<link rel="icon" href="image/log1.gif" type="image/gif" />
<link href="micro_login1.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<?php

$host='127.0.0.1:3306';
$user_name='root';
$password='1234';
$id=mysql_connect($host,$user_name,$password);
mysql_select_db("book_information",$id);
mysql_query("SET CHARACTER SET utf8");
$query = "SELECT *
          FROM book_information B,publisher_place A,book_pages C,book_type D
          WHERE A.publisher_name = B.publisher_name AND C.book_name = B.book_name AND D.book_name = B.book_name";
$result = mysql_query($query,$id);
$datanum=mysql_num_rows($result);
mysql_close($id);
echo"
<div id='div1'>
	<img src='imagenew/logo.gif' class='logo'/> 		
<p1>Welcome to Book Flood! </p1>";
$answer = $_COOKIE['login'];
echo"<button type='submit' value='Logout' id='logout_first' ><img class='buttons_1'  src='image/logout.png' />";
echo"<button type='submit' value='Login' id='login_first' ><img class='buttons_1'  src='image/login.png' />";
echo"
</div>
<div class='sub_box'>
	<div id='p-select' class='sub_nav'>
		<div class='sub_no' id='bd1lfsj'>
			<ul>
				<li class='show'>1</li>
				<li>2</li>
				<li>3</li>
				<li>4</li>
				<li>5</li>
			</ul>
		</div>
	</div>";
	echo"
	<div id='bd1lfimg'>";
		echo"<div>";
		for($i=0;$i<5;$i++) {
		
		$info = mysql_fetch_array($result,MYSQL_ASSOC);
		if($info['book_name']) {
			echo"<dl><dt><img src=".$info['book_image']."></a></dt>";
				echo"<dd><h2>".$info['book_name']."</h2><tt>".$info['book_introduction']."</tt></dd></dl>";
		}
		}
		echo"</div>";
	echo"</div>";
	echo"<script type='text/javascript'>movec();</script>";
echo"</div>";
echo"
<div id='div3'>
<div id='left'><img src='image/img4.gif' class='img4'/> </div>
<div id='left'>
	<div><img src='image/img5.gif' class='img5'/></div>
	<div id='div5'>
		<div id='div51'>
			<p4>■</p4> <p5>UPLOAD YOUR BOOKS.</p5>
		</div>
		<div id='right'>
			<button type='submit' value='Login' id='login' >
				<img class='buttons' onmouseover='mOver(this)' onmouseout='mOut(this)' src='image/button.png' />
			</button>
		</div>
	</div>
	<div id='div7'>
		<div id='div51'>
			<p4>■</p4> <p5>CHECK OUT YOUR BOOKS.</p5>
		</div>
		<div id='right'>
			<button type='submit' value='Login' id='check' >
				<img class='buttons' onmouseover='mOver(this)' onmouseout='mOut(this)' src='image/button.png' />
			</button>
		</div>
	</div>
	<div id='div6'>
		<div id='div51'>
			<p4>■</p4> <p5>SEARCH FOR BOOKS</p5>
		</div>
		<div id='right'>
			<button type='submit' value='Find' id='find' onmouseover='mOver(this)' onmouseout='mOut(this)'>
				<img class='buttons' onmouseover='mOver(this)' onmouseout='mOut(this)' src='image/button.png' />
			</button>
		</div>
	</div>
</div>
<div id='right'><img src='image/img6.gif' class='img4'/>  </div>
<div id='div8'><img src='image/img41.gif' class='img4'/> </div>
<div id='right'><img src='image/img61.gif' class='img4'/> </div>
<div><img src='image/img51.gif' class='img51'/> </div>
</div>


";
 ?>
 <script>
window.onload=agenda;
function agenda()
{

document.getElementById("login").onclick=function(){login()};
document.getElementById("find").onclick=function(){find()};
document.getElementById("check").onclick=function(){check()};
var judge = '<?php echo $_COOKIE['login'];?>';
if(judge != "falsename" && judge !=""){
document.getElementById("login_first").style.display = "none";
}
document.getElementById("login_first").onclick = function(){login_first()};
document.getElementById("logout_first").onclick = function(){logout_first()};
}
function login()
{
var judge = '<?php echo $_COOKIE['login'];?>';

if(judge != "falsename" && judge !="")
window.location.href="micro_main.html";
else
alert("请先登录再上传")
}

function find()
{
var judge = '<?php echo $_COOKIE['login'];?>';

if(judge != "falsename" && judge !="")
window.location.href="micro_search.html";
else
alert("请先登录再查询")
}
function check()
{
var judge = '<?php echo $_COOKIE['login'];?>';

if(judge != "falsename" && judge !="")
window.location.href="micro_check.php";
else
alert("请先登录再查询")
}

function login_first()
{
window.location.href="login.html";
}
function logout_first()
{
alert("注销成功，请重新登录")
window.location.href="login.html";
}
function mOver(obj)
{	
	obj.src="image/button2.png";
}

function mOut(obj)
{	
	obj.src="image/button.png";
}


function $a(id,tag){var re=(id&&typeof id!="string")?id:document.getElementById(id);if(!tag){return re;}else{return re.getElementsByTagName(tag);}}


function movec()
{
	var o=$a("bd1lfimg","");
	var oli=$a("bd1lfimg","dl");
    var oliw=oli[0].offsetWidth; //每次移动的宽度	 
	var ow=o.offsetWidth-2;
	var dnow=0; //当前位置	
	var olf=oliw-(ow-oliw+10)/2;
		o["scrollLeft"]=olf+(dnow*oliw);
	var rqbd=$a("bd1lfsj","ul")[0];
	var extime;

	<!--for(var i=1;i<oli.length;i++){rqbd.innerHTML+="<li>"+i+"</li>";}-->
	var rq=$a("bd1lfsj","li");
	for(var i=0;i<rq.length;i++){reg(i);};
	oli[dnow].className=rq[dnow].className="show";
	var wwww=setInterval(uu,2000);

	function reg(i){rq[i].onclick=function(){oli[dnow].className=rq[dnow].className="";dnow=i;oli[dnow].className=rq[dnow].className="show";mv();}}
	function mv(){clearInterval(extime);clearInterval(wwww);extime=setInterval(bc,15);wwww=setInterval(uu,6000);}
	function bc()
	{
		var ns=((dnow*oliw+olf)-o["scrollLeft"]);
		var v=ns>0?Math.ceil(ns/10):Math.floor(ns/10);
		o["scrollLeft"]+=v;if(v==0){clearInterval(extime);oli[dnow].className=rq[dnow].className="show";v=null;}
	}
	function uu()
	{
		if(dnow<oli.length-2)
		{
			oli[dnow].className=rq[dnow].className="";
			dnow++;
			oli[dnow].className=rq[dnow].className="show";
		}
		else{oli[dnow].className=rq[dnow].className="";dnow=0;oli[dnow].className=rq[dnow].className="show";}
		mv();
	}
	o.onmouseover=function(){clearInterval(extime);clearInterval(wwww);}
	o.onmouseout=function(){extime=setInterval(bc,15);wwww=setInterval(uu,6000);}
}
</script>
</BODY>
</html>