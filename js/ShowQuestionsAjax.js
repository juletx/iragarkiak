$(document).ready(function() {
	$("#ikusi").click(function() {
		if ($("#taula").is(":hidden")) {
			var jqxhr = $.get("../php/ShowXmlQuestions.php", function(datuak){
				$('#taula').append($(datuak).find("table"));
				$('#taula').show();
			});

			jqxhr.fail(function(){
				$('#feedback').html('<p>Zerbitzariak ez duela erantzuten dirudi</p>');
			});
		}
		else {
			$('table').remove();
			$('#taula').hide();
		}	
	});
});