/*activate "login" button when both fields have content*/
$("input.login-input").on("keyup", function()
{
	var loginNumber = $("input.unummer").val();
	var loginPass = $("input.wachtwoord").val();
	
	if(loginNumber.length != 0 && loginPass.length != 0)
	{
		$("input.login-button").addClass("active");
	}
	else
	{
		$("input.login-button").removeClass("active");
	}
});

/*activate "add email" button when all fields have content*/
$(document).on("keyup", "#indAdd input[type=text]", function()
{
	var voornaam = $("input#iAFirstname").val();
	var achternaam = $("input#iALastname").val();
	var emailadres = $("input#iAEmail").val();
	
	if(voornaam.length != 0 && achternaam.length != 0 && emailadres.length != 0)
	{
		$("#indAdd input#iAAdd").addClass("active");
	}
	else
	{
		$("#indAdd input#iAAdd").removeClass("active");
	}
});

$("ul#otherCards li").on("click", function()
{
	$("ul#otherCards li").removeClass("chose");
	$(this).addClass("chose");

	var image = $("img", this).attr('src');
	var title = $("img", this).attr('alt');

	$(".stap1-choosen img").attr("src", image);
	$("h1#titleCard").text(title);
});

/*get value of input field only in stap2.php file*/
$(window).load(function()
{
	if($("body").hasClass("stap2"))
	{
		var textContent = $(".stap2-persoonlijkbericht").val();
		countChars(textContent);
	}
});

/*count amount of characters in input field*/
$(".stap2-persoonlijkbericht").on("keyup", function()
{
	var textContent = $(this).val();
	countChars(textContent);
});

/*count characters function*/
function countChars(textContent)
{
	var textContentLength = textContent.length;

	var charsLeft = 500 - textContentLength;
	$("p.stap2-characters span").text(charsLeft);

	if(charsLeft < 0)
	{
		$("p.stap2-characters span").css({"color":"#EF403E"});
	}
	else
	{
		$("p.stap2-characters span").css({"color":"#656565"});
	}
}

/*ERROR PREVENTIONS*/
$("a#gtStap3").on("click", function(e)
{
	var textInput = $(".stap2-persoonlijkbericht").val().length;

	var t = $(this);
	var dest = t.attr('href');
	var	error = "<p class='error'>Vergeet geen persoonlijk bericht te schrijven!</p>";
	$("p.error").remove();

	if(textInput !== 0)
	{
		if (typeof(dest) !== "undefined" && dest !== "")
		{
			window.location.href = dest;
		}
	}
	else
	{
		$("#content h1").after(error);
	}

	e.preventDefault();
});

$("a#gtStap4").on("click", function(e)
{
	var amountRows = $('table#stap3-table tr:not(#legend, #emptyList)').length;

	var t = $(this);
	var dest = t.attr('href');
	var	error = "<p class='error'>Vergeet geen ontvanger(s) toe te voegen!</p>";
	$("p.error").remove();
	
	if(amountRows !== 0)
	{
		if (typeof(dest) !== "undefined" && dest !== "")
		{
			window.location.href = dest;
		}
	}
	else
	{
		$("#stap3-buttons").after(error);
	}

	e.preventDefault();
});

/*check every box when "selectAll" is checked*/
$(document).on("click", "#selectAll", function()
{
	if($(this).prop("checked"))
	{
		$('.checkItem input').prop('checked', true);
	}
	else
	{
		$('.checkItem input').prop('checked', false);
	}
});

/*activate "delete" and "edit" buttons when something's checked*/
$(document).on("click", ".checkItem input", function()
{
	if($('td.checkItem input:checked').length > 0)
	{
		if($('td.checkItem input:checked').length == 1)
		{
			$("#stap3-buttons ul#emailaanpassen li#editList, #stap3-buttons ul#emailaanpassen li#editList a").addClass("active");
		}
		else
		{
			$("#stap3-buttons ul#emailaanpassen li#editList, #stap3-buttons ul#emailaanpassen li#editList a").removeClass("active");
		}
		$("#stap3-buttons ul#emailaanpassen li#deleteList, #stap3-buttons ul#emailaanpassen li#deleteList a").addClass("active");
	}
	else
	{
		$("#stap3-buttons ul#emailaanpassen li, #stap3-buttons ul#emailaanpassen li a").removeClass("active");
		$('#selectAll').prop('checked', false);
	}
});

var overlay = "<div id='overlay'></div>";

/*display individual email adding screen*/
$("a#indEmail").on("click", function(e)
{
	var individualAdd = "<div id='indAdd'>" +
							"<form action='#' method='POST'>" +
								"<a id='closeOverlay' href='#'>Sluiten</a>" +

								"<input id='iAFirstname' type='text' placeholder='Voornaam'>" +
								"<input id='iALastname' type='text' placeholder='Achternaam'>" +
								"<input id='iAEmail' type='text' placeholder='E-mailadres'>" +
								"<input id='iAAdd' type='submit' value='Toevoegen'>" +
							"</form>" +
						"</div>";

	$("body").prepend(overlay);
	$("body, html").css({"overflow":"hidden", "height":"100%"});
	$("#overlay").fadeIn(250);

	$("#overlay").after(individualAdd);
	$("#indAdd").animate({"opacity":"1", "margin-top":"-160.5px"}, "swing");

	$("input#iAFirstname").focus();

	e.preventDefault();
});

/*close overlay and individual email adding screen */
$(document).on("click", "#indAdd a, #overlay, input#iAEdit", function(e)
{
	closeOverlay();
	closeIndividualAdd();

	e.preventDefault();
});

/*close overlay function*/
function closeOverlay()
{
	if(!$("#overlay").hasClass("inactive"))
	{
		$("body, html").css({"overflow":"visible", "height":"auto"});
		$("#overlay").fadeOut(250, function()
		{
			$(this).remove();
		});
	}
}

/*close individual email adding function*/
function closeIndividualAdd()
{
	$("#indAdd").animate({"opacity":"0", "margin-top":"-135.5px"}, "swing", function()
	{
		$(this).remove();
	});
}


/*close overlay and bulk email adding screen */
$(document).on("click", "#bulkAdd a#closeOverlay, #overlay", function(e)
{
	closeOverlay();
	closeBulkAdd();

	e.preventDefault();
});

/*close bulk email adding function*/
function closeBulkAdd()
{
	if(!$("#overlay").hasClass("inactive"))
	{
		$("#bulkAdd").animate({"opacity":"0", "margin-top":"-67.5px"}, "swing", function()
		{
			$(this).remove();
		});
	}
}

/*add content of individual email adding screen to table*/
$(document).on("click", "input#iAAdd", function(e)
{
	var voornaam = $("input#iAFirstname").val();
	var achternaam = $("input#iALastname").val();
	var emailadres = $("input#iAEmail").val();

	var individualAdd = "<tr>" +
							"<td class='checkItem'><input type='checkbox' value='check'></td>" +
							"<td class='firstname'>"+voornaam+"</td>" +
							"<td class='lastname'>"+achternaam+"</td>" +
							"<td class='email'>"+emailadres+"</td>" +
						"</tr>";
	closeOverlay();
	closeIndividualAdd();

	$("tr#emptyList").remove();
	$("#stap3-table tr:first").after(individualAdd);

	e.preventDefault();
});

/*display bulk email adding screen*/
$("a#bulkEmail").on("click", function(e)
{
	var bulkAdd = "<div id='bulkAdd'>" +
						"<form action='#' id='fileToUpload' method='POST' enctype='multipart/form-data'>" +
							"<a id='closeOverlay' href='#'>Sluiten</a>" +

							"<div id='fileCon'>" +
								"Importeer CSV bestand" +
								"<input class='fileInput hidden' type='file' name='emails'/>" +
							"</div>" +

							"<input id='bAAdd' type='submit' value='Toevoegen'>" +

						"</form>" +
					"</div>";
	
	$("body").prepend(overlay);
	$("body, html").css({"overflow":"hidden", "height":"100%"});
	$("#overlay").fadeIn(250);

	$("#overlay").after(bulkAdd);
	$("#bulkAdd").animate({"opacity":"1", "margin-top":"-92.5px"}, "swing");

	e.preventDefault();
});

/*upload file polyfill*/
$(function() {
    $("#fileCon").mousedown(function() {
        var button = $(this);
        button.addClass('clicked');
        setTimeout(function(){
            button.removeClass('clicked');
        },50);
    });
});

/*print out name of chosen file */
$(document).on("change", "input[type=file]", function()
{
	$("#overlay").addClass("inactive");

	$("#UpProgress #bar #progress").css({"width":"0%"});
	$("input#bAAdd").removeClass("active");
	$("#UpProgress").remove();

	var filename = $('input[type=file]').val().split('\\').pop();

	if(filename.length > 0)
	{
		var progress = "<div id='UpProgress'>" +
							"<div id='fileName'>" +
								"<h2></h2>" +
								"<a id='deleteFile' href='#'>bestand weigeren</a>" +
							"</div>" +

							"<div id='bar'><div id='progress'></div></div>" +
						"</div>";
					
		$("#fileCon").after(progress);

		$("#UpProgress h2").text(filename);
		
		var randomSpeed = Math.floor(Math.random() * (2000 - 750 + 1)) + 750;
		$("#UpProgress #bar #progress").animate({"width":"100%"}, randomSpeed, function()
		{
			$("input#bAAdd").addClass("active");
			$("input#bAAdd").attr("name", "fileToUpload" );
			$("#overlay").removeClass("inactive");
		});
	}
});

/*file rejected, delete elements*/
$(document).on("click", "a#deleteFile", function(e)
{
	$("#UpProgress h2").text("");
	$("input#bAAdd").removeClass("active");

	var input = $("#fileToUpload");
	input.replaceWith(input.val('').clone(true));

	$("#UpProgress").remove();

	e.preventDefault();
});

/*delete an email*/
$("ul#emailaanpassen li a#deleteEmail").on("click", function(e)
{
	if($(this).parent().hasClass("active"))
	{
		var checkedItem = $("tr td.checkItem input:checked").parent().parent().remove();

		if($("tr td").length == 0)
		{
			var emptyTable = "<tr id='emptyList'>" +
								"<td class='checkItem'></td>" +
								"<td>Nog geen ontvangers</td>" +
								"<td></td>" +
								"<td></td>" +
							"</tr>";

			$("#stap3-table tr:first").after(emptyTable);
		}

		if($("#selectAll").prop("checked"))
		{
			$("#selectAll").prop("checked", false);
		}

		$("#stap3-buttons ul#emailaanpassen li, #stap3-buttons ul#emailaanpassen li a").removeClass("active");
	}
	e.preventDefault();
});

/*edit an email*/
$("ul#emailaanpassen li a#editEmail").on("click", function(e)
{
	if($(this).parent().hasClass("active"))
	{
		var amountChecked = $("tr td.checkItem input:checked").length;

		if(amountChecked == 1)
		{
			var firstNameOld = $("tr td.checkItem input:checked").parent().siblings("td.firstname").text();
			var lastNameOld = $("tr td.checkItem input:checked").parent().siblings("td.lastname").text();
			var emailOld = $("tr td.checkItem input:checked").parent().siblings("td.email").text();

			var individualAdd = "<div id='indAdd'>" +
									"<form action='#' method='POST'>" +
										"<a id='closeOverlay' href='#'>Sluiten</a>" +

										"<input id='iAFirstname' type='text' value='"+firstNameOld+"' placeholder='Voornaam'>" +
										"<input id='iALastname' type='text' value='"+lastNameOld+"' placeholder='Achternaam'>" +
										"<input id='iAEmail' type='text' value='"+emailOld+"' placeholder='E-mailadres'>" +
										"<input id='iAEdit' type='submit' value='Wijzigen'>" +
									"</form>" +
								"</div>";

			$("body").prepend(overlay);
			$("body, html").css({"overflow":"hidden", "height":"100%"});
			$("#overlay").fadeIn(250);

			$("#overlay").after(individualAdd);
			$("#indAdd").animate({"opacity":"1", "margin-top":"-160.5px"}, "swing");

			$("input#iAFirstname").focus();



			$(document).on("click", "input#iAEdit", function(e)
			{
				var voornaamNew = $("input#iAFirstname").val();
				var achternaamNew = $("input#iALastname").val();
				var emailadresNew = $("input#iAEmail").val();

				$("tr td.checkItem input:checked").parent().siblings("td.firstname").text(voornaamNew);
				$("tr td.checkItem input:checked").parent().siblings("td.lastname").text(achternaamNew);
				$("tr td.checkItem input:checked").parent().siblings("td.email").text(emailadresNew);

				$("tr td.checkItem input:checked").prop("checked", false);
				e.preventDefault();
			});
		}
	}
	e.preventDefault();
});





var swipeOptions = {dragLockToAxis: true, dragBlockHorizontal: true};
$(".flipbox-container").hammer(swipeOptions).bind("swipe", swiped);

function swiped(event)
{
	var direction = event.gesture.direction;
    var swipeState;

	switch(direction)
	{
		case "left":
		swipeState = "LEFT";
		break;

		case "right":
		swipeState = "RIGHT";
		break;

		case "down":
		swipeState = "BOTTOM";
		break;

		case "up":
		swipeState = "TOP";
		break;
	}

	var controller = $(".flipbox-container");

	if(controller.hasClass("swiped"))
	{
		$(".flipbox-container").flippy(
		{
			color_target: "#F3F3F3",
			direction: swipeState,
			duration: "550",
			light: "10",
			depth: "0.1",
			verso: $("#front").html(),

			onFinish: function ()
			{
				$(".flipbox-container").removeClass("swiped");
				$("#nav li#center span").text("achterkant");
			}
		});
	}
	else
	{
		$(".flipbox-container").flippy(
		{
			color_target: "#F3F3F3",
			direction: swipeState,
			duration: "550",
			light: "10",
			depth: "0.1",
			verso: $("#back").html(),

			onFinish: function ()
			{
				$(".flipbox-container").addClass("swiped");
				$("#nav li#center span").text("voorkant");
			}
		});
	}
}


$("a#sendCard").on("click", function(e)
{
	var confirmation = "<div id='sendConfirmation'>" +
							"<a id='closeOverlay' href='#'>Sluiten</a>" +
								"<div id='confirmationCon'>" +
									"<h1>Weet je zeker dat je klaar bent?</h1>" +
									"<p>Je staat op het punt om deze kaart naar <span>5</span> personen te versturen.</p>" +

									"<ul>" +
										"<li id='send'><a href='#'>Versturen</a></li>" +
										"<li id='cancel'><a href='#'>Annuleren</a></li>" +
									"</ul>" +
								"</div>" +
							"</div>";

	$("body").prepend(overlay);
	$("body, html").css({"overflow":"hidden", "height":"100%"});
	$("#overlay").fadeIn(250);

	$("#overlay").after(confirmation);
	$("#sendConfirmation").animate({"opacity":"1", "margin-top":"-140.5px"}, "swing");

	e.preventDefault();
});

$(document).on("click", "#sendConfirmation a#closeOverlay,  #overlay, #sendConfirmation li#cancel a", function(e)
{
	closeOverlay();
	closeConfirmation();

	e.preventDefault();
});

function closeConfirmation()
{
	$("#sendConfirmation, #cardProgressCompleted").animate({"opacity":"0", "margin-top":"-110.5px"}, "swing", function()
	{
		$(this).remove();
	});
}

$(document).on("click", "#sendConfirmation li#send a", function(e)
{
	$("#overlay").addClass("inactive");

	var progressSending = "<div id='sendingProgress'>" +
							"<h1>Aan het versturen...</h1>" +

							"<div id='progressBarSendCon'>" +
								"<div id='progressBarSendSec'></div>" +
							"</div>" +
						"</div>";

	var progressComplete = "<div id='cardProgressCompleted'>" +
								"<h1>Verstuurd</h1>" +
								"<p>Alle kaarten zijn met succes verstuurd.</p>" +
								"<a href='stap1.php'>Nog een kaart versturen</a>" +
							"</div>";

	$("#sendConfirmation").remove();
	$("#overlay").after(progressSending);

	var randomSpeed = Math.floor(Math.random() * (3000 - 1000 + 1)) + 1000;
	$("#progressBarSendCon #progressBarSendSec").animate({"width":"100%"}, randomSpeed, function()
	{
		$("#sendingProgress").remove();
		$("#overlay").after(progressComplete);
		$("#overlay").removeClass("inactive");
	});

	e.preventDefault();
});