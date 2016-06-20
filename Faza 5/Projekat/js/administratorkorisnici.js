/* Autor: Sofija Nicic */

function selektovanje(vrsta){
	
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	index=document.getElementById('korisnici').selectedIndex;
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
			document.getElementById("tekst").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/administratorkorisnici/selektovanjeee", true);
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
	
	indexprijavljena=document.getElementById('prijavljenapitanja').selectedIndex;
	indexostala=document.getElementById('ostalapitanja').selectedIndex;
	if (indexprijavljena==-1){
		index=indexostala;
		vrsta="Ostala";
	}
	else{
		index=indexprijavljena;
		vrsta="Prijavljena";
	}
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
			document.getElementById("sredina").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/uredjivanje/obrisi", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("index="+index+"&vrsta="+vrsta);
}