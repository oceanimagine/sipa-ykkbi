/* ---------------------------------------------------------------------*/
/* Script tambahan untuk Datatable */

function addition() {
    var divss = document.getElementsByTagName("div");
    var table = document.getElementsByTagName("table");
    for (var i = 0; i < divss.length; i++) {
        if (divss[i].getAttribute("class") === "dataTables_scrollHead") {
            divss[i].style.width = "96.5%";
        }
        if (divss[i].getAttribute("class") === "dataTables_scrollHeadInner") {
            divss[i].style.width = "100%";
        }
        if (divss[i].getAttribute("class") === "dataTables_wrapper form-inline dt-bootstrap no-footer") {
            var divna = divss[i].getElementsByTagName("div");
            var count = 0;
            for (var j = 0; j < divna.length; j++) {
                if (divna[j].getAttribute("class") === "row") {
                    count++;
                    if (count === 3) {
                        divna[j].getElementsByTagName("div")[0].setAttribute("class", "col-sm-2");
                        divna[j].getElementsByTagName("div")[1].setAttribute("class", "col-sm-8");
                        divna[j].getElementsByTagName("div")[1].style.width = "100%";
                    }
                }
            }
        }
        if (divss[i].getAttribute("class") === "dataTables_scrollBody") {
            divss[i].style.overflowY = "scroll";
            divss[i].style.overflowX = "auto";
        }
        if (divss[i].getAttribute("class") === "dataTables_paginate paging_simple_numbers") {
            divss[i].style.overflow = "auto";
            divss[i].style.width = "100%";
            var lili = document.getElementsByTagName("li");
            var wdth = 0;
            for (var j = 0; j < lili.length; j++) {
                if (lili[j].getAttribute("class") === "paginate_button active" ||
                        lili[j].getAttribute("class") === "paginate_button " ||
                        lili[j].getAttribute("class") === "paginate_button previous disabled" ||
                        lili[j].getAttribute("class") === "paginate_button disabled" ||
                        lili[j].getAttribute("class") === "paginate_button next" ||
                        lili[j].getAttribute("class") === "paginate_button previous" ||
                        lili[j].getAttribute("class") === "paginate_button next disabled") {
                    wdth = wdth + $('li:eq(' + j + ') > a').outerWidth(true);
                }
            }
            divss[i].getElementsByTagName("ul")[0].style.width = wdth + "px";
        }
    }
    for (var i = 0; i < table.length; i++) {
        if (table[i].getAttribute("class") === "table table-bordered table-hover no-footer dataTable") {
            var prnt01 = table[i].parentNode;
            var prnt02 = prnt01.parentNode;
            var prnt03 = prnt02.parentNode;
            if (prnt03.offsetWidth > table[i].offsetWidth) {
                table[i].style.width = "100%";
            }
        }
    }
}

function selecttr(objs, dftr, idtb) {
    if (dftr) {
        var table = document.getElementById(idtb);
        var trtr = table.getElementsByTagName("tr");
        var objd = objs.getElementsByTagName("td");
        var lngh = objd.length;

        for (var i = 0; i < trtr.length; i++) {
            var d = 0;
            var t = trtr[i].getElementsByTagName("td");
            for (var j = 1; j < t.length; j++) {
                if (t[j].innerHTML === objd[j].innerHTML) {
                    d++;
                }
            }
            if (d === (lngh - 1)) {
                $(trtr[i]).addClass('selected');
                $(trtr[i]).css("background-color", "rgba(0, 0, 0, 0.08)");
                break;
            }
        }
    }
}

/* ---------------------------------------------------------------------*/
/* Script tambahan untuk ajax customer dan produk */

function ajaxCustomer() {
    doajax("GET", url_get("processCustomer/"+gbngsl), "ID_Customer", false, "ID_Customer", false);
    /* console.log(url_get("processCustomer/"+gbngsl)); */
}

function ajaxProduk() {
    doajax("GET", url_get("processProduct/"+gbncsl), "ID_Produk", false, "ID_Produk", false);
    doajax("GET", url_get("processProduct/"+gbncsl), "ID_ProdukREWARD", false, "ID_ProdukREWARD", false);
}

if(typeof ajaxBuatCustomer !== "undefined"){
    gbngsl = ajaxBuatCustomer;
    ajaxCustomer();
}

if(typeof ajaxBuatProduct !== "undefined"){
    gbncsl = ajaxBuatProduct;
    ajaxProduk();
}

/* ---------------------------------------------------------------------*/
/* Script tambahan untuk Checkbox Element Multiselect */

var dataopsi = {};
function ifSpanExist() {
    var spans = document.getElementsByTagName("span");
    for (var i = 0; i < spans.length; i++) {
        if (spans[i].getAttribute("class") === "select2-container select2-container--default select2-container--open") {
            var ulul = spans[i].getElementsByTagName("ul");
            var idnm = ulul[0].getAttribute("id").split("-")[1];
            var elmn = document.getElementById(idnm);
            if (elmn.getAttribute("multiple") === "") {
                var lili = ulul[0].getElementsByTagName("li");
                var chck = lili[0].getElementsByTagName("input");
                if (chck.length === 0) {
                    var ulangin = 0;
                    var jmlhcnt = 0;
                    var allchck = 0;
                    if (lili.length <= 50) {
                        ulangin = lili.length;
                    } else {
                        ulangin = 50;
                    }
                    for (var j = 0; j < ulangin; j++) {
                        if(lili[j].getAttribute("id")) {
                            var valli = lili[j].getAttribute("id").split("-");
                            var texts = lili[j].innerText;
                            lili[j].innerHTML = "<input type='checkbox' value='" + valli[(valli.length - 1)] + "' jumlahnya='" + /* lili.length */ ulangin + "' texts='" + texts + "' class='additionCheck' id='additionCheckIdnya" + j + "' style='position: absolute; z-index: 9999;' />&nbsp;" + lili[j].innerHTML;
                        }
                    }
                    $('.additionCheck').iCheck({
                        checkboxClass: 'icheckbox_minimal-red',
                        radioClass: 'iradio_minimal-red'
                    });
                    for (var j = 0; j < ulangin; j++) {
                        if (lili[j].getAttribute("aria-selected") === "true") {
                            $("#additionCheckIdnya" + j).iCheck('check');
                            if(document.getElementById("additionCheckIdnya" + j).value !== "All"){
                                jmlhcnt++;
                            }
                        }
                        $("#additionCheckIdnya" + j).on('ifChecked', function () {
                            /* console.log(idnm); */
                            /* console.log(jmlhcnt); */
                            var parent01 = this.parentNode;
                            var parent02 = parent01.parentNode;
                            parent02.setAttribute("aria-selected", "true");
                            selectOption(idnm, this.value);
                            if (this.value === "All") {
                                var jmlhs = this.getAttribute("jumlahnya");
                                for (var i = 0; i < jmlhs; i++) {
                                    $("#additionCheckIdnya" + i).iCheck('check');
                                }
                            } else {
                                jmlhcnt++;
                                var jmlhd = this.getAttribute("jumlahnya");
                                /* console.log(jmlhcnt + " = " + (jmlhd - 1)); */
                                for (var i = 0; i < jmlhd; i++) {
                                    var ch = document.getElementById("additionCheckIdnya" + i);
                                    /* console.log(ch); */
                                    if(ch.value === "All" && jmlhcnt === jmlhd - 1){
                                        $("#additionCheckIdnya" + i).iCheck('check');
                                    }
                                }
                            }
                        });
                        $("#additionCheckIdnya" + j).on('ifUnchecked', function () {
                            var parent01 = this.parentNode;
                            var parent02 = parent01.parentNode;
                            parent02.setAttribute("aria-selected", "false");
                            unselectOption(idnm, this.getAttribute("texts"), this.value);
                            if (this.value === "All") {
                                var jmlhs = this.getAttribute("jumlahnya");
                                if(allchck === 0){
                                    for (var i = 0; i < jmlhs; i++) {
                                        $("#additionCheckIdnya" + i).iCheck('uncheck');
                                    }
                                }
                                allchck = 0;
                            } else {
                                jmlhcnt--;
                                var jmlhd = this.getAttribute("jumlahnya");
                                /* console.log(jmlhcnt + " = " + (jmlhd - 1)); */
                                for (var i = 0; i < jmlhd; i++) {
                                    var ch = document.getElementById("additionCheckIdnya" + i);
                                    /* console.log(ch); */
                                    if(ch.value === "All"){
                                        allchck = 1;
                                        $("#additionCheckIdnya" + i).iCheck('uncheck');
                                    }
                                }
                            }
                        });
                        var s = lili[j].getElementsByTagName("ins");
                        if(s[0]) {
                            s[0].style.zIndex = "9999";
                        }
                    }
                    while (lili[ulangin]) {
                        lili[ulangin].parentNode.removeChild(lili[ulangin]);
                    }
                }
            }
            break;
        }
    }
}

function checkString(param1, param2) {
    var reslt = false;
    for (var i = 0; i < param1.length; i++) {
        if (param1.substr(i, param2.length) === param2) {
            reslt = true;
            break;
        }
    }
    return reslt;
}

function unselectOption(idname, values, valued) {
    var lilA = "";
    var lilB = "";
    var slct = document.getElementById(idname);
    var opts = slct.options;
    var pr01 = slct.parentNode;
    var pr02 = pr01.parentNode;
    var spns = pr02.getElementsByTagName("span");
    for (var i = 0; i < spns.length; i++) {
        if (spns[i].getAttribute("class") === "select2-selection select2-selection--multiple") {
            lilA = spns[i].getElementsByTagName("ul");
            lilB = lilA[0].getElementsByTagName("li");
            break;
        }
    }
    for (var i = 0; i < lilB.length; i++) {
        if (checkString(lilB[i].innerHTML, values)) {
            /* console.log(lilB[i].innerHTML + " = " + values); */
            lilB[i].parentNode.removeChild(lilB[i]);
            break;
        }
    }
    for (var i = 0; i < opts.length; i++) {
        if (opts[i].value === valued) {
            $(opts[i]).prop("selected", false);
            break;
        }
    }
    if (idname === "piliharea") {
        channtrr = ($(slct).val() !== null) ? $(slct).val() : [];
        areaValue();
        editarea();
        channelAreaValue();
        if(rfrshprgss === 0){
            ajaxCustomer();
        }
    } else {
        if(idname === "produk" && document.getElementById("customer")){
            generateTable(document.getElementById(idname));
        }
        if (typeof slct.tampung !== "undefined") {
            slct.tampung = ($(slct).val() !== null) ? $(slct).val() : [];
            editParameter(slct.tampung,slct.getAttribute("id"));
        }
    }
}

function selectOption(idname, values) {
    var lilA = "";
    var lilB = "";
    var slct = document.getElementById(idname);
    var opts = slct.options;
    var pr01 = slct.parentNode;
    var pr02 = pr01.parentNode;
    var spns = pr02.getElementsByTagName("span");
    idselect = slct;
    for (var i = 0; i < spns.length; i++) {
        if (spns[i].getAttribute("class") === "select2-selection select2-selection--multiple") {
            lilA = spns[i].getElementsByTagName("ul");
            lilB = lilA[0].getElementsByTagName("li");
            break;
        }
    }
    for (var i = 0; i < opts.length; i++) {
        if (opts[i].value === values) {
            dataopsi = {
                id: $(opts[i]).val(),
                text: $(opts[i]).text(),
                disabled: $(opts[i]).prop('disabled'),
                selected: $(opts[i]).prop('selected'),
                title: $(opts[i]).prop('title')
            };
            $(opts[i]).prop("selected", "selected");
            var lichl = document.createElement("li");
            lichl.setAttribute("class", "select2-selection__choice");
            lichl.setAttribute("title", opts[i].text);
            lichl.innerHTML = "<span style=\"cursor: pointer;\" onclick=\"cobatest(this," + i + ",'" + opts[i].value + "','" + idname + "');\" class=\"select2-selection__choice__remove\" role=\"presentation\">×</span>" + opts[i].text;
            lilA[0].insertBefore(lichl, lilB[(lilB.length - 1)]);
            break;
        }
    }
    if (idname === "piliharea") {
        channtrr = remove_particular_element_array($(slct).val(),"All");
        areaValue();
        editarea();
        channelAreaValue();
        if(rfrshprgss === 0){
            ajaxCustomer();
        }
    } else {
        if(idname === "produk" && document.getElementById("customer")){
            generateTable(document.getElementById(idname));
        }
        if (typeof slct.tampung !== "undefined") {
            slct.tampung = $(slct).val();
            editParameter(slct.tampung,slct.getAttribute("id"));
        }
    }
}

setInterval(ifSpanExist, 100);

/* ---------------------------------------------------------------------*/
/* Script tambahan untuk Multiselect */

var counters = 0;
var channtrr = []; /* Variabel untuk Form Campaign 03 bagian area */
var idselect = "";
var idnamesl = "";

function setidforselect(idname) {
    if (document.getElementById(idname)) {
        counters = 0;
        idselect = document.getElementById(idname).options;
        idnamesl = idname;
    }
}

function removeSelect(idname, label) {
    var lilic = "";
    var lilid = "";
    var divss = document.getElementById(idname);
    var spans = divss.getElementsByTagName("span");
    for (var i = 0; i < idselect.length; i++) {
        $(idselect[i]).prop("selected", false);
    }
    for (var i = 0; i < spans.length; i++) {
        if (spans[i].getAttribute("class") === "select2-selection select2-selection--multiple") {
            lilic = spans[i].getElementsByTagName("ul");
            lilid = lilic[0].getElementsByTagName("li");
            break;
        }
    }
    var li_alamat0 = lilid[0];
    while (lilid[0]) {
        lilid[0].parentNode.removeChild(lilid[0]);
    }
    li_alamat0.setAttribute("class", "select2-search select2-search--inline");
    li_alamat0.innerHTML = '<input style="width: 884px;" placeholder="Pilih ' + label + '" class="select2-search__field" tabindex="-1" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" type="search" />';
    lilic[0].appendChild(li_alamat0);
    $("#" + idnamesl).select2('val', '');
    if(idname === "step-3"){
        /* console.log(channtrr); */
    }
}

function selectall(idname) {
    counters = 0;
    var lilic = "";
    var lilid = "";
    var divss = document.getElementById(idname);
    var spans = divss.getElementsByTagName("span");
    for (var i = 0; i < spans.length; i++) {
        if (spans[i].getAttribute("class") === "select2-selection select2-selection--multiple") {
            lilic = spans[i].getElementsByTagName("ul");
            lilid = lilic[0].getElementsByTagName("li");
            break;
        }
    }
    lilid[0].innerHTML = "<span style=\"cursor: pointer;\" onclick=\"cobatest(this,0,'All');\" class=\"select2-selection__choice__remove\" role=\"presentation\">×</span>All";
    $(idselect[0]).prop("selected", "selected");
    while (lilid[1]) {
        lilid[1].parentNode.removeChild(lilid[1]);
    }
    for (var i = 1; i < idselect.length; i++) {
        channtrr[(i - 1)] = idselect[i].value;
        $(idselect[i]).prop("selected", "selected");
        var lichl = document.createElement("li");
        lichl.setAttribute("class", "select2-selection__choice");
        lichl.setAttribute("title", idselect[i].value);
        lichl.innerHTML = "<span style=\"cursor: pointer;\" onclick=\"cobatest(this," + i + ",'" + idselect[i].value + "');\" class=\"select2-selection__choice__remove\" role=\"presentation\">×</span>" + idselect[i].text;
        lilic[0].insertBefore(lichl, lilid[0].nextSibling);
    }
}

function remove_particular_element_array(objs, vals) {
    var arrs = [];
    var addt = 0;
    var adds = 0;
    while (addt < objs.length) {
        if (objs[addt] !== vals) {
            arrs[adds] = objs[addt];
            adds++;
        }
        addt++;
    }
    return arrs;
}

function remove_last_element_array(objs) {
    var arrs = [];
    var addt = 0;
    while (addt < objs.length - 1) {
        arrs[addt] = objs[addt];
        addt++;
    }
    return arrs;
}

function cobatest(objs, addr, vals, idnm) {
    var rootli = objs.parentNode.parentNode;
    var getsli = rootli.getElementsByTagName("li");
    if (counters === 0) {
        rootli.removeChild(rootli.getElementsByTagName("li")[0]);
    }
    for(var i = 0; i < getsli.length; i++){
        if(getsli.innerText === "×All"){
            getsli[i].parentNode.removeChild(getsli[i]);
        }
    }
    if (objs.parentNode.parentNode) {
        objs.parentNode.parentNode.removeChild(objs.parentNode);
    }
    $(idselect[0]).prop("selected", false);
    $(idselect[addr]).prop("selected", false);
    if (typeof channtrr !== "undefined" && typeof channtrr === "object") {
        channtrr = remove_particular_element_array(channtrr, vals);
        if(vals === "All"){
            setidforselect("piliharea");
            removeSelect("step-3", "Pilih Area");
        }
    }
    if(typeof areaValue === "function"){
        areaValue();
        editarea();
        channelAreaValue();
    }
    if(typeof idnm !== "undefined" && idnm === "produk"){
        generateTable(document.getElementById(idnm));
    }
    if(typeof rfrshprgss !== "undefined" && rfrshprgss === 0){
        ajaxCustomer();
    }
    counters = 1;
}

/* ---------------------------------------------------------------------*/
/* Script tambahan untuk generate table */

function baseTable(idtable, idtbody, tampung, judulhead, paketTable, addressPaket) {
    var divsatu = document.createElement("div");
    var divawal = document.createElement("div");
    var divkdua = document.createElement("div");
    var divinsd = document.createElement("div");
    var divinst = document.createElement("div");
    divsatu.setAttribute("class", "form-group");
    divsatu.setAttribute("style", "margin-bottom: 0px; margin-top: 0px;");
    divawal.setAttribute("class", "col-lg-12 col-lg-12a");
    /* divawal.setAttribute("style", "bottom: -8px;"); */
    divkdua.setAttribute("class", "panel panel-success");
    divkdua.setAttribute("style", "overflow: hidden;");
    divinsd.setAttribute("class", "panel-heading");
    divinsd.setAttribute("style", "padding-bottom: 10px; overflow-x: auto; white-space: nowrap;");
    divinst.setAttribute("style", "overflow-x: auto; white-space: nowrap;");
    if(paketTable){
        divinst.setAttribute("id", "divPaketInside" + addressPaket);
        divinst.setAttribute("style", "display: none;");
    }
    var tablecr = document.createElement("table");
    var theadcr = document.createElement("thead");
    var trthead = document.createElement("tr");
    var ththed1 = document.createElement("th");
    var ththed2 = document.createElement("th");
    var ththed3 = document.createElement("th");
    var ththed4 = document.createElement("th");
    var ththed5 = document.createElement("th");
    var ththed6 = document.createElement("th");
    var tbodyth = document.createElement("tbody");
    ththed1.setAttribute("style", "vertical-align: middle; text-align: center;");
    ththed4.setAttribute("style", "vertical-align: middle; text-align: center;");
    ththed5.setAttribute("style", "vertical-align: middle; text-align: center;");
    ththed6.setAttribute("style", "vertical-align: middle; text-align: center;");
    ththed2.setAttribute("style", "vertical-align: middle; text-align: center;");
    ththed3.setAttribute("style", "vertical-align: middle; text-align: center;");
    ththed1.innerHTML = "Nama Produk";
    ththed4.innerHTML = "Harga";
    ththed5.innerHTML = "Stok Pusat";
    ththed6.innerHTML = "Stok Gudang";
    ththed2.innerHTML = "Jumlah Produk";
    ththed3.innerHTML = "Total Harga";
    divinsd.innerHTML = judulhead;
    trthead.appendChild(ththed1);
    trthead.appendChild(ththed4);
    trthead.appendChild(ththed5);
    trthead.appendChild(ththed6);
    trthead.appendChild(ththed2);
    trthead.appendChild(ththed3);
    theadcr.appendChild(trthead);
    tablecr.setAttribute("id", idtable);
    tablecr.setAttribute("class", "table table-bordered table-hover");
    tablecr.appendChild(theadcr);
    tbodyth.setAttribute("id", idtbody);
    tablecr.appendChild(tbodyth);
    divinst.appendChild(tablecr);
    divkdua.appendChild(divinsd);
    divkdua.appendChild(divinst);
    divawal.appendChild(divkdua);
    divsatu.appendChild(divawal);
    tampung.appendChild(divsatu);
}

/* ---------------------------------------------------------------------*/
/* Script tambahan untuk form jumlah */

var numbertx = "";

function inputjumlah(objs, prmt) {
    beginNumber("jumlahtext", "regular");
    $("#judulnya").html("Jumlah Produk Pada Paket");
    $("#formlabel").slideUp("slow");
    $("#jumlahproduk").slideDown("slow");
    var expld = prmt.split("-");
    for (var i = 0; i < expld.length; i++) {
        $("#step-Package" + expld[i] + (i + 1)).slideUp("slow");
    }
    numbertx = objs;
}

$('#jumlahButton').click(function () {
    numbertx.innerHTML = "( " + document.getElementById("jumlahtext").value + " ) <font style='color: blue; cursor: pointer;'>Jumlah</font></div>";
    $("#formlabel").slideDown("slow");
    $("#jumlahproduk").slideUp("slow");
    document.getElementById("jumlahtext").value = "";
});

/* ---------------------------------------------------------------------*/
/* Script tambahan untuk ajax promo */

var gantijudul = 0;
var idobjjudul = "";
var strngjudul = "";
var pakettabel = 0;

function doajax(type, urls, idresult, sendvalue, idoption, konsol, appendPilih, paketvalue, paketaddress) {
    if (window.XMLHttpRequest) {
        var variabel = new XMLHttpRequest();
    } else {
        var variabel = new ActiveXObject("Microsoft.XMLHTTP");
    }
    variabel.onreadystatechange = function () {
        if (variabel.readyState === 4 && variabel.status === 200) {
            if(document.getElementById(idresult)){
                document.getElementById(idresult).innerHTML = variabel.responseText;
                if(typeof appendPilih !== "undefined" && appendPilih){
                    var approval_item = document.getElementById(idresult);
                    var optionPilih = document.createElement("option");
                    var optionChild = approval_item.getElementsByTagName("option");
                    optionPilih.setAttribute("value","");
                    optionPilih.innerHTML = "--Pilih--";
                    approval_item.removeAttribute("disabled");
                    approval_item.insertBefore(optionPilih,optionChild[0]);
                    attributeStock(document.getElementById(idresult));
                }
                if(pakettabel === 1 && document.getElementById("tbodypaket")){
                    var tbodypaket = document.getElementById("tbodypaket");
                    var trpaket = tbodypaket.getElementsByTagName("tr");
                    /* console.log(paketaddress); */
                    gettrinfo(trpaket[0], paketvalue, paketaddress);
                    changecst = 1;
                    pakettabel = 0;
                    if(typeof counter_select_paket !== "undefined") {
                        for(var i = 0; i <= counter_select_paket; i++){
                            if(document.getElementById("paket" + i)){
                                $("#paket" + i).select2("enable", true);
                            }
                        }
                    }
                    
                }
            }
            if (gantijudul === 1) {
                if (document.getElementById(idobjjudul)) {
                    document.getElementById(idobjjudul).innerHTML = strngjudul;
                }
            }
            if(konsol){
                if(konsol === "alert"){
                    alert("Approval akan dikirim ke " + variabel.responseText);
                } else {
                    console.log(variabel.responseText);
                }
            }
            /* console.log(idoption); */
            if (typeof idoption !== "undefined") {
                $("#" + idoption).select2();
            }
        }
        if (variabel.readyState === 4 && variabel.status === 500) {
            console.log("Error : " + variabel.status + " && Message : " + variabel.statusText);
            if(typeof url_samamodal === "function") {
                var stringError = variabel.statusText.split(" && ");
                var stringResult = "";
                document.location = url_samamodal();
                for(var i = 0; i < stringError.length; i++){
                    stringResult = stringResult+"<li>"+stringError[i]+"</li>";
                }
                if(document.getElementById("paketLoading" + paketaddress)){
                    var paketLoading = document.getElementById("paketLoading" + paketaddress);
                    paketLoading.parentNode.removeChild(paketLoading);
                    if(typeof counter_select_paket !== "undefined") {
                        for(var i = 0; i <= counter_select_paket; i++){
                            if(document.getElementById("paket" + i)){
                                $("#paket" + i).select2("enable", true);
                            }
                        }
                    }
                }
                document.getElementById("Alertnya").innerHTML = "LAST LINE OF EXECUTION HAVE REACH !!!!<ul>"+stringResult+"</ul>";
            }
        }
    };
    variabel.open(type, urls, true);
    variabel.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    variabel.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    variabel.send(sendvalue);
}

function getCustomerOrderEntry(type, urls, idresult, idoption){
    doajax(type, urls, idresult, null, idoption);
}

function getProductOrderEntry(type, urls, idresult, idoption){
    doajax(type, urls, idresult, null, idoption);
}

function getPaket(type, urls, idresult, idoption){
    /* console.log("Masuk getPaket.."); */
    if(typeof changecst !== "undefined" && changecst === 0){
        doajax(type, urls, idresult, null, idoption);
    }
}

function tabelPaket(type, urls, idresult, sendvalue, objectvalue, addressactive){
    if(changecst === 1 && objectvalue !== ""){
        changecst = 0;
        pakettabel = 1;
        console.log("Masuk Ajax Paket.");
        doajax(type, urls, idresult, sendvalue, false, false, false, objectvalue, addressactive);
    }
}

function cekPromo(type, urls, idresult, sendvalue, idoption, clearhtml) {
    if (typeof clearhtml !== "undefined") {
        var cl = clearhtml.split("-");
        for (var i = 0; i < cl.length; i++) {
            if (document.getElementById(cl[i])) {
                document.getElementById(cl[i]).innerHTML = "";
            }
        }
    }
    doajax(type, urls, idresult, sendvalue, idoption);
}

function gantjudul(idname, judul) {
    gantijudul = 1;
    idobjjudul = idname;
    strngjudul = judul;
}

/* ---------------------------------------------------------------------*/
/* Script tambahan untuk input number */

var carret = 0;
var carrlf = 0;
var carrrg = 0;
var shftky = 0;
var shftup = 0;
var lastcr = 0;
var holdrg = 0;
var holdlf = 0;
var tmbhan = 0;
var keynyb = {
    "48": true, "49": true, "50": true, "51": true, "52": true, "53": true, "54": true, "55": true, "56": true, "57": true,
    "96": true, "97": true, "98": true, "99": true, "100": true, "101": true, "102": true, "103": true, "104": true, "105": true
};
var keynya = {
    "37": true, "39": true, "8": true, "46": true, "16": true
};

function setCaretPosition(elemId, caretPos) {
    var elem = document.getElementById(elemId);
    if (elem.createTextRange) {
        var range = elem.createTextRange();
        range.move('character', caretPos);
        range.select();
    }
    else {
        if (elem.selectionStart) {
            elem.focus();
            elem.setSelectionRange(caretPos, caretPos);
        }
        else {
            elem.focus();
        }
    }
}

function setTitik(vals) {
    var valt = vals.replace(/\./g, "");
    var vald = valt.length;
    var rslt = "";
    var jmtk = 0;
    while (true) {
        if (vald > 3) {
            rslt = "." + valt.substring(vald - 3, vald) + rslt;
            vald = vald - 3;
            jmtk = jmtk + 1;
        } else {
            rslt = valt.substring(0, vald) + rslt;
            break;
        }
    }
    return new Array(rslt, jmtk);
}

function valueUnite(strs, addr, vals, objs, idname) {
    var nilai = vals;
    nilai = nilai.substring(0, addr) + strs + nilai.substring(addr, nilai.length);
    objs.value = setTitik(nilai)[0];
    var tmbham = objs.value.substring(0, addr + 1).split(".").length - 1;
    setCaretPosition(idname, addr + 1);
    if (tmbham > tmbhan) {
        carret = carret + 1;
        setCaretPosition(idname, addr + 2);
        tmbhan = tmbham;
    }
    if (typeof tahanvalue === "function") {
        tahanvalue(objs);
    }
    if (typeof jumlahkan === "function") {
        jumlahkan(objs);
    }
    return nilai;
}

function regularUnite(strs, addr, vals, objs, idname) {
    if(objs.value.split(",").length > 1 && strs === ","){
        strs = "";
    } else {
        if(strs === ","){
            if (carrlf === 0 && carrrg === 0) {
                carret++;
            } else {
                carret = carrlf;
                carret++;
            }
        }
    }
    var nilai = vals;
    nilai = nilai.substring(0, addr) + strs + nilai.substring(addr, nilai.length);
    objs.value = nilai;
    setCaretPosition(idname, addr + 1);
    if (typeof tahanvalue === "function") {
        tahanvalue(objs);
    }
    if (typeof jumlahkan === "function") {
        jumlahkan(objs);
    }
}

function getFunctionString(attribute_value){
    if(attribute_value !== ""){
        var attributeString = attribute_value;
        var splitSemiColon = attributeString.split(";");
        for(var j = 0; j < splitSemiColon.length; j++){
            var splitString = splitSemiColon[j].split("-args:");
            if(splitString.length > 1){
                var getFunctionName = splitString[0];
                var getArgument = splitString[1].split(",");
                var stringFunction = "";
                var comma = "";
                for(var i = 0; i < getArgument.length; i++){
                    var getTypeArgument = getArgument[i].split(" as ");
                    if(getTypeArgument[1] === "object" || getTypeArgument[1] === "number" || getTypeArgument[1] === "float"){
                        stringFunction = stringFunction + comma + getTypeArgument[0];
                    }
                    if(getTypeArgument[1] === "string"){
                        stringFunction = stringFunction + comma + "'" + getTypeArgument[0] + "'";
                    }
                    comma = ",";
                }
                var gatherString = getFunctionName + "(" + stringFunction + ")";
                /* console.log(gatherString); */
                return gatherString;
            }
        }
    }
}

function onclickFunction(attribute_value) {
    return getFunctionString(attribute_value);
}

function onblurFunction(attribute_value) {
    return getFunctionString(attribute_value);
}

function beginNumber(idname, numtype) {

    document.getElementById(idname).onclick = function () {
        if (this.selectionStart === this.selectionEnd) {
            carret = this.selectionStart;
        } else {
            carrlf = this.selectionStart;
            carrrg = this.selectionEnd;
        }
        var click = onclickFunction(this.getAttribute("onclickFunction"));
        eval(click);
        tmbhan = this.value.substring(0, carret).split(".").length - 1;
    };

    document.getElementById(idname).onfocus = function () {
        if (this.selectionStart === this.selectionEnd) {
            carret = this.selectionStart;
        } else {
            carrlf = this.selectionStart;
            carrrg = this.selectionEnd;
        }
        tmbhan = this.value.substring(0, carret).split(".").length - 1;
    };

    document.getElementById(idname).onkeyup = function (e) {
        if (e.keyCode === 16) {
            shftup = 0;
        }
        if (e.keyCode === 8) {
            if (typeof numtype === "undefined") {
                this.value = setTitik(this.value)[0];
                tmbhan = this.value.substring(0, carret).split(".").length - 1;
                setCaretPosition(idname, carret);
            }
            if (typeof jumlahkan === "function") {
                jumlahkan(this);
            }
        }
    };

    document.getElementById(idname).onkeydown = function (e) {
        if (keynya[e.keyCode]) {
            if (e.keyCode === 16) {
                shftup = 1;
            }
            if (shftup === 1 && e.keyCode === 37) {
                shftky = 1;
                if (holdlf === 0) {
                    lastcr = carret;
                    holdlf = 1;
                    holdrg = 0;
                }
                if (carret > 0) {
                    carret--;
                }
            }
            if (shftup === 1 && e.keyCode === 39) {
                shftky = 1;
                if (holdrg === 0) {
                    lastcr = carret;
                    holdrg = 1;
                    holdlf = 0;
                }
                if (carret < this.value.length) {
                    carret++;
                }
            }
            if (shftup === 0 && (e.keyCode === 37 || e.keyCode === 8)) {
                if (carret > 0) {
                    if (carrlf === 0 && carrrg === 0) {
                        if (shftky === 0) {
                            carret--;
                        }
                    } else {
                        carret = carrlf;
                    }
                }
                if (carret >= 0) {
                    if (shftky === 1) {
                        if (holdrg === 1) {
                            carret = lastcr;
                            holdrg = 0;
                        }
                        holdlf = 0;
                        shftky = 0;
                    }
                }
            }
            if (shftup === 0 && e.keyCode === 39) {
                if (carret < this.value.length) {
                    if (carrlf === 0 && carrrg === 0) {
                        if (shftky === 0) {
                            carret++;
                        }
                    } else {
                        carret = carrrg;
                    }
                }
                if (carret <= this.value.length) {
                    if (shftky === 1) {
                        if (holdlf === 1) {
                            carret = lastcr;
                            holdlf = 0;
                        }
                        holdrg = 0;
                        shftky = 0;
                    }
                }
            }
            tmbhan = this.value.substring(0, carret).split(".").length - 1;
            carrlf = 0;
            carrrg = 0;
            return true;
        } else {
            if (e.keyCode === 188) {
                regularUnite(",", carret, this.value, this, idname);
            }
            if (keynyb[e.keyCode]) {
                if (numtype === "regular") {
                    regularUnite(String.fromCharCode(e.keyCode), carret, this.value, this, idname);
                } else {
                    valueUnite(String.fromCharCode(e.keyCode), carret, this.value, this, idname);
                }
                if (carrlf === 0 && carrrg === 0) {
                    carret++;
                } else {
                    carret = carrlf;
                    carret++;
                }

            }
            return false;
        }
    };

}

/* ---------------------------------------------------------------------*/
/* Script tambahan untuk input number di modul order entry */

if(document.getElementById("approval_diskon_diskon_request")){
    beginNumber("approval_diskon_harga_request");
    beginNumber("approval_diskon_diskon_request", "regular");
    beginNumber("approval_item_jumlah_item0", "regular");
}