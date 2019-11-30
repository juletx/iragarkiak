$(document).ready(function () {
	$('#password1').on('change input', function () {
		var pasahitza = $("#password1").val();
		$.get('../php/ClientVerifyPass.php', { 'pasahitza': pasahitza }, function (d) {
			if (d === "Pasahitz balioduna") {
				$("#baliozkoa").css('color', 'green');
				$("#submit").prop('disabled', false);
			} else {
				$("#baliozkoa").css('color', 'red');
                $("#submit").prop('disabled', true);
            }
			$("#baliozkoa").html(d);
		});
	});

	$("input[type='reset']").click(function() {
		$("#baliozkoa").html("");
	});
});
