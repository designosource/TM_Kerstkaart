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
	$("body, html").css({"overflow":"visible", "height":"auto"});
	$("#overlay").fadeOut(250, function()
	{
		$(this).remove();
	});
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
	$("#bulkAdd").animate({"opacity":"0", "margin-top":"-67.5px"}, "swing", function()
	{
		$(this).remove();
	});
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
	$("#UpProgress #bar #progress").css({"width":"0%"});
	$("input#bAAdd").removeClass("active");
	$("#UpProgress").remove();

	var filename = $('input[type=file]').val().split('\\').pop();

	if(filename.length > 0)
	{
		var progress = "<div id='UpProgress'>" +
							"<div id='fileName'>" +
								"<h2>dribbble.png</h2>" +
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

$(window).load(function()
{
	$("#cardCon").flip(
	{
		trigger: 'manual'
	});
});

var swipeOptions = {dragLockToAxis: true, dragBlockHorizontal: true};
$("#cardCon").hammer(swipeOptions).bind("swipe", myPanHandler);

function myPanHandler(ev)
{
	var direction = ev.gesture.direction;
    var swipeLeft = "left";
    var swipeRight = "right";

    if(direction == swipeLeft)
    {
		$("#cardCon").flip(false);
    }
    if(direction == swipeRight)
    {
		$("#cardCon").flip(true);
    }
}