$('.dropdown-toggle').dropdown();
$('#activities li').on('click', function() {
    $('#activityButton').html($(this).find('a').html() + "   <span class='caret'></span>");
	$("#activityHidden").val($(this).find('a').html());
	
});


$('.dropdown-toggle').dropdown();
$('#names li').on('click', function() {
    $('#nameButton').html($(this).find('a').html() + "   <span class='caret'></span>");
	$("#nameHidden").val($(this).find('a').html());
	
});
