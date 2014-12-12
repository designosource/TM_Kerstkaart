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
$(document).on("keyup change", "#indAdd input[type=text]", function()
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
	var id = $("img", this).attr('data-id');
	var type = $("img", this).attr('data-type');
	var url = $("img", this).attr('data-url');

	if(type == "static")
	{
		$(".stap1-choosen").empty();
		var content = "<img alt=" + title + " data-id=" + id + " data-type="+ type +" src='img/full_"+url+".png'/>";
	}
	else
	{
		$(".stap1-choosen").empty();
		var content = "<video width='100%' loop autoplay poster='img/full_"+url+".png' src='img/full_"+url+".mp4' data-id='"+id+"' alt='"+title+"' data-type='"+type+"'>" +
						  	"<source src='img/full_"+url+".mp4' type='video/mp4'>" +
						  	"<source src='img/full_"+url+".webm' type='video/webm'>" +
						  	"<source src='img/full_"+url+".ogv' type='video/ogg'>" +
						  	"<img src='img/full_"+url+".png'>" +
						"</video>";
	}


	$(".stap1-choosen").append(content);
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

	if($('body').hasClass("stap1"))
	{
		var selectedID = $(".stap1-choosen img").attr('data-id');

		var cardListID = $("ul#otherCards li.card img").attr('data-id');

		$('ul#otherCards li.card img').each(function()
		{
			var cardListID = $(this).attr('data-id');
			if(cardListID == selectedID)
			{
				$(this).parent().addClass("chose");
			}
		});
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
$("a#gtStap3, a#gbStap1").on("click", function(e)
{
	var textInput = $(".stap2-persoonlijkbericht").val().length;

	var t = $(this);
	var dest = t.attr('href');
	var	error = "<p class='error'>Vergeet geen persoonlijk bericht te schrijven</p>";
	var	errorLength = "<p class='error'>Te veel karakters gebruikt</p>";
	$("p.error").remove();

	var personalMessage = $(".stap2-persoonlijkbericht").val();

	if(textInput !== 0)
	{
		if(textInput <= 500)
		{
			var sendData = $.ajax(
						{
							type: "POST",
							url: "ajax/getMessage.php",
							data: {
									personalMessage: personalMessage
									}
						});

			sendData.done(function(data)
			{
				if (typeof(dest) !== "undefined" && dest !== "")
				{
					window.location.href = dest;
				}
			});
		}
		else
		{
			$("#content h1#perMessage").after(errorLength);
		}
	}
	else
	{
		$("#content h1#perMessage").after(error);
	}

	e.preventDefault();
});

function validateSender(voornaam, achternaam, emailadres)
{
	var errors = false;
	var voornaamError = "<p id='voornaamError' class='error'>Vergeet uw voornaam niet</p>";
	var achternaamError = "<p id='achternaamError' class='error'>Vergeet uw achternaam niet</p>";

	var emailErrorMissing = "<p id='emailError' class='error'>Vergeet uw emailadres niet</p>";
	var emailErrorInvalid = "<p id='emailError' class='error'>Dit is geen geldig emailadres</p>";

	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var validEmail = (re.test(emailadres));

	if(voornaam.length === 0)
	{
		errors = true;
		$("#content h1#senderInfo").after(voornaamError);
	}
	if(achternaam.length === 0)
	{
		errors = true;
		$("#content h1#senderInfo").after(achternaamError);
	}
	if(emailadres.length === 0)
	{
		errors = true;
		$("#content h1#senderInfo").after(emailErrorMissing);
	}
	else
	{
		if(validEmail === false)
		{
			errors = true;
			$("#content h1#senderInfo").after(emailErrorInvalid);
		}
	}

	return errors;
}

$("a#gtStap4").on("click", function(e)
{
	var amountRows = $('table#stap3-table tr:not(#legend, #emptyList)').length;

	var t = $(this);
	var dest = t.attr('href');
	var	error = "<p class='error'>Vergeet geen ontvanger(s) toe te voegen!</p>";
	$("p.error").remove();

	$("td.email").css({"color":"#656565"});

	var isError;
	var errorArray = [];

	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	$("tr td.checkItem input").map(function()
	{
		var emailAdded = $(this).parent().siblings("td.email").text();
		var emailID = $(this).parent();
		var validEmail = (re.test(emailAdded));

		validateErrorTable(validEmail, emailID, emailAdded);
	});

	var containsErrors = $.inArray('false', validateTabel()) > -1;

	if(containsErrors == false)
	{
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
	}

	e.preventDefault();
});

function validateErrorTable(email, element, name)
{
	if(email == false)
	{
		var elementEmail = element.siblings("td.email");
		$(elementEmail).css({"color":"#EF403E"});

		var	error = "<p class='error'>"+name+" is geen geldig e-mailadres</p>";
		$("#stap3-buttons").after(error);
	}
}

function validateTabel()
{
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var errors = [];

	$("tr.emailAdded").each(function() 
	{
		var emailToValidate = $("td.email", this).text();
		var resultValid = re.test(emailToValidate);
		var error;

		if(resultValid == false)
		{
			error = "false";
		}
		else
		{
			error = "true";
		}
		errors.push(error);
	});

	return errors;
}

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
	if($(this).prop("checked"))
	{
		$(this).parent().parent().not("#legend").addClass("chose");
	}
	else
	{
		$(this).parent().parent().not("#legend").removeClass("chose");
	}

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

								"<label for='iAFirstname'>Voornaam</label>" +
								"<input id='iAFirstname' type='text' placeholder='Voornaam'>" +

								"<label for='iALastname'>Achternaam</label>" +
								"<input id='iALastname' type='text' placeholder='Achternaam'>" +

								"<label for='iAEmail'>E-mailadres</label>" +
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
		$("#bulkAdd").animate({"opacity":"0", "margin-top":"-153.5px"}, "swing", function()
		{
			$(this).remove();
		});
	}
}

/*add content of individual email adding screen to table*/
$(document).on("click", "input#iAAdd", function(e)
{
	if($(this).hasClass("active"))
	{
		$("p.error").remove();

		var voornaam = $("input#iAFirstname").val();
		var achternaam = $("input#iALastname").val();
		var emailadres = $("input#iAEmail").val();

		if(validateIndividual(voornaam, achternaam, emailadres) === false)
		{
			var individualAdd = "<tr>" +
									"<td class='checkItem'><input type='checkbox' value='check'></td>" +
									"<td class='firstname'>"+voornaam+"</td>" +
									"<td class='lastname'>"+achternaam+"</td>" +
									"<td class='email'>"+emailadres+"</td>" +
								"</tr>";
			closeOverlay();
			closeIndividualAdd();

			var sendData = $.ajax(
							{
								type: "POST",
								url: "ajax/addPerson.php",
								data: {
										voornaam: voornaam,
										achternaam: achternaam,
										emailadres: emailadres
										}
							});

			sendData.done(function(data)
			{
				console.log(data);
			});

			$("tr#emptyList").remove();
			$("#stap3-table tr:first").after(individualAdd);
		}
	}

	e.preventDefault();
});

function validateIndividual(voornaam, achternaam, emailadres)
{
	var errors = false;
	var voornaamError = "<p id='voornaamError' class='error'>Vergeet de voornaam niet</p>";
	var achternaamError = "<p id='achternaamError' class='error'>Vergeet de achternaam niet</p>";

	var emailErrorMissing = "<p id='emailError' class='error'>Vergeet het emailadres niet</p>";
	var emailErrorInvalid = "<p id='emailError' class='error'>Dit is geen geldig emailadres</p>";

	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var validEmail = (re.test(emailadres));

	if(voornaam.length === 0)
	{
		errors = true;
		$("input#iAFirstname").before(voornaamError);
	}
	if(achternaam.length === 0)
	{
		errors = true;
		$("input#iALastname").before(achternaamError);
	}
	if(emailadres.length === 0)
	{
		errors = true;
		$("input#iAEmail").before(emailErrorMissing);
	}
	else
	{
		if(validEmail === false)
		{
			errors = true;
			$("input#iAEmail").before(emailErrorInvalid);
		}
	}

	return errors;
}

/*display bulk email adding screen*/
$("a#bulkEmail").on("click", function(e)
{
	var bulkAdd = "<div id='bulkAdd'>" +
						"<form action='#' id='fileToUpload' method='POST' enctype='multipart/form-data'>" +

							"<div id='guideCon'>" +
								"<ol>" +
									"<li><p><a id='downloadcsv' href='kerstkaart_emails.xls' target='_blank'>Excel-template downloaden</a></p></li>" +
									"<li><p>Vul per bestemmeling één rij in.</p></li>" +
									"<li><p>Importeer jouw ingevulde lijst via onderstaande knop.</p></li>" +
								"</ol>" +
							"</div>" +

							"<a id='closeOverlay' href='#'>Sluiten</a>" +

							"<div id='fileCon'>" +
								"Importeer Excel-bestand" +
								"<input class='fileInput hidden' type='file' name='emails'/>" +
							"</div>" +

							"<input id='bAAdd' type='submit' value='Toevoegen'>" +

						"</form>" +
					"</div>";
	
	$("body").prepend(overlay);
	$("body, html").css({"overflow":"hidden", "height":"100%"});
	$("#overlay").fadeIn(250);

	$("#overlay").after(bulkAdd);
	$("#bulkAdd").animate({"opacity":"1", "margin-top":"-183px"}, "swing");

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

$(document).on("click", "tr td.checkItem input", function()
{
    if($('tr td.checkItem input:checked').length == $('tr td.checkItem input').length)
    {
      $("#selectAll").prop("checked", true);
    }
    else
    {
       $("#selectAll").prop("checked", false);
    }
});

/*delete an email*/
$("ul#emailaanpassen li a#deleteEmail").on("click", function(e)
{
	if($(this).parent().hasClass("active"))
	{
		var checkedItem = $("tr td.checkItem input:checked").parent().parent().remove();
		
		var persons = [];

		$("tr td.checkItem input:checkbox:not(:checked)").map(function()
		{
			var checkedFirstname = $(this).parent().siblings("td.firstname").text();
			var checkedLastname = $(this).parent().siblings("td.lastname").text();
			var checkedEmail = $(this).parent().siblings("td.email").text();
			var person = {'voornaam': checkedFirstname, 'achternaam': checkedLastname, 'emailadres':checkedEmail};
			persons.push(person);
		});
		
		var deleteData = $.ajax(
							{
								type: "POST",
								url: "ajax/deleteEmail.php",
								data: {
										persons: persons
										}
							});

		
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

				var persons = [];
				$("tr td.checkItem input").map(function()
				{
					var checkedFirstname = $(this).parent().siblings("td.firstname").text();
					var checkedLastname = $(this).parent().siblings("td.lastname").text();
					var checkedEmail = $(this).parent().siblings("td.email").text();
					var person = {'voornaam': checkedFirstname, 'achternaam': checkedLastname, 'emailadres':checkedEmail};
					persons.push(person);
				});

				var editData = $.ajax(
										{
											type: "POST",
											url: "ajax/editPerson.php",
											data: { 
														persons: persons
													}
										});

				$("tr td.checkItem input:checked").prop("checked", false);
				e.preventDefault();
			});
		}
	}
	e.preventDefault();
});

$("a#gtStap2").on("click", function(e)
{
	var chosenCardURL = $(".stap1-choosen img, .stap1-choosen video").attr('src');
	var chosenCardALT = $("h1#titleCard").text();
	var chosenCardID = $(".stap1-choosen img, .stap1-choosen video").attr('data-id');
	var chosenCardType = $(".stap1-choosen img, .stap1-choosen video").attr('data-type');

	var t = $(this);
	var dest = t.attr('href');

	var splitCardURL = chosenCardURL.split(".");
	var splitTwiceCardURL = splitCardURL[0].split("/");
	var trueCardURL = splitTwiceCardURL[1];

	var sendData = $.ajax(
					{
						type: "POST",
						url: "ajax/getCard.php",
						data: {
								chosenCardURL: trueCardURL,
								chosenCardALT: chosenCardALT,
								chosenCardID: chosenCardID,
								chosenCardType: chosenCardType
								}
					});

	sendData.done(function(data)
	{
		if (typeof(dest) !== "undefined" && dest !== "")
		{
			window.location.href = dest;
		}
	});

	e.preventDefault();
});





var swipeOptions = {dragLockToAxis: true, dragBlockHorizontal: true};
$(".flipbox-container").hammer(swipeOptions).bind("swipe", swiped);

$(document).on("click", "#vorige-volgende li#center a#clickHinter", function(e)
{
	var controller = $(".flipbox-container");

	if(controller.hasClass("swiped"))
	{
		$(".flipbox-container").flippy(
		{
			color_target: "#F3F3F3",
			duration: "550",
			light: "10",
			depth: "0.1",
			verso: $("#front").html(),

			onFinish: function ()
			{
				$(".flipbox-container").removeClass("swiped");
				$("#nav li#center span#messageHinter").text("persoonlijke boodschap");
				$("#nav li#center span#sideHinter").text("kaart");
			}
		});
	}
	else
	{
		$(".flipbox-container").flippy(
		{
			color_target: "#F3F3F3",
			duration: "550",
			light: "10",
			depth: "0.1",
			verso: $("#back").html(),

			onFinish: function ()
			{
				$(".flipbox-container").addClass("swiped");
				$("#nav li#center span#messageHinter").text("kerstkaart");
				$("#nav li#center span#sideHinter").text("tekst");
			}
		});
	}

	e.preventDefault();
});

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
	}

	var controller = $(".flipbox-container");

	if(swipeState !== undefined)
	{
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
					$("#nav li#center span#messageHinter").text("persoonlijke boodschap");
					$("#nav li#center span#sideHinter").text("kaart");
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
					$("#nav li#center span#messageHinter").text("kerstkaart");
					$("#nav li#center span#sideHinter").text("tekst");
				}
			});
		}
	}
}

$("a#sendCard").on("click", function(e)
{
	$("body").prepend(overlay);
	$("body, html").css({"overflow":"hidden", "height":"100%"});
	$("#overlay").fadeIn(250);

	$("#sendConfirmation").css({"display":"block"}).animate({"opacity":"1", "margin-top":"-140.5px"}, "swing");

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
	$("#cardProgressCompleted").animate({"opacity":"0", "margin-top":"-110.5px"}, "swing", function()
	{
		$(this).remove();
	});

	$("#sendConfirmation").animate({"opacity":"0", "margin-top":"-110.5px"}, "swing", function()
	{
		$(this).css({"display":"none"});
	});


}

$(document).on("click", "#sendConfirmation li#send a", function(e)
{
	$("#overlay").addClass("inactive");

	var saveData = $.ajax(
					{
						type: "POST",
						url: "ajax/saveData.php"
					});

	saveData.done(function(data)
	{
		/*var persedData = JSON.parse(data);
		console.log(persedData);*/
		console.log(data);
	});

	var progressSending = "<div id='sendingProgress'>" +
							"<h1>Aan het versturen...</h1>" +

							"<div id='progressBarSendCon'>" +
								"<div id='progressBarSendSec'></div>" +
							"</div>" +
						"</div>";

	var progressComplete = "<div id='cardProgressCompleted'>" +
								"<h1>Verstuurd</h1>" +
								"<p>Alle kaarten zijn met succes verstuurd.</p>" +
								"<a href='index.php'>Nog een kaart versturen</a>" +
							"</div>";

	$("#sendConfirmation").css({"display":"none", "opacity":"0", "margin-top":"-110.5px"});

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

$("li.appreciate a").on("click", function(e)
{
	$("body").prepend(overlay);
	$("#overlay").fadeIn(250);

	$("#appreciateCon").css({"display":"block"}).animate({"opacity":"1", "margin-top":"-166px"}, "swing");

	e.preventDefault();
});

$(document).on("click", "#appreciateCon ul li#cancel a, #appreciateCon a#closeOverlay, #overlay", function(e)
{
	closeOverlay();

	$("#appreciateCon").animate({"opacity":"0", "margin-top":"-136px"}, "swing", function()
	{
		$(this).css({"display":"none"});
	});

	$("#sentAppreciation").animate({"opacity":"0", "margin-top":"-96px"}, "swing", function()
	{
		$(this).remove();
	});

	e.preventDefault();
});

$("#appreciateCon li#send a").on("click", function(e)
{
	$("p.error").remove();

	var inputText = $("form textarea#appreciateText").val();
	if(inputText.length !== 0)
	{

		var senderFirstname = $("form textarea#appreciateText").attr("data-senderfirstname");
		var senderLastname = $("form textarea#appreciateText").attr("data-senderlastname");
		var senderemail = $("form textarea#appreciateText").attr("data-senderemail");

		var receiverfirstname = $("form textarea#appreciateText").attr("data-receiverfirstname");
		var receiverlastname = $("form textarea#appreciateText").attr("data-receiverlastname");
		var receiveremail = $("form textarea#appreciateText").attr("data-receiveremail");
		
		var sendMail = $.ajax(
							{
								type: "POST",
								url: "ajax/sendAppreciation.php",
								data: {
										senderFirstname: senderFirstname,
										senderLastname: senderLastname,
										senderemail: senderemail,

										receiverfirstname: receiverfirstname,
										receiverlastname: receiverlastname,
										receiveremail: receiveremail,

										inputText: inputText
										}
							});

		sendMail.done(function(data)
		{
			var succesMessage = "<div id='sentAppreciation'>" +
									"<a id='closeOverlay' href='#'>Sluiten</a>" +
									"<h1>Verstuurd</h1>" +
									"<p>Je bericht is met succes verstuurd.</p>" +
								"</div>";

			$("#appreciateCon").css({"display":"none", "opacity":"0", "margin-top":"-136px"});

			$("#overlay").after(succesMessage);
			$("form textarea#appreciateText").val("");
		});
	}
	else
	{
		var	error = "<p class='error'>Vergeet geen bericht te schrijven</p>";
		$("#appreciateSec h1").after(error);
	}
	
	e.preventDefault();
});


$('#go').on('click',function(evt)
{
	if($(this).hasClass("is-paused")) 
	{
		playBackgroundMusic();
		$("#go").val("Muziek dempen");
	}
	else 
	{
		pauseBackgroundMusic();
		$("#go").val("Muziek afspelen");
	}
});

function pauseBackgroundMusic() 
{
    if (beepTwo[0].paused == false) 
    {
        beepTwo[0].pause();
        beepTwo.animate({volume: 0});
        $('#go').addClass("is-paused");
    }
}

function playBackgroundMusic() 
{
    if (beepTwo[0].paused == true) 
    {
        beepTwo[0].play();  
        beepTwo.animate({volume: 1});
        $('#go').removeClass("is-paused");
    }
}

function toggleBackgroundMusic()
{
    if (beepTwo[0].paused == false) 
    {
        pauseBackgroundMusic();
	} 
	else 
	{
        playBackgroundMusic();
	}
}

var beepTwo = $("#backgoundMusic");

/*Comment to disable autoplay*/
if($('body').hasClass('stap4'))
{
	if($('body').hasClass('music'))
	{
		playBackgroundMusic();	
	}
	else
	{
		$("#audioCon").remove();
	}
}