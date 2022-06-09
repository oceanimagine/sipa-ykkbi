/* ---------------------------------------------------------------------- */
/* Call Submit */

$('#packagelistButton').click(function () {
    for (var i = 0; i < paramarr.length; i++) {
        $("#step-Package" + paramarr[i] + (i + 1)).slideUp("slow");
    }
    $("#formsubmit").slideDown("slow");
    $("#formlabel").slideUp("slow");
    $("#formreward").slideUp("slow");
});