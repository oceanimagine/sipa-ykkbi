/* ---------------------------------------------------------------------- */
/* Form Campaign03 */

var checkf = 0;
var chnnll = [];
var chnrsl = "";
var areasl = "";
var gbngsl = "";

function getchannel() {
    var returnarr = [];
    var returnadd = 0;
    for (var i = 0; i < channarr.length; i++) {
        if ($('#' + channarr[i]).is(':checked')) {
            returnarr[returnadd] = channarr[i];
            returnadd++;
        }
    }
    return returnarr;
}

function editchannel(){
    if(typeof channledit === "object"){
        /* console.log(channledit); */
        var isian = channledit.getElementsByTagName("isian");
        if(isian[0]){
            isian[0].parentNode.removeChild(isian[0]);
        }
        if(channinner === ""){
            channinner = channledit.innerHTML;
        }
        channledit.innerHTML = "<isian>" + getList(getchannel()) + "</isian>" + channinner;
        /*
        console.log(channledit.innerHTML);
        console.log("\n"); */
        if(typeof edithidden === "object") {
            edithidden.value = gethidden(getchannel());
        }
        if(addrsetpkt > 1){
            ubahbarisBaseParameter();
        }
    }
}

$("#allchannel").on('ifChecked', function () {
    for (var i = 0; i < channarr.length; i++) {
        $('#' + channarr[i]).iCheck('check');
        var elmnvl = document.getElementById(channarr[i]);
        var grupid = elmnvl.getAttribute("grupid").replace(/,/g, "-");
        chnnll[grupid] = true;
    }
    channadd = channarr.length;
    checkf = 0;
    channelValue();
    editchannel();
    channelAreaValue();
    if(rfrshprgss === 0){
        ajaxCustomer();
    }
});

$("#allchannel").on('ifUnchecked', function () {
    if (checkf === 0) {
        for (var i = 0; i < channarr.length; i++) {
            $('#' + channarr[i]).iCheck('uncheck');
            var elmnvl = document.getElementById(channarr[i]);
            var grupid = elmnvl.getAttribute("grupid").replace(/,/g, "-");
            if(typeof chnnll[grupid] !== "undefined"){
                delete chnnll[grupid];
            }
        }
        channadd = 0;
    }
    channelValue();
    editchannel();
    channelAreaValue();
    if(rfrshprgss === 0){
        ajaxCustomer();
    }
});


for (var i = 0; i < channarr.length; i++) {
    $('#' + channarr[i]).on('ifUnchecked', function () {
        checkf = 1;
        channadd--;
        $('#allchannel').iCheck('uncheck');
        var grupid = this.getAttribute("grupid").replace(/,/g, "-");
        if(typeof chnnll[grupid] !== "undefined"){
            delete chnnll[grupid];
        }
        channelValue();
        editchannel();
        channelAreaValue();
        if(rfrshprgss === 0){
            ajaxCustomer();
        }
    });
    $('#' + channarr[i]).on('ifChecked', function () {
        checkf = 1;
        channadd++;
        if(channadd === channarr.length){
            $('#allchannel').iCheck('check');
        }
        var grupid = this.getAttribute("grupid").replace(/,/g, "-");
        chnnll[grupid] = true;
        channelValue();
        editchannel();
        channelAreaValue();
        if(rfrshprgss === 0){
            ajaxCustomer();
        }
    });
}

function channelValue() {
    var strp = "";
    chnrsl = "";
    for (var key in chnnll) {
        chnrsl = chnrsl + strp + key;
        strp = "-";
    }
    /* console.log(chnrsl); */
}

function areaValue() {
    var strp = "";
    areasl = "";
    for (var i = 0; i < channtrr.length; i++) {
        areasl = areasl + strp + channtrr[i];
        strp = "-";
    }
    /* console.log(areasl); */
}

function channelAreaValue() {
    gbngsl = chnrsl + "+" + areasl;
}

function getarea() {
    return channtrr;
}

function editarea(){
    if(typeof areassedit === "object"){
        /* console.log(areassedit); */
        var isian = areassedit.getElementsByTagName("isian");
        if(isian[0]){
            isian[0].parentNode.removeChild(isian[0]);
        }
        if(areasinner === ""){
            areasinner = areassedit.innerHTML;
        }
        areassedit.innerHTML = "<isian>" + getList(getarea(),"piliharea") + "</isian>" + areasinner;
        /*
        console.log(areassedit.innerHTML);
        console.log("\n"); */
        if(typeof edithidden === "object") {
            edithidden.value = gethidden(getarea());
        }
        if(addrsetpkt > 1){
            ubahbarisBaseParameter();
        }
    }
}

$("#piliharea").change(function () {
    if (typeof counters !== "undefined" && typeof idselect !== "undefined") {
        /* console.log("Test Change"); */
        var nmselect = {};
        var dtcta = 0;
        var rmvsl = 0;
        var valss = $(this).val();
        if(typeof channtrr === "object"){
            /* console.log(channtrr); */
            if(channtrr.length === (this.options.length - 1)) {
                dtcta = 1;
            }
        }
        channtrr = (valss !== null) ? valss : [];
        var allss = 0;
        if (valss) {
            for (var i = 0; i < valss.length; i++) {
                nmselect[valss[i]] = true;
                if(dtcta === 1){
                    rmvsl = 1;
                }
                if (valss[i] === "All") {
                    allss = 1;
                    rmvsl = 0;
                }
            }
        }
        if (allss || (channtrr.length === (this.options.length - 1))) {
            setidforselect("piliharea");
            selectall("areaawal");
            /* console.log("Pilih Semua"); */
        }
        if(rmvsl === 1){
            setidforselect("piliharea");
            removeSelect("step-3", "Pilih Area");
        }
        areaValue();
        editarea();
        channelAreaValue();
        if(rfrshprgss === 0){
            ajaxCustomer();
        }
    }
});