/* Autor: Sofija Nicic */

function selektovanje(){
	
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	index=document.getElementById('urednici').selectedIndex;
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
			document.getElementById("sredinadole").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/adminurednici/selektovanjeee", true);
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
	
	index=document.getElementById('urednici').selectedIndex;
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
			document.getElementById("sredinadole").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/adminurednici/obrisi", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("index="+index);
}