$(document).on("click", "a#clickHinter", function(e)
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
				var text1;
				var text2;
				var lang = $("#lang").val();
				if(lang == "fr"){
					text1 = "la carte de vœux";
					text2 = "votre message personnalisé";
				} else if(lang == "en"){
					text1 = "card";
					text2 = "personal message";
				}else{
					text1 = "kerstkaart";
					text2 = "persoonlijke boodschap";
				}

				$(".flipbox-container").removeClass("swiped");
				$("#nav h1 span#messageHinter").text(text2);
				$("#nav h1 span#sideHinter").text(text1);
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
				var text1;
				var text2;
				var lang = $("#lang").val();
				if(lang == "fr"){
					text1 = "la carte de vœux";
					text2 = "votre message personnalisé";
				} else if(lang == "en"){
					text1 = "card";
					text2 = "personal message";
				}else{
					text1 = "kerstkaart";
					text2 = "persoonlijke boodschap";
				}

				$(".flipbox-container").addClass("swiped");
				$("#nav h1 span#messageHinter").text(text1);
				$("#nav h1 span#sideHinter").text(text2);
			}
		});
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
					var text1;
					var text2;
					var lang = $("#lang").val();
					if(lang == "fr"){
						text1 = "la carte de vœux";
						text2 = "votre message personnalisé";
					} else if(lang == "en"){
						text1 = "card";
						text2 = "personal message";
					}else{
						text1 = "kerstkaart";
						text2 = "persoonlijke boodschap";
					}
					$(".flipbox-container").removeClass("swiped");
					$("#nav h1 span#messageHinter").text(text2);
					$("#nav h1 span#sideHinter").text(text1);
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
					var text1;
					var text2;
					var lang = $("#lang").val();
					if(lang == "fr"){
						text1 = "la carte de vœux";
						text2 = "votre message personnalisé";
					} else if(lang == "en"){
						text1 = "card";
						text2 = "personal message";
					}else{
						text1 = "kerstkaart";
						text2 = "persoonlijke boodschap";
					}
					$(".flipbox-container").addClass("swiped");
					$("#nav h1 span#messageHinter").text(text1);
					$("#nav h1 span#sideHinter").text(text2);
				}
			});
		}
	}
}

$('#go').on('click',function(evt)
{
	if($(this).hasClass("is-paused"))
	{
		playBackgroundMusic();
		$("#go").html("<img src='img/on.png' alt=''>");
	}
	else
	{
		pauseBackgroundMusic();
		$("#go").html("<img src='img/off.png' alt=''>");
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
if($('body').hasClass('music'))
{
	playBackgroundMusic();
}
else
{
	$("#audioCon").remove();
}
var w = window.innerWidth
		|| document.documentElement.clientWidth
		|| document.body.clientWidth;
console.log(w);
if(w >= 1024){
	$('.videoCon').removeAttr('controls');
}