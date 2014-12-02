<!doctype html>
<html lang="en">
	<head>
		<?php include("includes/head.inc.php") ?>
	</head>

	<body>

		<div id="login-container">
			<section id="login-header">
				<a href="http://www.thomasmore.be/" id="login-logo">Thomas More Hogeschool</a>
			</section>

			<section id="login-content">
				<form action="#" method="POST">
					<input class="login-input unummer" type="text" name="unummer" placeholder="U-nummer">
					<input class="login-input wachtwoord" type="password" name="wachtwoord" placeholder="Wachtwoord">

					<div id="checkCon">
						<input class="login-check" id="rememberMe" type="checkbox" name="onthouden" value="onthouden">
						<label for="rememberMe">Onthoud mij</label>
					</div>

					<input class="login-button" type="submit" value="Aanmelden">
				</form>
			</section>

			<section id="login-footer">
				<a href="#">Login probleem?</a>
			</section>

			<p id="login-copyright">&copy; Thomas More | <a href="#">Gebruiksvoorwaarden &amp; Privacy</a></p>
		</div>

		<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>