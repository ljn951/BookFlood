window.onload=agenda;
var judge_1=0;
function agenda()
{
document.getElementById("back").onclick=function(){back()};
}
function back()
{
window.location.href = "micro_login.php";
}
function mOver(obj)
{	
	obj.style.backgroundImage="url(image/button3.png)";
}

function mOut(obj)
{	
	obj.style.backgroundImage="url(image/button1.png)";
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