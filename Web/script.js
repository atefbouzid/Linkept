function tabtoggle(btnval){
	if(btnval=="t1"){
		document.getElementById("t2").style.display="none";
		document.getElementById("t1").style.display="block";
		document.getElementById('b1').removeAttribute("class");
		document.getElementById('b1').setAttribute("class","tp-btn tp-btnstyle active");
		document.getElementById('b2').removeAttribute("class");
		document.getElementById('b2').setAttribute("class","tp-btn tp-btnstyle inactive");
	}else if(btnval=="t2"){
		document.getElementById("t1").style.display="none";
		document.getElementById("t2").style.display="block";
		document.getElementById('b1').removeAttribute("class");
		document.getElementById('b1').setAttribute("class","tp-btn tp-btnstyle inactive");
		document.getElementById('b2').removeAttribute("class");
		document.getElementById('b2').setAttribute("class","tp-btn tp-btnstyle active");		
	}
	//document.getElementById("t1").style.display="none";
}