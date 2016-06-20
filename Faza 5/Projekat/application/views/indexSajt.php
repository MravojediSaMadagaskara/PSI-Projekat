<!-- Autor: Jovan Nikolic -->

<html>
	<head>
		<title> &#381;elite li da postanete multiplekser </title>
		
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/css index.css">

		<script type = 'text/javascript' src = "<?php echo base_url();?>js/js.js"></script>
	</head>
	<body  onload = "godine();">
		<div id = "gore">
			<div id = "gorelevo">
				&#381;elite li da postanete
				<br>
				MULTIPLEKSER
			</div>
			<div id = "goresredina">
				<img src = "<?php echo base_url();?>/slike/logo kviza.png"/>
			</div>
			
			<?php
				if ($poruka!=''){
					$str= '<div id="obavestenje">'.
						$poruka
						.'<br><button type="button" onclick="skloniobavestenje()"> OK </button>
					</div>';
					echo $str;
				}
			?>
			
			<div id = "goredesno">
				<form id = "stari" action="<?php echo site_url();?>/indexkorisnik/stari" method="post">
					<input type = "button" value = "Stari korisnik" style = "border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-right: solid 0.35vh #173A5A;;">
					<input type = "button" value = "Novi korisnik" onclick = "novi()" style = "border-top-left-radius: 0px; border-bottom-left-radius: 0px; border-left: solid 0.35vh #173A5A;">
					<br><br>
					<input type = "text" placeholder = "E-mail" name = "email_stari"/>
					<br>
					<input type = "password" placeholder = "Lozinka" name = "lozinka_stari"/>
					<br><br>
					<input type = "submit" value = "Prijavite se"/>
				</form>
				<form id = "novi" action="<?php echo site_url();?>/indexkorisnik/novi" method="post">
					<input type = "button" value = "Stari korisnik" onclick = "stari()" style = "border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-right: solid 0.35vh #173A5A;;">
					<input type = "button" value = "Novi korisnik" style = "border-top-left-radius: 0px; border-bottom-left-radius: 0px; border-left: solid 0.35vh #173A5A;">
					<br><br>
					<input type = "text" placeholder = "Korisnicko ime" name = "username_novi"/>
					<br>
					<input type = "password" placeholder = "Lozinka" name = "lozinka_novi"/>
					<br>
					<input type = "text" placeholder = "Ime i prezime" name = "ime_prezime"/>
					<br>
					<input type = "text" placeholder = "e-mail" name = "email"/>
					<br>
					<div id = "pol">
						Pol: &nbsp
						<input type = "radio" name = "pol" value="Muski"/> Muski
						<input type = "radio" name = "pol" value="Zenski"/> Zenski
					</div>
					<br>
					<div id = "godiste" style = "margin-top: -2.5vh">
						Godiste:
						<select id = "godine" name="godiste"> </select>
					</div>
					<br><br>
					<input type = "submit" value = "Registrujte se" style = "margin-top: -2.5vh"/>
				</form>
			</div>
		</div>
		<div id = "sredina">
			<div id = "sredinagore">
				Volite kvizove i edukativne igrice?
				<br>
				Zelite da proverite svoje poznavanje informatike i programiranja?
				<br>
				Registrujte se i uzivajte se u nasim kvizovima, ili isprobajte demo verziju odmah.
				<br>
				Sve ovo je potpuno besplatno, ali to nije sve!!!
				<br>
				Ukoliko odmah pritisnete simbol "x" u gornjem desnom uglu vaseg ekrena,
				ovaj veoma cudnovati prozor ce nestati iz vaseg zivota i zaboravicete da
				ste se ikada dospeli ovde.
			</div>
			<div id = "sredinadole">
				<!--a href = "registracija.html" style = "position: relative; right: 7.5%"> Registrujte se </a-->
				<a href = "<?php echo site_url();?>/igrademo"> Igrajte kviz </a>
			</div>
		</div>
		<div id = "dole">
			<div id = "dolelevo">
				<img src = "<?php echo base_url();?>/slike/logo tima.png"/>
			</div>
			<div id = "doledesno">
			Mravojedi sa Madagaskara
			</div>
		</div>
	</body>
</html>