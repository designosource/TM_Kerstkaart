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

$(window).load(function()
{
	if($("body").hasClass("stap2"))
	{
		var textContent = $(".stap2-persoonlijkbericht").val();
		countChars(textContent);	
	}
});

$(".stap2-persoonlijkbericht").on("keyup", function()
{
	var textContent = $(this).val();
	countChars(textContent);
});

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

$(document).on("click", ".checkItem input", function()
{
	if($('td.checkItem input:checked').length > 0)
	{
		$("#stap3-buttons ul#emailaanpassen li, #stap3-buttons ul#emailaanpassen li a").addClass("active");
	}
	else
	{
		$("#stap3-buttons ul#emailaanpassen li, #stap3-buttons ul#emailaanpassen li a").removeClass("active");
		$('#selectAll').prop('checked', false);
	}
});

var overlay = "<div id='overlay'></div>";

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
	$("#overlay").fadeIn(250);

	$("#overlay").after(individualAdd);
	$("#indAdd").animate({"opacity":"1", "margin-top":"-160.5px"}, "swing");

	e.preventDefault();
});

$(document).on("click", "#indAdd a, #overlay", function(e)
{
	closeOverlay();
	closeIndividualAdd();

	e.preventDefault();
});

function closeOverlay()
{
	$("#overlay").fadeOut(250, function()
	{
		$(this).remove();
	});
}

function closeIndividualAdd()
{
	$("#indAdd").animate({"opacity":"0", "margin-top":"-135.5px"}, "swing", function()
	{
		$(this).remove();
	});
}

$(document).on("click", "input#iAAdd", function(e)
{
	var voornaam = $("input#iAFirstname").val();
	var achternaam = $("input#iALastname").val();
	var emailadres = $("input#iAEmail").val();

	var individualAdd = "<tr>" +
							"<td class='checkItem'><input type='checkbox' value='check'></td>" +
							"<td>"+voornaam+"</td>" +
							"<td>"+achternaam+"</td>" +
							"<td>"+emailadres+"</td>" +
						"</tr>"
	closeOverlay();
	closeIndividualAdd();

	$("tr#emptyList").remove();
	$("#stap3-table tr:first").after(individualAdd);

	e.preventDefault();
})
