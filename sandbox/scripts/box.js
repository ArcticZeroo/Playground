$(document).ready(function(){
	var ready = 1;
	setTimeout(function(){
		$('#box').removeClass('start');
		ready = 0;
	}, 3000);
	$('#fab').click(function(){
		if(!ready){
			$('#box').addClass('move');
			ready = 1;
			setTimeout(function(){
				ready = 0;
				$('#box').removeClass('move');
			}, 5000);
		};
	});
});