<!-- Autor: Jovan Nikolic -->

<html>
	<head>
		<title> &#381;elite li da postanete multiplekser </title>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/gore.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/meni.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/dole.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/igra.css"/>
		<script type = 'text/javascript' src = "<?php echo base_url();?>js/igrademo.js"></script>
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
				<img onclick = "window.location.href='<?php echo site_url();?>/indexsajt'" src = "<?php echo base_url();?>img/logout.png"/>
			</div>
			<div id = "goredesno">
				<img src = "<?php echo base_url();?>img/logo kviza.png"/>
			</div>
		</div>
		<div id = "meni">
			<div class = "stavkamenija">
				
			</div>
			<div class = "stavkamenija" style = "text-align: right;">
				Demo &nbsp
			</div>
			<div class = "stavkamenija" style = "text-align: left;">
				&nbsp kviz
			</div>
			<div class = "stavkamenija">
				
			</div>
		</div>
		<div id = "sredina">
			<form>
				<br>
				<div id = "pitanjeiodgovori">
					<div id = 'pitanje'>
						<?php
							echo $pitanje->getTekst();
						?>
					</div>
					<br>
					<div id = "ponudjeniodgovori">
						<input type = "radio" name = "ponudjeniodgovori" value = "1" id = "ponudjeniodgovor1">
							<?php
								echo $pitanje->getOdgovor_1()."<br><br>";
							?>
						</input>
						<input type = "radio" name = "ponudjeniodgovori" value = "2" id = "ponudjeniodgovor2">
							<?php
								echo $pitanje->getOdgovor_2()."<br><br>";
							?>
						</input>
						<input type = "radio" name = "ponudjeniodgovori" value = "3" id = "ponudjeniodgovor3">
							<?php
								echo $pitanje->getOdgovor_3()."<br><br>";
							?>
						</input>
						<input type = "radio" name = "ponudjeniodgovori" value = "4" id = "ponudjeniodgovor4">
							<?php
								echo $pitanje->getOdgovor_4();
							?>
						</input>
					</div>
				</div>
				<br>
				<div id = "poruka">
				
				</div>
				<div id = "opcije">
					<button id = "sledece" type = "button" onclick = "sledecePitanje(<?php echo $rezultat->getid(); ?>)">
						Sledece pitanje
					</button>
					<br><br>
					<button id = "prekini" type = "button" onclick = "prekiniPokusaj(<?php echo $korisnik->getid(); ?>)">
						Prekini pokusaj
					</button>
					<button id = "ponovo" type = "button" onclick = "window.location.href='<?php echo site_url();?>/indexSajt'" style = "display: none">
						Pocetna stranica
					</button>
					<br><br>
				</div>
				<br>
			</form>
		</div>
		<div id = "dole">
			<div id = "dolelevo">
				<img src = "<?php echo base_url();?>img/logo tima.png"/>
			</div>
			<div id = "doledesno">
			Mravojedi sa Madagaskara
			</div>
		</div>
	</body>
</html>