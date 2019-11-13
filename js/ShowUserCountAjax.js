$(document).ready(function () {
	console.log("ready");
	$.get("IncreaseGlobalCounter.php");

	showUserCount();
	setInterval(showUserCount, 5000);

	function showUserCount() {
		$.get('../xml/Counter.xml', function (d) {
			var counter = $(d).find("counter").text();
			$("#erabiltzaileKop").html("<h2>Erabiltzaile kopurua</h2><p>Galderak kudeatzen ari diren erabiltzaile kopurua: " + counter + "</p>");
		});
	}

	$(window).on("unload", function () {
		console.log("unload");
		$.get("DecreaseGlobalCounter.php");
	});
});