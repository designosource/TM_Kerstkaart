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
				$("#nav h1 span").text("achterkant");
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
				$("#nav h1 span").text("voorkant");
			}
		});
	}
}