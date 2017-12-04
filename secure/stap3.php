<?php
	session_start();
    include('includes/variables.inc.php');
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
				require('class/php-excel-reader/excel_reader2.php');
   				require('class/SpreadsheetReader.php');

				if('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' == $fileType ||  'application/vnd.ms-excel' == $fileType)
				{
					$fileName = $filename = pathinfo($_FILES['emails']['name'], PATHINFO_FILENAME);

					$info = pathinfo($_FILES['emails']['name']);
					$ext = $info['extension'];
					$fileFullName = $fileName.".".$ext; 

					$target = 'excelFiles/'.$fileFullName;

					if(move_uploaded_file( $_FILES['emails']['tmp_name'], $target))
					{
						$Reader = new SpreadsheetReader($target);

						$i=0;

					    foreach ($Reader as $row)
					    {
					    	if(!empty($row[0]) && !empty($row[2]) && !empty($row[2]))
					    	{
					    		$i++;
					    	}
					    }

					    //Het aantal Mails die een spreadsheet mag bevatten
					    if($i <= 500)
						{
							foreach ($Reader as $row)
						    {
						    	if(!empty($row[0]) && !empty($row[2]) && !empty($row[2]))
						    	{
						    		
							    	if($row[0] !== "Voornaam" && $row[1] !== "Achternaam" && $row[2] !== "Emailadres")
						    		{
						    			$firstname = $row[0];
										$lastname = $row[1];
										$email = $row[2];

										$_SESSION['person'][] = array(
																    "voornaam" => $firstname,
																    "achternaam" => $lastname,
																    "emailadres" => $email
																);
						    		}
						    	}
						    }
						}
						else
						{
							$error = "<p class='error'>". isset($step3["amountmails"])?$step3["amountmails"]:"Het bulk importeren van emails is beperkt tot" . " <span style='font-weight:bold;'>500.</span></p>";
						}

					    unlink('excelFiles/'.$fileFullName);
					}
					else
					{
						$error = "<p class='error'>". isset($step3["error"])?$step3["error"]:"Er is iets misgelopen, gelieve nog eens te proberen" . ".</p>";
					}
				}
				else
				{
					$error = "<p class='error'>". isset($step3["wrongtype"])?$step3["wrongtype"]:"Verkeerde type file. Alleen .xls en .xlsx zijn momenteel ondersteund" . ".</p>";
				}
			}
			else
			{
				//fallback when no file has been uploaded but clicked "upload"
				$error = "<p class='error'>". isset($step3["nofileselected"])?$step3["nofileselected"]:"Gelieve een bestand up te loaden" . ".</p>";
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

                    <p id="language" style="display: none;"><?php echo $_SESSION['taal']; ?></p> <!-- readable for JS -->


					<div id="stap3-buttons">
						<ul id="emailtoevoegen">
							<li class="addEmail firstItem"><a id="indEmail" class="button-email" href="#"><?php if(isset($step3["addemail"])){ echo $step3["addemail"]; }else{ echo "E-mailadres toevoegen"; } ?></a></li>
							<li class="addEmail"><a id="bulkEmail" class="button-email" href="#"><?php if(isset($step3["importexcel"])){ echo $step3["importexcel"]; }else{ echo "Excel-bestand importeren"; } ?></a></li>
						</ul>

						<ul id="emailaanpassen">
							<li class="firstItem" id="editList"><a id="editEmail" class="button-email" href="#"><?php if(isset($step3["modify"])){ echo $step3["modify"]; }else{ echo "Wijzig"; } ?></a></li>
							<li id="deleteList"><a id="deleteEmail" class="button-email" href="#"><?php if(isset($step3["delete"])){ echo $step3["delete"]; }else{ echo "Verwijder"; } ?></a></li>
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
								<th class="stap3-th col1"><?php if(isset($step3["firstname"])){ echo $step3["firstname"]; }else{ echo "Voornaam"; } ?></th>
								<th class="stap3-th col2"><?php if(isset($step3["lastname"])){ echo $step3["lastname"]; }else{ echo "Achternaam"; } ?></th>
								<th class="stap3-th col3"><?php if(isset($step3["email"])){ echo $step3["email"]; }else{ echo "E-mailadres"; } ?></th>
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
								  		"<td>" . (isset($step3['noreceivers'])?$step3['noreceivers']:'Nog geen ontvangers') ."</td>" .
								  		"<td></td>" .
								  		"<td></td>" .
								  	"</tr>";
							}

						 ?>
						</tbody>
					</table>



                    <?php include("includes/previousnext.inc.php"); ?>
				</div>

			</div>
			<?php include("includes/footer.inc.php"); ?>
		</div>
		<?php include("includes/scripts.inc.php"); ?>
	</body>
</html>