/* Autor: Sofija Nicic */

function selektovanje(vrsta){
	
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if (vrsta=="Prijavljena")
		index=document.getElementById('prijavljenapitanja').selectedIndex;
	else
		index=document.getElementById('ostalapitanja').selectedIndex;
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
			document.getElementById("sredina").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/uredjivanje/selektovanjeee", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("index="+index+"&vrsta="+vrsta);
}

function ostavi(){
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	index=document.getElementById('prijavljenapitanja').selectedIndex;
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
			document.getElementById("sredina").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/uredjivanje/ostavi", true);
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

function izmenii(){
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
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/uredjivanje/izmenii", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("index="+index+"&vrsta="+vrsta+"&postavka="+postavka+"&odg1="+odg1+"&odg2="+odg2+"&odg3="+odg3+"&odg4="+odg4+"&tacan="+tacan);
}