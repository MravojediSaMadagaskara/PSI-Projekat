/* Autor: Sofija Nicic */

function selektovanje(){
	
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	index=document.getElementById('korisnici').selectedIndex;
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
			document.getElementById("sredina").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/adminkorisnici/selektovanjeee", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("index="+index);
}

function obrisi(){
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	index=document.getElementById('korisnici').selectedIndex;
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
			document.getElementById("sredina").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/adminkorisnici/obrisi", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("index="+index);
}


function obrisiprijavu(){
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	index=document.getElementById('korisnici').selectedIndex;
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
			document.getElementById("sredina").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/adminkorisnici/obrisiprijavu", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("index="+index);
}