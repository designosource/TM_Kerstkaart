<header>
	<a id="afmelden" href="logout.php"><?php if(isset($_SESSION['taal'])){ echo $logout; }else{echo "Afmelden";} ?></a>
	<div id="logo">
		<a target="_blank" href="http://www.thomasmore.be/" id="login-logo">Thomas More Hogeschool</a>
	</div>

	<nav>
		<ul>
			<li id="liStap1">
                <!-- huidige pagina mag niet index.php zijn-->
                <!-- moet een kaart geselecteerd zijn -->
                <?php if(basename($_SERVER['PHP_SELF']) != "index.php" && (!empty($_SESSION['cardALT']) && !empty($_SESSION['cardURL']) && !empty($_SESSION['cardID']))){ echo "<a href='index.php'>"; } ?>
			    <h1 style='color:<?php if(!empty($_SESSION['cardALT']) && !empty($_SESSION['cardURL']) && !empty($_SESSION['cardID'])){ echo "#656565";} ?>'><span class="cijfer" style='border-color:<?php if(!empty($_SESSION['cardALT']) && !empty($_SESSION['cardURL']) && !empty($_SESSION['cardID'])){ echo "#656565";} ?>'> <?php if(!empty($_SESSION['cardALT']) && !empty($_SESSION['cardURL']) && !empty($_SESSION['cardID'])){ echo "&#10004;";}else{ echo "1";} ?> </span><?php if(isset($_SESSION['taal'])){ echo $nav1; }else{echo "Kies een kaart";} ?></h1>
                <?php if(basename($_SERVER['PHP_SELF']) != "index.php" && (!empty($_SESSION['cardALT']) && !empty($_SESSION['cardURL']) && !empty($_SESSION['cardID']))){ echo "</a>"; } ?>
            </li>

			<li id="liStap2">
                <!-- huidige pagina mag niet stap2.php zijn-->
                <!-- moet een tekst hebben die niet leeg is -->
                <?php if(basename($_SERVER['PHP_SELF']) != "stap2.php" && !empty($_SESSION['persMess'])){ echo "<a href='stap2.php'>"; } ?>
			    <h1 style='color:<?php if(!empty($_SESSION['persMess'])){ echo "#656565";} ?>'>
			        <span class="cijfer" style='border-color:<?php if(!empty($_SESSION['persMess'])){ echo "#656565";} ?>'> <?php if(!empty($_SESSION['persMess'])){ echo "&#10004;";}else{ echo "2";} ?> </span><?php if(isset($_SESSION['taal'])){ echo $nav2; }else{echo "Voeg tekst toe";} ?></h1>
                <?php if(basename($_SERVER['PHP_SELF']) != "stap2.php" && !empty($_SESSION['persMess'])){ echo "</a>"; } ?>
            </li>
			<li id="liStap3">
                <?php if(basename($_SERVER['PHP_SELF']) != "stap3.php" && !empty($_SESSION['person'])){ echo "<a href='stap3.php'>"; } ?>
			    <h1 style='color:<?php if(!empty($_SESSION['person'])){ echo "#656565";} ?>'>
			    <span class="cijfer" style='border-color:<?php if(!empty($_SESSION['person'])){ echo "#656565";} ?>'> <?php if(!empty($_SESSION['person'])){ echo "&#10004;";}else{ echo "3";} ?> </span><?php if(isset($_SESSION['taal'])){ echo $nav3; }else{echo "Ontvangers";} ?></h1>
                <?php if(basename($_SERVER['PHP_SELF']) != "stap3.php" && !empty($_SESSION['person'])){ echo "</a>"; } ?>
            </li>
			<li id="liStap4">
                <h1><span class="cijfer">4</span><?php if(isset($_SESSION['taal'])){ echo $nav4; }else{echo "Preview";} ?></h1>
			</li>
		</ul>
	</nav>
</header>
