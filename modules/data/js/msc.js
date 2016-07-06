
function testscript(filter_name){
    $("#MnozstvoSkladomFilter_stav").val(''+filter_name)
    $('form').submit();
}
/*
$(document).ready(function() {
    var filter_name = window.location.match('');
});
*/
