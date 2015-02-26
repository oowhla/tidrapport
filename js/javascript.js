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


$("body").on("change", ".names", function () {
	$('#allNames').prop("checked", false);
});

$("body").on("change", "#allNames", function () {
	$('.names').prop("checked", false);
});

$("body").on("change", ".activities", function () {
	$('#allActivities').prop("checked", false);
});

$("body").on("change", "#allActivities", function () {
	$('.activities').prop("checked", false);
});

$("body").on("change", ".weeks", function () {
	$('#allWeeks').prop("checked", false);
});

$("body").on("change", "#allWeeks", function () {
	$('.weeks').prop("checked", false);
});