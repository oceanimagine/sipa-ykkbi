/* ---------------------------------------------------------------------- */
/* Form Campaign01 */

$("#namacampaign").change(function () {
    var inputaw = "";
    var inputak = "";
    if ($("#periodecampaign").val() !== "") {
        var periode = $("#periodecampaign").val();
        var periodt = periode.split(" - ");
        var prdawal = periodt[0].split("/");
        var prdakhr = periodt[1].split("/");
        inputaw = "<input type='hidden' name='periodeawal' value='" + prdawal[2] + "-" + prdawal[0] + "-" + prdawal[1] + "' />";
        inputak = "<input type='hidden' name='periodeakhir' value='" + prdakhr[2] + "-" + prdakhr[0] + "-" + prdakhr[1] + "' />";
    }

    tampungcmp.innerHTML = (
            "<input type='hidden' name='namacampaign' value='" + $(this).val() + "' />" + inputaw + inputak
            );
});

$("#periodecampaign").change(function () {
    var periode = $("#periodecampaign").val();
    var periodt = periode.split(" - ");
    var prdawal = periodt[0].split("/");
    var prdakhr = periodt[1].split("/");

    tampungcmp.innerHTML = (
            "<input type='hidden' name='namacampaign' value='" + $("#namacampaign").val() + "' />" +
            "<input type='hidden' name='periodeawal' value='" + prdawal[2] + "-" + prdawal[0] + "-" + prdawal[1] + "' />" +
            "<input type='hidden' name='periodeakhir' value='" + prdakhr[2] + "-" + prdakhr[0] + "-" + prdakhr[1] + "' />"
            );
});