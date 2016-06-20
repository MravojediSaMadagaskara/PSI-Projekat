/* Autor: Sofija Nicic */

function selektovanje(){
	
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	index=document.getElementById('pitanja').selectedIndex;
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
			document.getElementById("sredina").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/dodavanje/selektovanjeee", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("index="+index);
}

function odobri(){
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	index=document.getElementById('pitanja').selectedIndex;
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
			document.getElementById("sredina").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/dodavanje/odobri", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("index="+index);
}

function odbaci(){
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	index=document.getElementById('pitanja').selectedIndex;
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
			document.getElementById("sredina").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/dodavanje/odbaci", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("index="+index);
}

function izmenii(){
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	index=document.getElementById('pitanja').selectedIndex;
	postavka=document.getElementById('postavka').value;
	odg1=document.getElementById('odgovor1').value;
	odg2=document.getElementById('odgovor2').value;
	odg3=document.getElementById('odgovor3').value;
	odg4=document.getElementById('odgovor4').value;
	tacan=document.getElementById('tacanodgovor').options[document.getElementById('tacanodgovor').selectedIndex].value;
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
			document.getElementById("sredina").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/dodavanje/izmenii", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("index="+index+"&postavka="+postavka+"&odg1="+odg1+"&odg2="+odg2+"&odg3="+odg3+"&odg4="+odg4+"&tacan="+tacan);
}