
$('.btn-primary').on('click', function(){
	
	$('div#line').removeAttr('class').addClass('blueLine');
	
});

$('.btn-danger').on('click', function(){
	$('div#line').removeAttr('class').addClass('redLine');
	
});


