<header>
	<div id="logo">
		<a href="http://www.thomasmore.be/" id="login-logo">Thomas More Hogeschool</a>
	</div>

	<nav>
		<ul>
			<li id="liStap1"><h1 style='color:<?php if(!empty($_SESSION['cardALT']) && !empty($_SESSION['cardURL']) && !empty($_SESSION['cardID'])){ echo "#656565";} ?>'><span class="cijfer" style='border-color:<?php if(!empty($_SESSION['cardALT']) && !empty($_SESSION['cardURL']) && !empty($_SESSION['cardID'])){ echo "#656565";} ?>'> <?php if(!empty($_SESSION['cardALT']) && !empty($_SESSION['cardURL']) && !empty($_SESSION['cardID'])){ echo "&#10004;";}else{ echo "1";} ?> </span> Kies een kaart</h1></li>
			<li id="liStap2"><h1 style='color:<?php if(!empty($_SESSION['persMess']) && !empty($_SESSION['senderFirstname']) && !empty($_SESSION['senderLastname']) && !empty($_SESSION['senderEmail'])){ echo "#656565";} ?>'><span class="cijfer" style='border-color:<?php if(!empty($_SESSION['persMess']) && !empty($_SESSION['senderFirstname']) && !empty($_SESSION['senderLastname']) && !empty($_SESSION['senderEmail'])){ echo "#656565";} ?>'> <?php if(!empty($_SESSION['persMess']) && !empty($_SESSION['senderFirstname']) && !empty($_SESSION['senderLastname']) && !empty($_SESSION['senderEmail'])){ echo "&#10004;";}else{ echo "2";} ?> </span> Voeg tekst toe</h1></li>
			<li id="liStap3"><h1 style='color:<?php if(!empty($_SESSION['person'])){ echo "#656565";} ?>'><span class="cijfer" style='border-color:<?php if(!empty($_SESSION['person'])){ echo "#656565";} ?>'> <?php if(!empty($_SESSION['person'])){ echo "&#10004;";}else{ echo "3";} ?> </span> Ontvangers</h1></li>
			<li id="liStap4"><h1 ><span class="cijfer">4</span> Preview</h1></li>
		</ul>
	</nav>
</header>