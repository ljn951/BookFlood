<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=gbk"> 
<link rel="icon" href="image/log1.gif" type="image/gif" />
<TITLE>micro search</TITLE>
<script>
window.onload=agenda;
var judge_1=0;
function agenda()
{
document.getElementById("back_1").onclick=function(){back()};

}

function back()
{
window.location.href="micro_login.php";
}
function mOver(obj)
{	
document.getElementById("i").src="image/button5.png";
}

function mOut(obj)
{	
	document.getElementById("i").src="image/button4.png";
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
<link href="micro_search.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<div id="div1">
	<img src="imagenew/logo.gif" class="logo"/> 		
</div>
<div id="div2" style="background-image:url('imagenew/img3.jpg')">
	<p2>BOOK FLOOD</p2>
</div>
<div id="div3">
<div id="left"><img src="image/img4.gif" class="img4"/> </div>
<div id="left">
	<div><img src="image/img5.gif" class="img5"/></div>
	<div id="div5">
		<div id="div51">
			<p4>■</p4><p5> Find the books you like </p5>
		</div>
		<div id="contain">
			<form name="form2" method="post" action="micro_result.php">
				<div id="information">
				</br>
				</br>
				<div id="div52">
				 Type: <select name="type">
	 <option></option>
      <option value="科教">科教</option>
      <option value="小说">小说</option> 
      <option value="散文">散文</option>
	  <option value="传记">传记</option>
	  <option value="历史">历史</option>
      </select>
				</div>
					</br>
				<div id="div52">
					<p>book/publisher/place name:	<input type="text" name="key" charset=GBK/>
					</br>
				</p></div>
				</div>
				</br>
				</br>
				<div id="button">
				<button type="submit" value="Submit" id="submit" onmouseover="mOver()" onmouseout="mOut()" >
				<img src="image/button4.png" height="56px" width="171px" id="i"/>
				</button>
				</br>
				</br>
				</br>
				</div>
				</form>
		</div>
	</div>
</div>
<div id="right"><img src="image/img6.gif" class="img4"/>  </div>
<div id="div8"><img src="image/img41.gif" class="img4"/> </div>
<div id="right"><img src="image/img61.gif" class="img4"/> </div>
<div id="div53">
	<div>NOTE: All fields are optional to fill in.</div>
</div>
<div id="logo2"><img src="imagenew/logo.gif" height="80px" width="240px"></div>
<div id="div54"><button type="back" value="Back" id="back_1" onmouseover="mOver1()" onmouseout="mOut1()"> 
	<div id="left"><img src="image/arrow.png" id="arrow"></div>
	<div id="left"><p id="pp">  Click here to return</p></div>
	</button>
</div>
<div><img src="image/img51.gif" class="img51"/> </div>
</div>
  </BODY>
  </HTML>