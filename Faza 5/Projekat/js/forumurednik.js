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
	
		xmlhttp.open("POST", "http://[::1]/Projekat/index.php/forumurednik/dodajKomentar",true);
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
	
		xmlhttp.open("POST", "http://[::1]/Projekat/index.php/forumurednik/dodajPost",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("tekst=" + document.getElementById("postpolje").value + "&korisnikid=" + korisnikid);
		
		document.getElementById("postpolje").value = "";
		document.getElementById("postpolje").placeholder = "Unesite post ovde";
		document.getElementById("postpolje").style.display = "none";
		document.getElementById("postdugme").innerHTML = "Pisi post";
	
	}

}

function upozoriPost(postid) {

	post = "post" + postid;
	upozoridugme = "postupozoridugme" + postid;
	upozoripolje = "postupozoripolje" + postid; 

	if(document.getElementById(upozoridugme).innerHTML == "Upozori") {
		document.getElementById(upozoridugme).innerHTML = "Dodaj upozorenje";
		document.getElementById(upozoripolje).style.display = "inline";
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
				document.getElementById(post).innerHTML = xmlhttp.responseText;
			}
		}
	
		xmlhttp.open("POST", "http://[::1]/Projekat/index.php/forumurednik/upozoriPost",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("poruka=" + document.getElementById(upozoripolje).value + "&postid=" + postid);
	
	}

}

function upozoriKomentar(komentarid) {

	komentar = "postkomentar" + komentarid;
	upozoridugme = "komentarupozoridugme" + komentarid;
	upozoripolje = "komentarupozoripolje" + komentarid; 

	if(document.getElementById(upozoridugme).innerHTML == "Upozori") {
		document.getElementById(upozoridugme).innerHTML = "Dodaj upozorenje";
		document.getElementById(upozoripolje).style.display = "inline";
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
	
		xmlhttp.open("POST", "http://[::1]/Projekat/index.php/forumurednik/upozoriKomentar",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("poruka=" + document.getElementById(upozoripolje).value + "&komentarid=" + komentarid);
	
	}

}

