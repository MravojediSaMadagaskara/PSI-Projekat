<!-- Autor: Jovan Nikolic -->

<html>
	<head>
		<title> &#381;elite li da postanete multiplekser </title>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/gore.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/meni.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/dole.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/indexkorisnik.css"/>
		<script type = 'text/javascript' src = "<?php echo base_url();?>js/indexkorisnik.js"></script>
	</head>
	<body>
		<div id = "gore">
			<div id = "gorelevo">
				&#381;elite li da postanete
				<br>
				&nbsp MULTIPLEKSER
			</div>
			<div id = "goresredina">
				<?php
					echo $korisnik->getIme_i_prezime();
				?>
				<img id="slikalink" onclick = "window.location.href='<?php echo site_url();?>/indexsajt'" src = "<?php echo base_url();?>img/logout.png"/>
				<img id="slikalink" onclick = "window.location.href='<?php echo site_url();?>/indexkorisnik/index/<?php echo $korisnik->getid();?>'" src = "<?php echo base_url();?>img/home.png"/>
			</div>
			<div id = "goredesno">
				<img src = "<?php echo base_url();?>img/logo kviza.png"/>
			</div>
		</div>
		<div id = "meni">
			<div class = "stavkamenijaadmin">
				<a href = "<?php echo site_url();?>/adminurednici/index/<?php echo $korisnik->getid();?>"> Uredjivanje urednika </a>
			</div>
			<div class = "stavkamenijaadmin">
				<a href = "<?php echo site_url();?>/adminkorisnici/index/<?php echo $korisnik->getid();?>"> Uredjivanje korisnika </a>
			</div>
			<div class = "stavkamenijaadmin">
				<a href = "<?php echo site_url();?>/nalog/index/<?php echo $korisnik->getid();?>"> Nalog </a>
			</div>
		</div>
		<div id = "sredina">
			<br><br>
			Dobrodosli
			<br>
			na stranicu za administraciju sajta
			<br><br>
		</div>
		<div id = "dole">
			<div id = "dolelevo">
				<img src = "<?php echo base_url();?>/img/logo tima.png"/>
			</div>
			<div id = "doledesno">
			Mravojedi sa Madagaskara
			</div>
		</div>
	</body>
</html>