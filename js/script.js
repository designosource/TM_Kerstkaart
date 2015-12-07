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
				$(".flipbox-container").removeClass("swiped");
				$("#nav h1 span#messageHinter").text("persoonlijke boodschap");
				$("#nav h1 span#sideHinter").text("kaart");
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
				$("#nav h1 span#messageHinter").text("kerstkaart");
				$("#nav h1 span#sideHinter").text("tekst");
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
					$(".flipbox-container").removeClass("swiped");
					$("#nav h1 span#messageHinter").text("persoonlijke boodschap");
					$("#nav h1 span#sideHinter").text("kaart");
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
					$("#nav h1 span#messageHinter").text("kerstkaart");
					$("#nav h1 span#sideHinter").text("tekst");
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