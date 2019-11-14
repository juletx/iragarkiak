$(document).ready(function() {
    $('#argazkiaa').change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#argazki').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
	});

	$("input[type='reset']").click(function() {
		$('#argazki').attr('src', '#');
	});
});