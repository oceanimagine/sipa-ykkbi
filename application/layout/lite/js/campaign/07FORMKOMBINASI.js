/* ---------------------------------------------------------------------- */
/* Form Kombinasi */

var divss = document.getElementById("isikombinasi");
var htmld = divss.innerHTML;
var htmls = divss.innerHTML;
var htmlt = "";
var cmbns = [];
var vldts = [];
var jmcmb = 0;
var addvd = 0;

function createCombine(nums) {
    var conct = "";
    var btnss =
            '<div class="form-group">' +
            '<div class="col-sm-offset-2 col-sm-10">' +
            '<button id="createCombine" type="button" class="btn btn-default" style="width: 100%;">Create Package</button>' +
            '</div>' +
            '</div>';
    htmls = (htmlt === "") ? htmls : htmlt;
    divss.innerHTML = "";
    /*
    console.log("Inside createCombine");
    console.log(htmls);
    console.log("\n"); */
    for (var i = 0; i < nums; i++) {
        var htmld = htmls.replace(/COMBS/g, " ke " + (i + 1));
        var htmlc = htmld.replace(/IDCOMBD/g, (i + 1));
        conct = conct + htmlc;
    }
    divss.innerHTML = conct + btnss;
    $(".selectpackage").select2();
    combinehandler(nums);
    changeCombine(nums);
}

function changeCombine(nums) {
    jmcmb = nums;
    for (var i = 0; i < nums; i++) {
        var cm = document.getElementById("paketcombine" + (i + 1));
        cm.counter = i;
        $("#paketcombine" + (i + 1)).change(function () {
            var sprtor = "";
            cmbns[this.counter] = $(this).val();
            if (typeof setpaketnm !== "undefined") {
                strcombine = "";
                for (var i = 0; i < setpaketnm.length; i++) {
                    for (var j = 0; j < jmcmb; j++) {
                        if (setpaketnm[i] === $("#paketcombine" + (j + 1)).val()) {
                            vldts[addvd] = $("#paketcombine" + (j + 1)).val();
                            addvd++;
                        }
                    }
                }
                for (var i = 0; i < vldts.length; i++) {
                    strcombine = strcombine + sprtor + vldts[i];
                    sprtor = "-";
                }
                /*
                 console.log(setpaketnm);
                 console.log(strcombine);
                 console.log(jmcmb); */
                vldts = [];
                addvd = 0;
            }
        });
    }
}

function combinehandler(nums) {
    $('#createCombine').click(function () {
        var runns = 0;
        /* console.log(nums); */
        for (var i = 0; i < nums; i++) {
            /* console.log(i); */
            /* console.log($("#paketcombine" + (i + 1)).val()); */
            if ($("#paketcombine" + (i + 1)).val() === "") {
                document.location = url_samamodal();
                document.getElementById("Alertnya").innerHTML = "Pastikan semua paket sudah dipilih.";
                break;
            }
            var samain = 0;
            for (var j = 0; j < nums; j++) {
                if ((j + 1) !== (i + 1)) {
                    if ($("#paketcombine" + (j + 1)).val() === $("#paketcombine" + (i + 1)).val()) {
                        document.location = url_samamodal();
                        document.getElementById("Alertnya").innerHTML = "Paket tidak boleh sama.";
                        samain = 1;
                        break;
                    }
                }
            }
            if (samain === 1) {
                break;
            }
            runns = 1;
        }
        if (runns === 1) {
            kombinasipaket();
        }
    });
}