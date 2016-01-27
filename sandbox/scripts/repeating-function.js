function repeatedAction(){
	console.log("Action Triggered");
	repeat();
}
function repeat(){
	setTimeout(function(){
		repeatedAction();
	}, 2000);
}
repeatedAction();