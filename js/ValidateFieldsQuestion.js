  
$(document).ready(function(){
    $("#galderenF").submit(function(){
        if (checkRequired() && checkEposta() && checkGaldera()) {
            return true;
        } else {
            return false;
        }

        function checkRequired() {
            var empty = true;
            $('input[type="text"]').each(function () {
                if ($(this).val() == "") {
                    alert("Bete eremu guztiak");
                    empty = false;
                    return empty;
                }
            })
            return empty;
        }

        function checkEposta() {
            var eposta = $("#eposta").val();
            var epostaikasle = /[a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s/;
            var epostairakasle = /[a-z]+\.?[a-z]{2,}@ehu.eu?s/;
            if ((eposta.match(epostaikasle) == eposta) || (eposta.match(epostairakasle) == eposta))
                return true;
            alert("Posta elektronikoa ez da zuzena");
            return false;
        }

        function checkGaldera() {
            var galdera = $('#galdera').val();
            if (galdera.length < 10) {
                alert("Galderak gutxienez 10 karaktere izan behar ditu");
                return false;
            }
            return true;
        }
    });
});
