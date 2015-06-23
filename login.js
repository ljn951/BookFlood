    window.onload=agenda;
	var judge_1=0;
	var w = document.documentElement.clientWidth;
	var h = document.documentElement.clientHeight;
function agenda()
{
	document.getElementById("login").onclick=function(){back()};
    var a = 8*h;
	var b = 5*w;
	if( a > b ){
		document.getElementById("bgimg").style.height = h+"px";
		document.getElementById("bgimg").style.width = 1.6 * h+"px";
		document.getElementById("form").style.left = 0.971* h+"px";
		document.getElementById("form").style.top = 0.117* h+"px";
		}
	else {
		document.getElementById("bgimg").style.width = w+"px";
		document.getElementById("bgimg").style.height = w/1.6+"px";
		document.getElementById("form").style.left = 0.61* w+"px";
		document.getElementById("form").style.top = 0.073* w+"px";
		}

}
function back()
{
window.location.href="micro_register.html";
}
