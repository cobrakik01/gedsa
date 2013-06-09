// JavaScript Document
$(document).ready(function(e) {
	var visible = false;
	
    $("#displayMoreOptions").click(function(e) {
		e.preventDefault();
		$("#more-options").delay(100).stop(true).toggle("slow");
    });
	
});
