$(document).ready(function () {
	$("button.aldatu").click(function () {
		var td = $(this).parent();
		var email = td.siblings().first().text();

		$.ajax({
			url: "../php/ChangeState.php?email=" + email,
			cache: false,
			success: function (result) {
				td.prev().html(result);
			},
		});
	});
});