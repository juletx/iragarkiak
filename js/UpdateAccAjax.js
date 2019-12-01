$(document).ready(function () {
	$("#gorde").click(function () {
		var form = $("#eguneratu").get(0);
		$.ajax({
			url: '../php/SaveChanges.php',
			type: 'POST',
			data: new FormData(form),
			mimeType: 'multipart/form-data',
			contentType: false,
			processData: false,
			dataType: 'HTML',
			success: function (data) {
				console.log(data);
				if (!$("#alerta").is(":hidden")) {
					$("#alerta").show();
				}
				$("#alerta").html(data);
			},
			error: function (data) {
				if (!$("#alerta").is(":hidden")) {
					$("#alerta").show();
				}
				$("#alerta").html(data);
			}
		});
	});
});