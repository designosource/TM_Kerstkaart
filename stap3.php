<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="css/normalize.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<title>Thomas More | Kerstkaart</title>
</head>
<body id="stap3">

	<div id="container">

		<header>
			<a id="afmelden" href="index.html">Afmelden</a>
			<div id="logo">
				<img src="img/TM_logo.png" alt="Logo Thomas More Hogeschool"/>
			</div>
		</header>

		<nav>
				<ul>
					<li class="visited"><span class="cijfer">1</span><a href="stap1.html">Kies een kaart</a></li>
					<li class="visited"><span class="cijfer">2</span><a href="stap2.html">Voeg tekst toe</a></li>
					<li class="active"><span class="cijfer">3</span><a href="stap3.html">Ontvangers</a></li>
					<li><span class="cijfer">4</span> Preview</li>
					<li><span class="cijfer">5</span> Verzenden</li>
				</ul>
			</nav>

		<div id="content">
			<h1>Ontvangers toevoegen</h1>
				
			<div id="stap3-buttons">
				<ul id="emailtoevoegen">
					<li><a class="button-email" href="#">Een e-mailadres toevoegen</a></li>
					<li><a class="button-email" href="#">Excel lijst uploaden</a></li>
				</ul>
			

			
				<ul id="emailaanpassen">
					<li><a class="button-email" href="#">Wijzigen</a></li>
					<li><a class="button-email" href="#">Verwijderen</a></li>
				</ul>
			</div>


			<table id="stap3-table">
			  <tr>
			  	<th><input type="checkbox" value="check-all"></th>
			    <th class="stap3-th col1">Voornaam</th>
			    <th class="stap3-th col2">Achternaam</th> 
			    <th class="stap3-th col3">E-mailadres</th>
			  </tr>
			  <tr>
			  	<td><input type="checkbox" value="check-1"></td>
			    <td>John</td>
			    <td>Doe</td> 
			    <td>john.doe@desingosource.be</td>
			  </tr>
			  <tr>
			  	<td><input type="checkbox" value="check-2"></td>
			    <td>Eve</td>
			    <td>Jackson</td> 
			    <td>eve.jackson@desingosource.be</td>
			  </tr>
			  <tr>
			  	<td><input type="checkbox" value="check-3"></td>
			    <td>Jessica</td>
			    <td>Doe</td> 
			    <td>jessica.doe@desingosource.be</td>
			  </tr>
			</table>



			<ul id="vorige-volgende" class="clearfix">
				<li><a class="button-vorigevolgende" href="stap2.html">&#60; Vorige stap</a></li>
				<li><a class="button-vorigevolgende" href="stap4.html">Volgende stap &#62;</a></li>
			</ul>
		</div>

		<footer>
			<p id="login-copyright">&copy; Thomas More | <a href="#">Gebruiksvoorwaarden &amp; Privacy</a></p>
		</footer>

	</div>
	
</body>
</html>