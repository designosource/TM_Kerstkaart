<!doctype html>
<html lang="en">
	<head>
		<?php include("includes/head.inc.php") ?>
	</head>

	<body class="stap3">
		<div id="preCon">
			<div id="container">

				<?php include("includes/header.inc.php") ?>

				<div id="content">						
					<div id="stap3-buttons">
						<ul id="emailtoevoegen">
							<li class="addEmail firstItem"><a class="button-email" href="#">CSV bestand importeren</a></li>
							<li class="addEmail"><a class="button-email" href="#">E-mailadres toevoegen</a></li>
						</ul>
					

					
						<ul id="emailaanpassen">
							<li class="firstItem"><a class="button-email" href="#">Wijzig</a></li>
							<li><a class="button-email" href="#">Verwijder</a></li>
						</ul>
					</div>


					<table id="stap3-table">
					  <tr>
					  	<th class="checkItem"><input id="selectAll" type="checkbox" value="check-all"></th>
					    <th class="stap3-th col1">Voornaam</th>
					    <th class="stap3-th col2">Achternaam</th> 
					    <th class="stap3-th col3">E-mailadres</th>
					  </tr>
					  <tr>
					  	<td class="checkItem"><input type="checkbox" value="check-1"></td>
					    <td>John</td>
					    <td>Doe</td> 
					    <td>john.doe@desingosource.be</td>
					  </tr>
					  <tr>
					  	<td class="checkItem"><input type="checkbox" value="check-2"></td>
					    <td>Eve</td>
					    <td>Jackson</td> 
					    <td>eve.jackson@desingosource.be</td>
					  </tr>
					  <tr>
					  	<td class="checkItem"><input type="checkbox" value="check-3"></td>
					    <td>Jessica</td>
					    <td>Doe</td> 
					    <td>jessica.doe@desingosource.be</td>
					  </tr>
					</table>



					<ul id="vorige-volgende" class="clearfix">
						<li id="left"><a class="button-vorigevolgende" href="stap2.php">Vorige stap</a></li>
						<li id="right"><a class="button-vorigevolgende" href="stap4.php">Volgende stap</a></li>
					</ul>
				</div>

			</div>
			<?php include("includes/footer.inc.php"); ?>
		</div>
		<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>