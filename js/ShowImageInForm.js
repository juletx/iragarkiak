$(document).ready(function(){
    $('#argazkiaa').change(function() {
        readURL(this);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#argazki').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).on("click", "input[type='reset']", function(){
            $('#argazki').attr('src', '#');
    });    
});    