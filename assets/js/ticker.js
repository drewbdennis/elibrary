// ticker
function tick(){
	// one line new ticker
	//$('#ticker li:first').animate({'opacity':0}, 200, function () { $(this).appendTo($('#ticker')).css('opacity', 1); });
	
	$('#ticker li:first').slideUp( function () { $(this).appendTo($('#ticker')).slideDown(); });
}

// stop ticker on hover
$('#ticker').hover(function() {
	$(this).css('cursor','progress');
	clearInterval(tickInterval);
	},function() {
	$(this).css('cursor','pointer');
	startTimer();
});

// start timer
function startTimer(){
	tickInterval = setInterval(function(){tick()}, 5000);
}

startTimer();