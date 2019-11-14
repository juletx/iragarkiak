$(document).ready(showQuestionCount()); 
	function showQuestionCount() {
    $('#galderaKop').html('<div><img class="argazkia" src="../images/Loading.gif"/></div>');
    $.get('../xml/Questions.xml', function (d) {
        var galderak = $(d).find("assessmentItem");
        var totalak = galderak.length;
        var nireak = 0;
        var eposta = $("#eposta").val();
        galderak.each(function () {
            if (eposta === $(this).attr("author")) {
                nireak++;
            }
        });
        $("#galderaKop").fadeIn(1000).html("<h2>Galdera kopurua</h2><p>Zure galderak / Galdera totalak: " + nireak + " / " + totalak + "</p>");
    });
}