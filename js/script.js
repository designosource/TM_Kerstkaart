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

$("#selectAll").on("click", function()
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

$(".checkItem input").on("click", function()
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
