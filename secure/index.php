<?php 
	session_start();
	
	include_once('class/card.class.php');
	$card = new Card();
	$cards = $card->GetCards();

	//var_dump($cards);
	//unset($_SESSION);
	//var_dump($_SESSION);
 ?><!doctype html>
<html lang="en">
	<head>
		<?php include("includes/head.inc.php") ?>
	</head>

	<body class="stap1">
		<div id="preCon">
			<div id="container">

				<?php include("includes/header.inc.php") ?>

				<div id="content">
					<div id="stap1-col1">
						<h1 id="titleCard"><?php if(isset($_SESSION['cardALT'])){ echo $_SESSION['cardALT']; } else {echo "Meertalige geanimeerde kerstkaart (NL - FR - ENG)";}?></h1>
						<div class="stap1-choosen">

							<?php  
								if(isset($_SESSION['cardURL']) && isset($_SESSION['cardType']))
								{
									if($_SESSION['cardType'] == "animated")
									{
										if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)){

											echo "<div class='videoWrapper'><iframe src='https://www.youtube.com/embed/BADISQ1tZX8?rel=0&amp;controls=0&amp;showinfo=0&amp;loop=1&amp;autoplay=1&amp;playlist=BADISQ1tZX8' frameborder='0' allowfullscreen></iframe>
											</div><img style='visibility: hidden;width: 0;height: 0;' src='img/full_kaart_1.png' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'></img>";
										}else{
											echo "<video width='100%' controls='true' loop autoplay poster='img/".$_SESSION['cardURL'].".png' src='img/".$_SESSION['cardURL'].".mp4' data-id='".$_SESSION['cardID']."' alt='".$_SESSION['cardALT']."' data-type='".$_SESSION['cardType']."' title='".$_SESSION['cardALT']."'>
												<source src='img/full_".$_SESSION['cardURL'].".mp4' type='video/mp4'>
												<source src='img/full_".$_SESSION['cardURL']."a.mp4' type='video/mp4'>
												<source src='img/full_".$_SESSION['cardURL'].".webm' type='video/webm'>
												<source src='img/full_".$_SESSION['cardURL'].".ogv' type='video/ogg'>
												<source src='img/full_".$_SESSION['cardURL'].".m4v' type='video/x-m4v'>
												<img src='img/full_".$_SESSION['cardURL'].".png'></img>
												</video>";
										}
									}
									else
									{
										echo "<img title='".$_SESSION['cardALT']."' alt='".$_SESSION['cardALT']."' data-id=".$_SESSION['cardID']." data-type=".$_SESSION['cardType']." src='img/".$_SESSION['cardURL'].".png'/>";
									}
								}
								else
								{
									if(preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)){
										echo "<div class='videoWrapper'><iframe src='https://www.youtube.com/embed/BADISQ1tZX8?rel=0&amp;controls=0&amp;showinfo=0&amp;loop=1&amp;autoplay=1&amp;playlist=BADISQ1tZX8' frameborder='0' allowfullscreen></iframe>
											</div><img style='visibility: hidden;width: 0;height: 0;' src='img/full_kaart_1.png' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'></img>";
									}else {
										echo "<video width='100%' loop controls autoplay poster='img/full_kaart_1.png' src='img/full_kaart_1.mp4' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'>
													<source src='img/full_kaart_1.mp4' type='video/mp4'>
													<source src='img/full_kaart_1a.mp4' type='video/mp4'>
													<source src='img/full_kaart_1.webm' type='video/webm'>
													<source src='img/full_kaart_1.ogv' type='video/ogg'>
													<source src='img/full_kaart_1.m4v' type='video/x-m4v'>
													<img src='img/full_kaart_1.png'></img>
													</video>";
									}
								}
							?>

						</div>
					</div>

					<div id="stap1-col2">
						<h1><b>Kies een ontwerp.</b></h1>
						
						<ul id="otherCards">
							<?php 
								foreach($cards as $card)
								{
									echo '<li class="card"><img title="'.$card['card_title'].'" alt="'.$card['card_title'].'" data-id="'.$card['card_id'].'" data-url="'.$card['card_url'].'" data-type="'.$card['card_type'].'" src="img/thumbnail_'.$card['card_url'].'.png"></li>';
								}
							 ?>
						</ul>
					</div>



					<ul id="vorige-volgende" class="clearfix">
						<li id="right"><a id="gtStap2" class="button-vorigevolgende" href="stap2.php">Volgende stap</a></li>
					</ul>
				</div>

			</div>

			<?php include("includes/footer.inc.php"); ?>
			
		</div>
	
		<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>
