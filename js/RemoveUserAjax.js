$(document).ready(function () {
	$("button.ezabatu").click(function () {
		if (confirm('Ziur al zaude?')) {
			var td = $(this).parent();
			var email = td.siblings().first().text();

			$.ajax({
				url: "../php/RemoveUser.php?email=" + email,
				cache: false,
				success: function (result) {
					td.parent().remove();
				}
			});
		}
	});
});