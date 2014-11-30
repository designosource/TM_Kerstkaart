<?php 
session_start();

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
						<h1 id="titleCard"> <?php if(isset($_SESSION['cardALT'])){ echo $_SESSION['cardALT']; } else {echo "Placeholder 1";}?></h1>
						<div class="stap1-choosen"><img alt=" <?php if(isset($_SESSION['cardALT'])){echo $_SESSION['cardALT']; }else{echo 'Placeholder 1';}?> " src=" <?php if(isset($_SESSION['cardURL'])){ echo $_SESSION['cardURL']; } else {echo "img/placeholderImg_1.png";}?> "></div>
					</div>

					<div id="stap1-col2">
						<h1>Andere ontwerpen</h1>
						
						<ul id="otherCards">
							<li class="card chose"><img alt='Placeholder 1' src="img/placeholderImg_1.png"></li>
							<li class="card"><img alt='Placeholder 2' src="img/placeholderImg_2.png"></li>
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