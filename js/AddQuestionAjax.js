function galderaGehitu() {
	var form = $("#galderenF").get(0);
	$.ajax({
		url: '../php/AddQuestionWithImage.php',
		type: 'POST',
		data: new FormData(form),
		mimeType: 'multipart/form-data',
		contentType: false,
		processData: false,
		dataType: 'HTML',
		success: function (data) {
			$("#feedback").html(data);
            showQuestionCount();
            galderakIkusi();
		},
		error: function (data) {
			$("#feedback").html("Ezin izan da galdera sartu.");
		}
	});
}