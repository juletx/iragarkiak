$(document).ready(function() {
	$("#botoia").click(function() {
		var eposta = $("#eposta").val();
		$.get('../xml/Users.xml', function(d) {
			var aurkitua = false;
			$(d).find("erabiltzailea").each(function () {
				if (eposta == $(this).find("eposta").text()) {
					var telefonoa = $(this).find("telefonoa").text();
					var izena = $(this).find("izena").text();
					var abizena1 = $(this).find("abizena1").text();
					var abizena2 = $(this).find("abizena2").text();
					$("#telefonoa").val(telefonoa);
					$("#izena").val(izena);
					$("#abizenak").val(abizena1 + " " + abizena2);
					aurkitua = true;
					return false;
				}
			});
			if (!aurkitua){
				alert("Ez dago eposta hori duen ikaslerik. Saiatu berriz.");
			}
		});
    });
});