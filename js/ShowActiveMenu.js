$(document).ready(function () {
	$("navbar-nav .nav-link").on("click", function () {
		$("navbar-nav").find(".active").removeClass("active");
		$(this).addClass("active");
	});
});