// Autor: Jovan Nikolic

function dodajKomentar(korisnikid, postid) {

	komentardugme = "komentardugme" + postid;
	komentarpolje = "komentarpolje" + postid;
	postkomentari = "postkomentari" + postid;
	
	if(document.getElementById(komentardugme).innerHTML == "Pisi komentar") {
		document.getElementById(komentardugme).innerHTML = "Dodaj komentar";
		document.getElementById(komentarpolje).style.display = "inline";
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
				document.getElementById(postkomentari).innerHTML += xmlhttp.responseText;
			}
		}
	
		xmlhttp.open("POST", "http://[::1]/Projekat/index.php/forum/dodajKomentar",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("tekst=" + document.getElementById(komentarpolje).value + "&korisnikid=" + korisnikid + "&postid=" + postid);
		
		document.getElementById(komentarpolje).value = "";
		document.getElementById(komentarpolje).placeholder = "Unesite komentar ovde";
		document.getElementById(komentarpolje).style.display = "none";
		document.getElementById(komentardugme).innerHTML = "Pisi komentar";
	
	}

}

function dodajPost(korisnikid) {
	
	if(document.getElementById("postdugme").innerHTML == "Pisi post") {
		document.getElementById("postdugme").innerHTML = "Dodaj post";
		document.getElementById("postpolje").style.display = "inline";
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
				document.getElementById("postovi").innerHTML += xmlhttp.responseText;
			}
		}
	
		xmlhttp.open("POST", "http://[::1]/Projekat/index.php/forum/dodajPost",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("tekst=" + document.getElementById("postpolje").value + "&korisnikid=" + korisnikid);
		
		document.getElementById("postpolje").value = "";
		document.getElementById("postpolje").placeholder = "Unesite post ovde";
		document.getElementById("postpolje").style.display = "none";
		document.getElementById("postdugme").innerHTML = "Pisi post";
	
	}

}