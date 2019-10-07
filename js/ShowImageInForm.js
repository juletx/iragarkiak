function showImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#argazki').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function hideImage() {
    $('#argazki').attr('src', '#');
}