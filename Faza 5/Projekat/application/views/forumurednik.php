<!-- Autor: Jovan Nikolic -->

<html>
	<head>
		<title> &#381;elite li da postanete multiplekser </title>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/gore.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/meni.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/dole.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/forum.css"/>
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/forumurednik.css"/>
		<script type = 'text/javascript' src = "<?php echo base_url();?>js/forumurednik.js"></script>
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
				<img id="slikalink" onclick = "window.location.href='<?php echo site_url();?>/indexkorisnik/index/<?php echo $korisnik->getid();?>'" src = "<?php echo base_url();?>img/home.png"/>
			</div>
			<div id = "goredesno">
				<img src = "<?php echo base_url();?>img/logo kviza.png"/>
			</div>
		</div>
		<div id = "meni">
			<div class = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/predlaganjeurednik/index/<?php echo $korisnik->getid();?>"> Dodavanje novih pitanja </a>
			</div>
			<div class = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/dodavanje/index/<?php echo $korisnik->getid();?>"> Dodavanje predlozenih pitanja </a>
			</div>
			<div class = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/uredjivanje/index/<?php echo $korisnik->getid();?>"> Ure&#273;ivanje pitanja </a>
			</div>
			<div class = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/forumurednik/index/<?php echo $korisnik->getid();?>"> Forum </a>
			</div>
			<div class = "stavkamenijaurednik">
				<a href = "<?php echo site_url();?>/nalog/index/<?php echo $korisnik->getid();?>"> Nalog </a>
			</div>
		</div>
		<div id = "sredina">
			<form>
				<div id = "postovi">
					<?php
						foreach ($postovi as $post) {
							echo "
							<br>
							<div class = 'post' id = 'post".$post->getid()."'>
								<div class = 'posttekst'>".
									$post->getTekst()."
								</div>
								<!--<div class = 'postdetalji'>-->
									<div class = 'korisnik'>
										Autor:<i>".$post->getKorisnik()->getKorisnicko_ime()."</i>
									</div>
									<div class = 'datumivreme'>
										";		
										$date = $post->getDatum_i_vreme();
										echo "
										Datum i vreme:<i>".$date->format('Y-m-d H:i:s')."</i>
									</div>
									<textarea class = 'upozoripolje' id = 'postupozoripolje".$post->getid()."' placeholder = 'Unesite poruku ovde'></textarea>
									<br>
									<button type = 'button' class = 'postupozoridugme' id = 'postupozoridugme".$post->getid()."' onclick = 'upozoriPost(".$post->getid().")'>Upozori</button>
								<!--</div>-->	
								<div class = 'postkomentari' id = 'postkomentari".$post->getid()."'>
									<br><br>
									";
									/*foreach ($komentari as $komentar) {
										if($komentar->getPost()->getid() == $post->getid()) {
											echo "
											<hr color = '#FF9400'>
											Komentari
											<hr color = '#FF9400'>
											<br>
											";
											break;
										}
									}*/
									/*foreach ($komentari as $komentar) {
										if($komentar->getPost()->getid() == $post->getid()){
											echo "
											<div class = 'postkomentar' id = 'postkomentar".$komentar->getid()."'>
												<div class = 'postkomentartekst'>".
													$komentar->getTekst()."
												</div>
												<div class = 'postkomentarkorisnik'>".
													$komentar->getKorisnik()->getKorisnicko_ime()."
												</div>
												<div class = 'postkomentardatumivreme'>
													";
													$date = $komentar->getDatum_i_vreme();
													echo $date->format('Y-m-d H:i:s')."
												</div>
												<textarea class = 'upozoripolje' id = 'komentarupozoripolje".$komentar->getid()."' placeholder = 'Unesite poruku ovde'></textarea>
												<br>
												<button type = 'button' style = 'width: 35%' class = 'komentarupozoridugme' id = 'komentarupozoridugme".$komentar->getid()."' onclick = 'upozoriKomentar(".$komentar->getid().")'>Upozori</button>	
											</div>
											<hr color = '#FF9400'>
											<br>
											";
										}
									}*/
									if($post->getKomentari()->count() > 0) {
										echo "
										<hr color = '#FF9400'>
										Komentari
										<hr color = '#FF9400'>
										<br>
										";
									}
									foreach($post->getKomentari() as $komentar) {
										echo "
										<div class = 'postkomentar' id = 'postkomentar".$komentar->getid()."'>
											<div class = 'postkomentartekst'>".
												$komentar->getTekst()."
											</div>
											<div class = 'korisnik'>
												<i>".$komentar->getKorisnik()->getKorisnicko_ime()."</i>
											</div>
											<div class = 'datumivreme'>
												";
												$date = $komentar->getDatum_i_vreme();
												echo "<i>".$date->format('Y-m-d H:i:s')."</i>
											</div>
											<textarea class = 'upozoripolje' id = 'komentarupozoripolje".$komentar->getid()."' placeholder = 'Unesite poruku ovde'></textarea>
											<br>
											<button type = 'button' class = 'komentarupozoridugme' id = 'komentarupozoridugme".$komentar->getid()."' onclick = 'upozoriKomentar(".$komentar->getid().")'>Upozori</button>	
											<hr color = '#FF9400'>
											<br>
										</div>
										";		
									}
								echo "
								</div>
								<textarea class = 'komentarpolje' id = 'komentarpolje".$post->getid()."' placeholder = 'Unesite komentar ovde'></textarea>
								<br><br>
								<button type = 'button' class = 'komentardugme' id = 'komentardugme".$post->getid()."' onclick = 'dodajKomentar(".$korisnik->getid().",".$post->getid().")'>Pisi komentar</button>
							</div>
							";	
						}
					?>
				</div>
				<br>
				<textarea id = 'postpolje' placeholder = 'Unesite post ovde'></textarea>
				<br><br>
				<button type = 'button' id = 'postdugme' onclick = 'dodajPost(<?php echo $korisnik->getid(); ?>)'>Pisi post</button>
				<br><br>
			</form>
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