<?php 
	session_start();
	//session_destroy();
    include('includes/variables.inc.php');
	
	include_once('class/card.class.php');
	$card = new Card();
	$cardsanimated = $card->GetCardsAnimated();
    $cardsstatic = $card->GetCardsStatic();

    if (preg_match('/MSIE\s(?P<v>\d+)/i', @$_SERVER['HTTP_USER_AGENT'], $B) && $B['v'] <= 11) {
    header('Location: http://ecard.thomasmore.be/404.php');
} else {
    // All other browsers
}

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
						<h1 id="titleCard"><?php if(isset($_SESSION['cardALT'])){ echo $_SESSION['cardALT']; } else {echo "360° kerst";}?></h1>
						<div class="stap1-choosen">

							<?php  
								if(isset($_SESSION['cardURL']) && isset($_SESSION['cardType']))
								{
									if($_SESSION['cardType'] == "animated")
									{
										if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)){

											echo "<div class='videoWrapper'><iframe src='" . $cards[0]['card_youtube'] . "?rel=0&amp;controls=0&amp;showinfo=0&amp;loop=1&amp;autoplay=1' frameborder='0' allowfullscreen></iframe>
											</div><img class='staticBorder' style='visibility: hidden;width: 0;height: 0;' src='img/full_" . $_SESSION['cardURL'] . ".png' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'></img>";
										}else{
											echo "<video width='100%' controls='true' loop autoplay poster='img/".$_SESSION['cardURL'].".png' src='img/".$_SESSION['cardURL'].".mp4' data-id='".$_SESSION['cardID']."' alt='" . $_SESSION['cardALT'] . "' data-type='" . $_SESSION['cardType'] . "' title='" . $_SESSION['cardALT'] . "'>
												<source src='img/full_" . $_SESSION['cardURL'] . ".mp4' type='video/mp4'>
												<source src='img/full_" . $_SESSION['cardURL'] . "a.mp4' type='video/mp4'>
												<source src='img/full_" . $_SESSION['cardURL'] . ".webm' type='video/webm'>
												<source src='img/full_" . $_SESSION['cardURL'] . ".ogv' type='video/ogg'>
												<source src='img/full_" . $_SESSION['cardURL'] . ".m4v' type='video/x-m4v'>
												<img class='staticBorder' src='img/full_" . $_SESSION['cardURL'] . ".png'></img>
												</video>";
										}
									}
									else
									{
										echo "<img class='staticBorder' title='" . $_SESSION['cardALT'] . "' alt='" . $_SESSION['cardALT'] . "' data-id=" . $_SESSION['cardID'] . " data-type=" . $_SESSION['cardType'] . " src='img/" . $_SESSION['cardURL'] . ".png'/>";
									}
								}
								else
								{
									if(preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)){
										echo "<div class='videoWrapper'><iframe src='" . $cards[0]['card_youtube'] . "?rel=0&amp;controls=0&amp;showinfo=0&amp;loop=1&amp;autoplay=1' frameborder='0' allowfullscreen></iframe>
											</div><img style='visibility: hidden;width: 0;height: 0;' src='img/full_kaart_1.png' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated' /img>";
									}else {
										echo "<video width='100%' loop controls poster='img/full_" . $cards[0]['card_url'] . ".png' src='img/full_kaart_1.mp4' data-id='1' alt='Geanimeerde kerstkaart' data-type='animated'>
													<source src='img/full_" . $cards[0]['card_url'] . ".mp4' type='video/mp4'>
													<source src='img/full_" . $cards[0]['card_url'] . "a.mp4' type='video/mp4'>
													<source src='img/full_" . $cards[0]['card_url'] . ".webm' type='video/webm'>
													<source src='img/full_" . $cards[0]['card_url'] . ".ogv' type='video/ogg'>
													<source src='img/full_" . $cards[0]['card_url'] . ".m4v' type='video/x-m4v'>
													<img class='staticBorder' src='img/full_" . $cards[0]['card_url'] . ".png' alt='" . $cards[0]['card_title'] . "' /img>
											  </video>";
									}
								}
							?>

						</div>
					</div>

					<div id="stap1-col2">
						<h1><b><?php if( isset($step1['choose']) ){ echo $step1['choose']; }else{echo "Kies een e-card";} ?>.</b></h1>

						<ul id="otherCards">
                            <h2><?php if( isset($_SESSION['taal']) ){ echo $step1['animated']; }else{echo "Geanimeerde versie";} ?>:</h2>

							<?php 
								foreach($cardsanimated as $card)
								{
									echo '<li class="card"><img title="' . $card['card_title'] . '" alt="' . $card['card_title'] . '" data-id="' . $card['card_id'] . '" data-url="' . $card['card_url'] . '" data-type="' . $card['card_type'] . '" src="img/thumbnail_' . $card['card_url'] . '.png"></li>';
								}
							 ?>

						</ul>

                        <ul id="otherCards">

                            <h2><?php if(isset($_SESSION['taal'])){ echo $step1['static'];; }else{echo "Statische versie";} ?>:</h2>

                            <?php
                            foreach($cardsstatic as $card)
                            {
                                echo '<li class="card"><img class="staticBorder" title="' . $card['card_title'] . '" alt="' . $card['card_title'] . '" data-id="' . $card['card_id'] . '" data-url="' . $card['card_url'] . '" data-type="' . $card['card_type'] . '" src="img/thumbnail_' . $card['card_url'] . '.png"></li>';
                            }
                            ?>

                        </ul>



					</div>



					<ul id="vorige-volgende" class="clearfix" style="float:right;">
						<li id="right"><a id="gtStap2" class="button-vorigevolgende" href="stap2.php"><?php if(isset($_SESSION['taal'])){ echo $nextstep; }else{echo "Volgende stap";} ?></a></li>
					</ul>
				</div>

			</div>
            <?php include("includes/footer.inc.php"); ?>
		</div>
	
		<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>
