/* ---------------------------------------------------------------------- */
/* Step by Step button */

$("#step-1Button").click(function () {
    if ($("#namacampaign").val() !== "" && $("#periodecampaign").val() !== "") {
        var chanl = document.getElementById("channeldiv");
        var arean = document.getElementById("areaawal");
        var brand = document.getElementById("branddiv");
        var ktgri = document.getElementById("kategoridiv");
        var butt3 = document.getElementById("button_step-3");
        var butt4 = document.getElementById("button_step-4");
        var lbl01 = document.getElementById("tipeLabel");
        var lbl02 = document.getElementById("nextLabel");
        var lbl03 = document.getElementById("formlabelButton");
        chanl.style.display = "block";
        arean.style.display = "block";
        brand.style.display = "block";
        ktgri.style.display = "block";
        butt3.style.display = "block";
        butt4.style.display = "block";
        lbl01.style.display = "block";
        lbl02.style.display = "block";
        lbl03.style.display = "block";
        $("#step-2").slideDown("slow");
        channledit = "";
        areassedit = "";
        brandsedit = "";
        ktgoriedit = "";
        channinner = "";
        areasinner = "";
        brandinner = "";
        ktgorinner = "";
        edithidden = "";
        mandatorys = "";
        paramedits = "";
        mdtrhidden = "";
        changedble = "";
        if(typeof temporartd === "object"){
            temporartd.removeAttribute("style");
            temporartd = "";
        }
        for (var i = 0; i < paramarr.length; i++) {
            if(document.getElementById(paramarr[i] + "_buttonDiv")){
                var tombolNext = document.getElementById(paramarr[i] + "_buttonDiv");
                tombolNext.style.display = "block";
            }
        }
    } else {
        document.location = url_samamodal();
        document.getElementById("Alertnya").innerHTML = "Anda belum menentukan nama Campaign Promo dan Periode Campaign.";
    }
});

$("#step-2Button").click(function () {
    if (paramprm > 0 && paramadd > 0) {
        $("#step-3").slideDown("slow");
    } else {
        document.location = url_samamodal();
        document.getElementById("Alertnya").innerHTML = "Anda belum memilih Tipe Promo dan Parameter Promo.";
    }
    checkstep = 1;
});

$("#step-3Button").click(function () {
    if (typeof channtrr !== "undefined" && channtrr.length > 0 && channadd > 0) {
        $("#step-4").slideDown("slow");
    } else {
        document.location = url_samamodal();
        document.getElementById("Alertnya").innerHTML = "Anda belum memilih Channel atau Area.";
    }
});