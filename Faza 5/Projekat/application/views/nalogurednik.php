<!-- Autor: Jovan Nikolic -->

<html>
	<head>
		<title> &#381;elite li da postanete multiplekser </title>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/css.css"/>
		<script src = "<?php echo base_url();?>js/js.js"></script>
	</head>
	<body onload = "godine(); selektuj_godinu(<?php echo $godiste; ?>);"> <!--selektuj_pol('<?php echo $pol; ?>');-->
		<div id = "gore">
			<div id = "gorelevo">
				&#381;elite li da postanete
				<br>
				&nbsp MULTIPLEKSER
			</div>
			<div id = "goresredina">
				<?php echo $ime_prezime;?> <img id="slikalink" onclick = "window.location.href='<?php echo site_url();?>/indexsajt'" src = "<?php echo base_url();?>/slike/logout.png"/>
				<img id="slikalink" onclick = "window.location.href='<?php echo site_url();?>/indexkorisnik/index/<?php echo $id;?>'" src = "<?php echo base_url();?>img/home.png"/>
			</div>
			<div id = "goredesno">
				<img src = "<?php echo base_url();?>/slike/logo kviza.png"/>
			</div>
		</div>
		<div id = "meni">
			<div id = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/predlaganjeurednik/index/<?php echo $id;?>"> Dodavanje novih pitanja </a>
			</div>
			<div id = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/dodavanje/index/<?php echo $id;?>"> Dodavanje predlozenih pitanja </a>
			</div>
			<div id = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/uredjivanje/index/<?php echo $id;?>"> Ure&#273;ivanje pitanja </a>
			</div>
			<div id = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/forumurednik/index/<?php echo $id;?>"> Forum </a>
			</div>
			<div id = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/nalog/index/<?php echo $id;?>"> Nalog </a>
			</div>
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
		
		<div id = "sredina">
			<div id = "podacinaslovurednik">
				Podaci o korisniku
			</div>
			<div id = "podaciurednik">
				<form action="<?php echo site_url();?>/nalog/izmeni/<?php echo $id;?>" method="post">
					<br>
					Korisnicko ime: <input id = "korisnickoime" type= "text" placeholder = "" value="<?php echo $korisnicko_ime;?>" name="username" readonly/>
					<br>
					Lozinka: <input id = "lozinka" type= "password" placeholder = "" value="<?php echo $lozinka;?>" name="lozinka" readonly/> 
					<button id = "prikazi" type = "button" onclick = "prikazi_lozinku()"/>Prikazi</button>
					<br>
					Ime i prezime<input id = "imeprezime" type= "text" placeholder = "" value="<?php echo $ime_prezime;?>" name="ime_prezime" readonly/>
					<br>
					e-mail<input id = "email" type= "text" placeholder = "" value="<?php echo $email;?>" name="email" readonly/>
					<br>
					<div id = "pol">
					Pol: 
					<input id = "muski" type= "radio" name = "pol" value="Muski" <?php if ($pol=="Muski") echo 'checked'; ?>/> Muski
					<input id = "zenski" type= "radio" name = "pol" value="Zenski" <?php if ($pol=="Zenski") echo 'checked'; ?>/> Zenski
					<br>
					</div>
					Godiste:
					<select id = "godine" name="godiste">
					</select>
					<br><br>
					<button id = "izmeni" type = "button" onclick = "izmeni_dugmad()" style = "display: inline">Izmeni podatke</button>
					<button id = "sacuvaj" type = "submit" onclick = "izmeni_dugmad()" style = "display: none">Sacuvaj izmene </button>
					<br>
					<button id = "otkazi" type = "button" onclick = "window.location.href='<?php echo site_url();?>/nalog/index/<?php echo $id;?>'" style = "display: none">Otkazi izmene</button>
				</form>
			</div>
			<!--<div id = "statistika">
				<form>
					Odigrano partija: <input id = "odigranopartija" type= "text" value = "0" readonly/>
					<br>
					Ukupno poena: <input id = "ukupnopoena" type= "text" value = "0" readonly/>
					<br>
					Prosecan broj poena: <input id = "prosecanbrojpoena" type= "text" value = "0" readonly/>
				</form>
			</div>-->
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