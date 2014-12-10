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
						<h1 id="titleCard"><?php if(isset($_SESSION['cardALT'])){ echo $_SESSION['cardALT']; } else {echo "Geanimeerde kerstkaart";}?></h1>
						<div class="stap1-choosen">

							<?php  
								if(isset($_SESSION['cardURL']) && isset($_SESSION['cardType']))
								{
									if($_SESSION['cardType'] == "animated")
									{
										echo "<video width='100%' loop autoplay poster='img/".$_SESSION['cardURL'].".png' src='img/".$_SESSION['cardURL'].".mp4' data-id='".$_SESSION['cardID']."' alt='".$_SESSION['cardALT']."' data-type='".$_SESSION['cardType']."'>
												<source src='img/".$_SESSION['cardURL'].".mp4' type='video/mp4'>
												<source src='img/".$_SESSION['cardURL'].".webm' type='video/webm'>
												<source src='img/".$_SESSION['cardURL'].".ogv' type='video/ogg'>
												<img src='img/".$_SESSION['cardURL']."'>
											</video>";
									}
									else
									{
										echo "<img alt='".$_SESSION['cardALT']."' data-id=".$_SESSION['cardID']." data-type=".$_SESSION['cardType']." src='img/".$_SESSION['cardURL'].".png'/>";
									}
								}
								else
								{
									echo "<video width='100%' loop autoplay poster='img/full_kaart_1.png' src='img/full_kaart_1.mp4' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'>
											<source src='img/full_kaart_1.mp4' type='video/mp4'>
											<source src='img/full_kaart_1.webm' type='video/webm'>
											<source src='img/full_kaart_1.ogv' type='video/ogg'>
											<img src='img/full_kaart_1.png'>
										</video>";
								}
							?>

						</div>
					</div>

					<div id="stap1-col2">
						<h1>Andere ontwerpen</h1>
						
						<ul id="otherCards">
							<?php 
								foreach($cards as $card)
								{
									echo '<li class="card"><img alt="'.$card['card_title'].'" data-id="'.$card['card_id'].'" data-url="'.$card['card_url'].'" data-type="'.$card['card_type'].'" src="img/thumbnail_'.$card['card_url'].'.png"></li>';
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