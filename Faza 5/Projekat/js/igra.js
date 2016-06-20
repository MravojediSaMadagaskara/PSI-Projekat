// Autor: Jovan Nikolic

var redniBroj = 0;

function sledecePitanje(rezultat) {

	var izabraniOdgovor = 0;
	
	for(var i = 1; i < 5; i++) {
		if(document.getElementById("ponudjeniodgovor"+i).checked) {
			izabraniOdgovor = i;
			break;
		}
	}
	
	if(izabraniOdgovor == 0) {
		document.getElementById("poruka").innerHTML = "<div id = 'upozorenje'>Niste odgovorili na pitanje, da li zelite da nastavite dalje?<br><br><button type = 'button' onclick = 'sled(" + rezultat + "," + izabraniOdgovor + ")'>Da</button>&nbsp&nbsp<button type = 'button' onclick = 'ne()'>Ne</button></div><br>";
	}
	else {
		sled(rezultat, izabraniOdgovor);
	}
	
}

function prekiniPokusaj(korisnik) {
	
	document.getElementById("poruka").innerHTML = "<div id = 'upozorenje'>Da li ste sigurni da zelite da odustanete?<br><br><button type = 'button' onclick = 'prek(" + korisnik + ")'>Da</button>&nbsp&nbsp<button type = 'button' onclick = 'ne()'>Ne</button></div><br>";
	
}


function sled(rezultat, izabraniOdgovor) {

	document.getElementById('obavestenje').style.display = "none";

	redniBroj++;
	if(redniBroj == 3) {
		document.getElementById("sledece").innerHTML = "Kraj kviza";
	}

	if (window.XMLHttpRequest){
		var xmlhttp = new XMLHttpRequest();
	}
	else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("pitanjeiodgovori").innerHTML = xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("POST", "http://[::1]/Projekat/index.php/igra/osveziPitanje", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("rezultat=" + rezultat + "&izabraniOdgovor=" + izabraniOdgovor + "&redniBroj=" + redniBroj);
	
	document.getElementById("poruka").innerHTML = "";
	
	if(redniBroj == 4) {
		document.getElementById("sledece").style.display = "none";
		document.getElementById("prekini").style.display = "none";
		document.getElementById("prijavi").style.display = "none";
		document.getElementById("ponovo").style.display = "inline";
	}
	
}

function prek(korisnik) {

	window.location.href="http://[::1]/Projekat/index.php/indexkorisnik/index/" + korisnik;
	
}

function ne() {
	document.getElementById("poruka").innerHTML = "";
}