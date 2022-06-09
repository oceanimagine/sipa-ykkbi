/* ---------------------------------------------------------------------- */
/* Form Campaign04 */

var checkd = 0;
var brndll = [];
var ctgrll = [];
var brndsl = "";
var ctgrsl = "";
var gbncsl = "";

function brandValue() {
    var strp = "";
    brndsl = "";
    for (var key in brndll) {
        brndsl = brndsl + strp + key;
        strp = "-";
    }
    /* console.log(brndsl); */
}

function categoryValue() {
    var strp = "";
    ctgrsl = "";
    for (var key in ctgrll) {
        ctgrsl = ctgrsl + strp + key;
        strp = "-";
    }
    /* console.log(areasl); */
}

function brandCategoryValue() {
    gbncsl = brndsl + "+" + ctgrsl;
}

function getbrand() {
    var returnarr = [];
    var returnadd = 0;
    for (var i = 0; i < brandarr.length; i++) {
        if ($('#' + brandarr[i]).is(':checked')) {
            returnarr[returnadd] = brandarr[i];
            returnadd++;
        }
    }
    return returnarr;
}

function editbrand(){
    if(typeof brandsedit === "object"){
        /* console.log(brandsedit); */
        var isian = brandsedit.getElementsByTagName("isian");
        if(isian[0]){
            isian[0].parentNode.removeChild(isian[0]);
        }
        if(brandinner === ""){
            brandinner = brandsedit.innerHTML;
        }
        brandsedit.innerHTML = "<isian>" + getList(getbrand()) + "</isian>" + brandinner;
        /*
        console.log(brandsedit.innerHTML);
        console.log("\n"); */
        if(typeof edithidden === "object") {
            edithidden.value = gethidden(getbrand());
        }
        if(addrsetpkt > 1){
            ubahbarisBaseParameter();
        }
    }
}

$("#allbrand").on('ifChecked', function () {
    for (var i = 0; i < brandarr.length; i++) {
        $('#' + brandarr[i]).iCheck('check');
        var elmnvl = document.getElementById(brandarr[i]);
        var grupid = elmnvl.getAttribute("grupid").replace(/,/g, "-");
        brndll[grupid] = true;
    }
    brandadd = brandarr.length;
    checkd = 0;
    editbrand();
    brandValue();
    brandCategoryValue();
    if(rfrshprgss === 0){
        ajaxProduk();
    }
});

$("#allbrand").on('ifUnchecked', function () {
    if (checkd === 0) {
        for (var i = 0; i < brandarr.length; i++) {
            $('#' + brandarr[i]).iCheck('uncheck');
            var elmnvl = document.getElementById(brandarr[i]);
            var grupid = elmnvl.getAttribute("grupid").replace(/,/g, "-");
            if(typeof brndll[grupid] !== "undefined"){
                delete brndll[grupid];
            }
        }
        brandadd = 0;
    }
    editbrand();
    brandValue();
    brandCategoryValue();
    if(rfrshprgss === 0){
        ajaxProduk();
    }
});

for (var i = 0; i < brandarr.length; i++) {
    $('#' + brandarr[i]).on('ifUnchecked', function () {
        checkd = 1;
        $('#allbrand').iCheck('uncheck');
        var grupid = this.getAttribute("grupid").replace(/,/g, "-");
        if(typeof brndll[grupid] !== "undefined"){
            delete brndll[grupid];
        }
        brandadd--;
        editbrand();
        brandValue();
        brandCategoryValue();
        if(rfrshprgss === 0){
            ajaxProduk();
        }
    });
    $('#' + brandarr[i]).on('ifChecked', function () {
        brandadd++;
        if(brandadd === brandarr.length){
            $('#allbrand').iCheck('check');
        }
        var grupid = this.getAttribute("grupid").replace(/,/g, "-");
        brndll[grupid] = true;
        editbrand();
        brandValue();
        brandCategoryValue();
        if(rfrshprgss === 0){
            ajaxProduk();
        }
    });
}

var checks = 0;

function getkategori() {
    var returnarr = [];
    var returnadd = 0;
    for (var i = 0; i < ktgriarr.length; i++) {
        if ($('#' + ktgriarr[i]).is(':checked')) {
            returnarr[returnadd] = ktgriarr[i];
            returnadd++;
        }
    }
    return returnarr;
}

function editkategori(){
    if(typeof ktgoriedit === "object"){
        /* console.log(ktgoriedit); */
        var isian = ktgoriedit.getElementsByTagName("isian");
        if(isian[0]){
            isian[0].parentNode.removeChild(isian[0]);
        }
        if(ktgorinner === ""){
            ktgorinner = ktgoriedit.innerHTML;
        }
        ktgoriedit.innerHTML = "<isian>" + getList(getkategori()) + "</isian>" + ktgorinner;
        /*
        console.log(ktgoriedit.innerHTML);
        console.log("\n"); */
        if(typeof edithidden === "object") {
            edithidden.value = gethidden(getkategori());
        }
        if(addrsetpkt > 1){
            ubahbarisBaseParameter();
        }
    }
}

$("#allkategori").on('ifChecked', function () {
    for (var i = 0; i < ktgriarr.length; i++) {
        $('#' + ktgriarr[i]).iCheck('check');
        var elmnvl = document.getElementById(ktgriarr[i]);
        var grupid = elmnvl.getAttribute("grupid").replace(/,/g, "-");
        ctgrll[grupid] = true;
    }
    ktgriadd = ktgriarr.length;
    checks = 0;
    editkategori();
    categoryValue();
    brandCategoryValue();
    if(rfrshprgss === 0){
        ajaxProduk();
    }
});

$("#allkategori").on('ifUnchecked', function () {
    if (checks === 0) {
        for (var i = 0; i < ktgriarr.length; i++) {
            $('#' + ktgriarr[i]).iCheck('uncheck');
            var elmnvl = document.getElementById(ktgriarr[i]);
            var grupid = elmnvl.getAttribute("grupid").replace(/,/g, "-");
            if(typeof ctgrll[grupid] !== "undefined"){
                delete ctgrll[grupid];
            }
        }
        ktgriadd = 0;
        editkategori();
        categoryValue();
        brandCategoryValue();
        if(rfrshprgss === 0){
            ajaxProduk();
        }
    }
});

for (var i = 0; i < ktgriarr.length; i++) {
    $('#' + ktgriarr[i]).on('ifUnchecked', function () {
        checks = 1;
        $('#allkategori').iCheck('uncheck');
        var grupid = this.getAttribute("grupid").replace(/,/g, "-");
        if(typeof ctgrll[grupid] !== "undefined"){
            delete ctgrll[grupid];
        }
        ktgriadd--;
        editkategori();
        categoryValue();
        brandCategoryValue();
        if(rfrshprgss === 0){
            ajaxProduk();
        }
    });
    $('#' + ktgriarr[i]).on('ifChecked', function () {
        ktgriadd++;
        if(ktgriadd === ktgriarr.length){
            $('#allkategori').iCheck('check');
        }
        var grupid = this.getAttribute("grupid").replace(/,/g, "-");
        ctgrll[grupid] = true;
        editkategori();
        categoryValue();
        brandCategoryValue();
        if(rfrshprgss === 0){
            ajaxProduk();
        }
    });
}