$(document).ready(function(){
	var shown = 0;
	$('#fab').click(function(){
		/*if(!shown){
			$('#card').animate({
				opacity: 1,
				top: "-=100"
			}, 500, function(){shown = 1;});
			
		}
		else{
			$('#card').animate({
				opacity: 0,
				top: "+=100"
			}, 500, function(){shown = 0;});
			
		}*/
		if(shown){
			hide();
			shown = 0;
		}
		else{
			show();
			shown = 1;
		}
	
	})
});