// Autor: Jovan Nikolic

function prikaziKomentar(id) {
	
	porukapolje = "porukapoljekomentar" + id;
	porukadugme = "porukadugmekomentar" + id;
	komentar = "komentar" + id;
	
	if(document.getElementById(porukadugme).innerHTML == "Prikazi") {
		document.getElementById(porukadugme).innerHTML = "Obrisi";
		document.getElementById(porukapolje).style.display = "block";
	}
	else {
	
		if (window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}
		else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById(komentar).innerHTML = xmlhttp.responseText;
			}
		}
	
		xmlhttp.open("POST", "http://[::1]/Projekat/index.php/IndexKorisnik/Komentar",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("id=" + id);

	}
	
}

function prikaziUpozorenje(id) {
	
	porukapolje = "porukapoljeupozorenje" + id;
	porukadugme = "porukadugmeupozorenje" + id;
	upozorenje = "upozorenje" + id;
	
	if(document.getElementById(porukadugme).innerHTML == "Prikazi") {
		document.getElementById(porukadugme).innerHTML = "Obrisi";
		document.getElementById(porukapolje).style.display = "block";
	}
	else {
	
		if (window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}
		else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById(upozorenje).innerHTML = xmlhttp.responseText;
			}
		}
	
		xmlhttp.open("POST", "http://[::1]/Projekat/index.php/IndexKorisnik/Upozorenje",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("id=" + id);

	}
	
}

function prikaziPitanje(id) {
	
	porukapolje = "porukapoljepitanje" + id;
	porukadugme = "porukadugmepitanje" + id;
	pitanje = "pitanje" + id;
	
	if(document.getElementById(porukadugme).innerHTML == "Prikazi") {
		document.getElementById(porukadugme).innerHTML = "Obrisi";
		document.getElementById(porukapolje).style.display = "block";
	}
	else {
	
		if (window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}
		else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById(pitanje).innerHTML = xmlhttp.responseText;
			}
		}
	
		xmlhttp.open("POST", "http://[::1]/Projekat/index.php/IndexKorisnik/Pitanje",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("id=" + id);

	}
	
}
