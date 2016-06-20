/* Autor: Jovan Nikolic */

function godine() {
	document.getElementById('godine').innerHTML += '<option value="">Izaberite</option> <option value="1998">1998</option> <option value="1997">1997</option> <option value="1996">1996</option> <option value="1995">1995</option> <option value="1994">1994</option> <option value="1993">1993</option> <option value="1992">1992</option> <option value="1991">1991</option> <option value="1990">1990</option> <option value="1989">1989</option> <option value="1988">1988</option> <option value="1987">1987</option> <option value="1986">1986</option> <option value="1985">1985</option> <option value="1984">1984</option> <option value="1983">1983</option> <option value="1982">1982</option> <option value="1981">1981</option> <option value="1980">1980</option> <option value="1979">1979</option> <option value="1978">1978</option> <option value="1977">1977</option> <option value="1976">1976</option> <option value="1975">1975</option> <option value="1974">1974</option> <option value="1973">1973</option> <option value="1972">1972</option> <option value="1971">1971</option> <option value="1970">1970</option> <option value="1969">1969</option> <option value="1968">1968</option> <option value="1967">1967</option> <option value="1966">1966</option> <option value="1965">1965</option> <option value="1964">1964</option> <option value="1963">1963</option> <option value="1962">1962</option> <option value="1961">1961</option> <option value="1960">1960</option> <option value="1959">1959</option> <option value="1958">1958</option> <option value="1957">1957</option> <option value="1956">1956</option> <option value="1955">1955</option> <option value="1954">1954</option> <option value="1953">1953</option> <option value="1952">1952</option> <option value="1951">1951</option> <option value="1950">1950</option> <option value="1949">1949</option> <option value="1948">1948</option> <option value="1947">1947</option> <option value="1946">1946</option> <option value="1945">1945</option> <option value="1944">1944</option> <option value="1943">1943</option> <option value="1942">1942</option> <option value="1941">1941</option> <option value="1940">1940</option> <option value="1939">1939</option> <option value="1938">1938</option> <option value="1937">1937</option> <option value="1936">1936</option> <option value="1935">1935</option> <option value="1934">1934</option> <option value="1933">1933</option> <option value="1932">1932</option> <option value="1931">1931</option> <option value="1930">1930</option> <option value="1929">1929</option> <option value="1928">1928</option> <option value="1927">1927</option> <option value="1926">1926</option> <option value="1925">1925</option> <option value="1924">1924</option> <option value="1923">1923</option> <option value="1922">1922</option> <option value="1921">1921</option> <option value="1920">1920</option> <option value="1919">1919</option> <option value="1918">1918</option> <option value="1917">1917</option> <option value="1916">1916</option> <option value="1915">1915</option> <option value="1914">1914</option> <option value="1913">1913</option> <option value="1912">1912</option> <option value="1911">1911</option> <option value="1910">1910</option> <option value="1909">1909</option> <option value="1908">1908</option> <option value="1907">1907</option> <option value="1906">1906</option> <option value="1905">1905</option> <option value="1904">1904</option> <option value="1903">1903</option> <option value="1902">1902</option> <option value="1901">1901</option> <option value="1900">1900</option>';
}

function selektuj_godinu(godina){
	document.getElementById('godine').getElementsByTagName('option')[1998-godina+1].selected = 'selected';
}

function selektuj_pol(pol){
	if (pol=="Muski")
		document.getElementById('muski').checked="checked";
	else if (pol=="Zenski")
		document.getElementById('zenski').checked="checked";
}

function novi() {
	document.getElementById('stari').style.display = "none";
	document.getElementById('novi').style.display = "block";
}

function stari() {
	document.getElementById('stari').style.display = "block";
	document.getElementById('novi').style.display = "none";
}

function komentar() {
	if(document.getElementById('komentardugme').value == "Pisi komentar") {
		document.getElementById('komentarpolje').style.display = "inline";
		document.getElementById('komentardugme').value = "Dodaj komentar";
		document.getElementById('upozorenjedugme').style.display = "none";
	}
	else {
		document.getElementById('postkomentar').innerHTML += '<hr width = "80%" style = "position: relative; left: 10%">' + document.getElementById("komentarpolje").value;
		document.getElementById("komentarpolje").value = "Unesite komentar ovde";
		document.getElementById('komentarpolje').style.display = "none";
		document.getElementById('komentardugme').value = "Pisi komentar";
		document.getElementById('upozorenjedugme').style.display = "inline";
	}
}

function upozorenje() {
	if(document.getElementById('upozorenjedugme').value == "Upozori") {
		document.getElementById('upozorenjepolje').style.display = "inline";
		document.getElementById('upozorenjedugme').value = "Posalji upozorenje";
		document.getElementById('komentardugme').style.display = "none";
	}
	else {
		//document.getElementById('postkomentar').innerHTML += '<hr width = "80%" style = "position: relative; left: 10%">' + document.getElementById("komentarpolje").value;
		document.getElementById("upozorenjepolje").value = "Unesite poruku ovde";
		document.getElementById('upozorenjepolje').style.display = "none";
		document.getElementById('upozorenjedugme').value = "Upozori";
		document.getElementById('komentardugme').style.display = "inline";
		alert("Upozorenje uspesno postato");
	}
}

function upozorenjekom() {
	if(document.getElementById('upozorenjekomdugme').value == "Upozori") {
		document.getElementById('upozorenjekompolje').style.display = "inline";
		document.getElementById('upozorenjekomdugme').value = "Posalji upozorenje";
		document.getElementById('komentardugme').style.display = "none";
		document.getElementById('upozorenjedugme').style.display = "none";
	}
	else {
		//document.getElementById('postkomentar').innerHTML += '<hr width = "80%" style = "position: relative; left: 10%">' + document.getElementById("komentarpolje").value;
		document.getElementById("upozorenjekompolje").value = "Unesite poruku ovde";
		document.getElementById('upozorenjekompolje').style.display = "none";
		document.getElementById('upozorenjekomdugme').value = "Upozori";
		document.getElementById('komentardugme').style.display = "inline";
		document.getElementById('upozorenjedugme').style.display = "inline";
		alert("Upozorenje uspesno postato");
	}
}

function post() {
	if(document.getElementById('postdugme').style.display == 'inline') {
		document.getElementById('postpolje').style.display = "inline";
		//document.getElementById('postdugme').value = "Dodaj post";
		document.getElementById('postdugme').style.display = 'none';
		document.getElementById('dodajpostdugme').style.display = 'inline';
	}
	else {
		document.getElementById('prostor').innerHTML += '<br><div id = "post">' + document.getElementById('postpolje').value + '</div>';
		document.getElementById("postpolje").value = "Unesite post ovde";
		document.getElementById('postpolje').style.display = "none";
		//document.getElementById('postdugme').value = "Pisi post";
		document.getElementById('postdugme').style.display = 'none';
		document.getElementById('dodajpostdugme').style.display = 'inline';
		//document.getElementById("postpolje").value=document.getElementById("postpolje").innerHTML;
		//alert(document.getElementById("postpolje").innerHTML);
		//alert(document.getElementById("postpolje").value);
	}
}

function popuni() {
	document.getElementById('korisnickoime').value = "moje korisnicko ime";
	document.getElementById('lozinka').value = "moja lozinka";
	document.getElementById('imeprezime').value = "moje ime i prezime";
	document.getElementById('email').value = "moj e-mail";
	//document.getElementById('muski').checked = true;
	document.getElementById('godiste').value = "1950";
}

function izmeni_dugmad() {
	if(document.getElementById('izmeni').style.display == 'inline') {
		document.getElementById('korisnickoime').readOnly = false;
		document.getElementById('lozinka').readOnly = false;
		document.getElementById('imeprezime').readOnly = false;
		document.getElementById('email').readOnly = false;
		/*document.getElementById('muski').disabled = false;
		document.getElementById('zenski').disabled = false;
		document.getElementById('godine').disabled = false;*/
		document.getElementById('izmeni').style.display = 'none';
		document.getElementById('sacuvaj').style.display = 'inline';
		document.getElementById('otkazi').style.display = 'inline';
	}
	else {
		document.getElementById('korisnickoime').readOnly = true;
		document.getElementById('lozinka').readOnly = true;
		document.getElementById('imeprezime').readOnly = true;
		document.getElementById('email').readOnly = true;
		/*document.getElementById('muski').disabled = true;
		document.getElementById('zenski').disabled = true;
		document.getElementById('godine').disabled = true;*/
		document.getElementById('izmeni').style.display = 'inline';
		document.getElementById('sacuvaj').style.display = 'none';
		document.getElementById('otkazi').style.display = 'none';
	}
}
			
function prikazi_lozinku() {
	if(document.getElementById('prikazi').innerHTML == "Prikazi") {
		document.getElementById('lozinka').type = "text";
		document.getElementById('prikazi').innerHTML = "Sakrij";
	}
	else {
		document.getElementById('lozinka').type = "password";
		document.getElementById('prikazi').innerHTML = "Prikazi";
	}
}
			
function dodaj() {
	document.getElementById('pr').value = document.getElementById('un').value;
	document.getElementById('un').value = "";
}

function izmenipitanje() {
	if(document.getElementById('izmeni').style.display == 'inline') {
		document.getElementById('postavka').readOnly = false;
		document.getElementById('odgovor1').readOnly = false;
		document.getElementById('odgovor2').readOnly = false;
		document.getElementById('odgovor3').readOnly = false;
		document.getElementById('odgovor4').readOnly = false;
		document.getElementById('tacanodgovor').disabled = false;
		document.getElementById('izmeni').style.display = 'none';
		document.getElementById('sacuvaj').style.display = 'inline';
		document.getElementById('otkazi').style.display = 'inline';
	}
	else {
		document.getElementById('postavka').readOnly = true;
		document.getElementById('odgovor1').readOnly = true;
		document.getElementById('odgovor2').readOnly = true;
		document.getElementById('odgovor3').readOnly = true;
		document.getElementById('odgovor4').readOnly = true;
		document.getElementById('tacanodgovor').disabled = true;
		document.getElementById('izmeni').style.display = 'inline';
		document.getElementById('sacuvaj').style.display = 'none';
		document.getElementById('otkazi').style.display = 'none';
	}
}

function skloniobavestenje(){
	document.getElementById('obavestenje').style.display = 'none';
}