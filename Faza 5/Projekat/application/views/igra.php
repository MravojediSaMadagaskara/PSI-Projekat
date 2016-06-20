<!-- Autor: Jovan Nikolic -->

<html>
	<head>
		<title> &#381;elite li da postanete multiplekser </title>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/gore.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/meni.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/dole.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/igra.css"/>
		<script type = 'text/javascript' src = "<?php echo base_url();?>js/igra.js"></script>
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
			<div class = "stavkamenija">
				<a href = "<?php echo site_url();?>/igra/index/<?php echo $korisnik->getid();?>"> Kviz </a>
			</div>
			<div class = "stavkamenija">
				<a href = "<?php echo site_url();?>/forum/index/<?php echo $korisnik->getid();?>"> Forum </a>
			</div>
			<div class = "stavkamenija">
				<a href = "<?php echo site_url();?>/predlaganje/index/<?php echo $korisnik->getid();?>"> Predlaganje pitanja </a>
			</div>
			<div class = "stavkamenija">
				<a href = "<?php echo site_url();?>/nalog/index/<?php echo $korisnik->getid();?>"> Korisnicki nalog </a>
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
					<button id = "ponovo" type = "button" onclick = "window.location.href='<?php echo site_url();?>/igra/index/<?php echo $korisnik->getid();?>'" style = "display: none">
						Igraj ponovo
					</button>
					<br><br>
					<button id = "prijavi" type = "button" onclick = "<?php $this->load->library('doctrine'); $em = $this->doctrine->em; $pitanje->setStatus_prijavljeno('Da'); $em->persist($pitanje); $em->flush()?>; document.getElementById('obavestenje').style.display='block';">
						Prijavi pitanje
					</button>
				</div>
				<br>
				<div id = "obavestenje"> 
					Pitanje je prijavljeno!
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