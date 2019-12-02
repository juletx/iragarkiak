$(document).ready(function () {
	var location = window.location.href;
	if (location.indexOf("ManageAccount.php") > - 1) {
		$(".dropdown-toggle").addClass('active');
	}
	else {
		$('.navbar-nav .nav-link').each(function(){
			if(location.indexOf(this.href) > - 1) {
				$(this).addClass('active');
			}
		});
	}
});