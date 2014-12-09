<?php
	session_start();
	//session_unset($_SESSION['person']);

	if(empty($_SESSION['cardALT']) && empty($_SESSION['cardURL']) && empty($_SESSION['cardID']))
	{
		header("location: index.php");
	}
	else
	{
		if(empty($_SESSION['persMess']))
		{
			header("location: stap2.php");
		}
	}
	
	if (isset($_POST['fileToUpload']) && !empty($_POST['fileToUpload'])) 
	{
		if(isset($_FILES['emails']) && !empty($_FILES['emails'])) 
		{
			//if file has something in it
			if(strlen($_FILES['emails']['name']) > 0)
			{
				$fileType = $_FILES["emails"]['type'];

				if('text/csv' == $fileType ||  'application/vnd.ms-excel' == $fileType)
				{
					$csv = array_map('str_getcsv', file($_FILES["emails"]["tmp_name"]));

					$amountRows =  count(array_slice($csv, 1));

					if($amountRows <= 20)
					{
						foreach(array_slice($csv, 1) as $person)
						{						
							$firstname = $person[0];
							$lastname = $person[1];
							$email = $person[2];

							$_SESSION['person'][] = array(
													    "voornaam" => $firstname,
													    "achternaam" => $lastname,
													    "emailadres" => $email
													);
						}
					}
					else
					{
						$error = "<p class='error'>Het bulk importeren van emails is beperkt tot <span style='font-weight:bold;'>20</span></p>";
					}
				}
				else
				{
					$error = "<p class='error'>Verkeerde type file</p>";
				}
			}
			else
			{
				//fallback when no file has been uploaded but clicked "upload"
			}
		}
	}
	else
	{
		//fallback
		//empty file or file not done uploading
	}

	/*if(isset($_SESSION['person']))
	{
		var_dump($_SESSION['person']);
	}*/

 ?><!doctype html>
<html lang="en">
	<head>
		<?php include("includes/head.inc.php") ?>
	</head>

	<body class="stap3">

		<div id="preCon">
			<div id="container">

				<?php include("includes/header.inc.php") ?>

				<div id="content">

					 <a id="downloadcsv" href="kerstkaart_emails.csv" target="_blank">Template downloaden</a>

					<div id="stap3-buttons">
						<ul id="emailtoevoegen">
							<li class="addEmail firstItem"><a id="indEmail" class="button-email" href="#">E-mailadres toevoegen</a></li>
							<li class="addEmail"><a id="bulkEmail" class="button-email" href="#">CSV bestand importeren</a></li>
						</ul>
					

					
						<ul id="emailaanpassen">
							<li class="firstItem" id="editList"><a id="editEmail" class="button-email" href="#">Wijzig</a></li>
							<li id="deleteList"><a id="deleteEmail" class="button-email" href="#">Verwijder</a></li>
						</ul>
					</div>

					<?php 
					if(!empty($error))
					{
						echo $error;
					}
					 ?>

					<table id="stap3-table">
						<tbody>
							<tr id="legend">
								<th class="checkItem"><input id="selectAll" type="checkbox" value="check-all"></th>
								<th class="stap3-th col1">Voornaam</th>
								<th class="stap3-th col2">Achternaam</th> 
								<th class="stap3-th col3">E-mailadres</th>
							</tr>

						<?php 
							if(isset($_SESSION['person']))
							{
								$reverted = new ArrayIterator(array_reverse($_SESSION['person']));

								foreach($reverted as $person)
								{
									$firstname = $person['voornaam'];
									$lastname = $person['achternaam'];
									$email = $person['emailadres'];

									echo "<tr class='emailAdded'>" .
										  	"<td class='checkItem'><input type='checkbox' value='check'></td>" .
										    "<td class='firstname'>" . $firstname . "</td>" .
										    "<td class='lastname'>" . $lastname . "</td>" .
										    "<td class='email'>" . $email . "</td>" .
										  "</tr>";
								}
							}
							else
							{
								echo "<tr id='emptyList'>" .
								  		"<td class='checkItem'></td>" .
								  		"<td>Nog geen ontvangers</td>" .
								  		"<td></td>" .
								  		"<td></td>" .
								  	"</tr>";
							}

						 ?>
						</tbody>
					</table>



					<ul id="vorige-volgende" class="clearfix">
						<li id="left"><a id="gbStap2" class="button-vorigevolgende" href="stap2.php">Vorige stap</a></li>
						<li id="right"><a id="gtStap4" class="button-vorigevolgende" href="stap4.php">Volgende stap</a></li>
					</ul>
				</div>

			</div>
			<?php include("includes/footer.inc.php"); ?>
		</div>
		<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>