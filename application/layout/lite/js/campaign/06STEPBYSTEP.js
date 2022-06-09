/* ---------------------------------------------------------------------- */
/* Definisi Form Step by Step parameter */

var begins = 0;

function define_step_by_step_promo_parameter() {
    var alamatsobjs = 0;
    var alamatsaddr = 0;
    var alamatsunbn = 0;
    var alamatsadbn = 0;
    var tampungobjs = [];
    var tampungaddr = [];
    var tampungunbn = [];
    var tampungadbn = [];

    for (var i = 0; i < paramarr.length; i++) {
        if ($('#' + paramarr[i]).is(':checked')) {
            tampungobjs[alamatsobjs] = paramarr[i];
            tampungaddr[alamatsaddr] = (i + 1);
            alamatsobjs++;
            alamatsaddr++;
        } else {
            tampungunbn[alamatsunbn] = paramarr[i];
            tampungadbn[alamatsadbn] = (i + 1);
            alamatsunbn++;
            alamatsadbn++;
        }
    }

    $('#createpackage').unbind("click");
    $("#BeginPackage").unbind("click");
    $("#formlabelButton").unbind("click");
    $("#BeginPackage").click(function () {
        if (ktgriadd > 0 && brandadd > 0) {
            $("#formsubmit").slideUp("slow");
            $("#formreward").slideUp("slow");
            $("#formlabel").slideDown("slow");
        } else {
            document.location = url_samamodal();
            document.getElementById("Alertnya").innerHTML = "Anda belum memilih Brand atau Kategori.";
        }
    });

    var btnn = document.getElementById("formlabelButton");
    btnn.name = "#step-Package" + tampungobjs[0] + tampungaddr[0];
    $("#formlabelButton").click(function () {
        if ($("#inputpaket").val() !== "" && $("#tipepaket").val() !== "") {
            if ($("#tipepaket").val() === "Single") {
                $(this.name).slideDown("slow");
                $("#formkombinasi").slideUp("slow");
                divss.innerHTML = htmld;
                begins = 1;
            }
            if ($("#tipepaket").val() === "Double") {
                createCombine(2);
                $("#formkombinasi").slideUp("slow");
                $("#formkombinasi").slideDown("slow");
                for (var i = 0; i < paramarr.length; i++) {
                    $("#step-Package" + paramarr[i] + (i + 1)).slideUp("slow");
                }
            }
            if ($("#tipepaket").val() === "Triple") {
                createCombine(3);
                $("#formkombinasi").slideUp("slow");
                $("#formkombinasi").slideDown("slow");
                for (var i = 0; i < paramarr.length; i++) {
                    $("#step-Package" + paramarr[i] + (i + 1)).slideUp("slow");
                }
            }
        } else {
            document.location = url_samamodal();
            document.getElementById("Alertnya").innerHTML = "Anda belum menentukan Nama Paket atau Tipe Paket.";
        }
    });

    var namaobjs = tampungobjs[(tampungobjs.length - 1)] + tampungaddr[(tampungaddr.length - 1)] + "Button";
    var clssobjs = $("#" + namaobjs).attr("class");
    $("#" + namaobjs).attr("bariske", "1");
    $("#" + namaobjs).html("Create Package");
    $("#" + namaobjs).attr("class", clssobjs + " " + namaobjs);
    $("#" + namaobjs).attr("id", "createpackage");

    for (var i = 0; i < tampungobjs.length - 1; i++) {
        var nama = tampungobjs[i] + tampungaddr[i] + "Button";
        $("." + nama).unbind("click");
        $("." + nama).attr("id", nama);
        $("." + nama).html("Next");
        var objd = document.getElementById(tampungobjs[i] + tampungaddr[i] + "Button");
        objd.nama = "#step-Package" + tampungobjs[(i + 1)] + tampungaddr[(i + 1)];
        $("#" + nama).click(function () {
            $(this.nama).slideDown("slow");
        });
        if (begins === 1) {
            $("#step-Package" + tampungobjs[i] + tampungaddr[i]).slideDown("slow");
        }
    }

    packageHandler();

    for (var i = 0; i < tampungunbn.length; i++) {
        $("#" + tampungunbn[i] + tampungadbn[i] + "Button").unbind("click");
        $("#step-Package" + tampungunbn[i] + tampungadbn[i]).slideUp("slow");
    }
}