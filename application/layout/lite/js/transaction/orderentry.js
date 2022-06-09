var holdvalue = [];
var amountstd = [];
var customers = "";
var addresstr = 0;
var changecst = 0;

function generateTable(objs) {
    var tampung = document.getElementById("tabeltransaksi");
    /* console.log(objs.value); */
    if (customers !== "") {
        if (!document.getElementById("transaksinya")) {
            baseTable(
                    "transaksinya",
                    "bodynyatabel", tampung,
                    "Transaksi Customer : " + customers + " ( - Transaksi Regular - )"
                    );
        }
        if (document.getElementById("transaksinya")) {
            var tbdy = document.getElementById("bodynyatabel");
            var trad = tbdy.getElementsByTagName("tr");
            var addh = 0;
            while (trad[0]) {
                trad[0].parentNode.removeChild(trad[0]);
            }
            for (var i = 0; i < objs.options.length; i++) {
                if (objs.options[i].selected) {
                    var tr01 = document.createElement("tr");
                    var td01 = document.createElement("td");
                    var td02 = document.createElement("td");
                    var td03 = document.createElement("td");
                    var td04 = document.createElement("td");
                    var td05 = document.createElement("td");
                    var td06 = document.createElement("td");
                    var hrga = objs.options[i].getAttribute("unitprice");
                    var stgd = objs.options[i].getAttribute("stokgudang");
                    var stps = objs.options[i].getAttribute("stokpusat");
                    td04.setAttribute("style","text-align: right;");
                    td05.setAttribute("style","text-align: right;");
                    td06.setAttribute("style","text-align: right;");
                    td03.setAttribute("style","text-align: right;");
                    td01.innerHTML = objs.options[i].text + "<input type='hidden' name='reguler_produk[]' value='" + objs.options[i].value + "' />";
                    td04.innerHTML = setTitik(hrga)[0] + "<input type='hidden' name='reguler_harga[]' value='" + hrga + "' />";
                    td05.innerHTML = stps + "<input type='hidden' name='reguler_stok_pusat[]' value='" + stps + "' />";
                    td06.innerHTML = stgd + "<input type='hidden' name='reguler_stok_gudang[]' value='" + stgd + "' />";
                    td02.innerHTML = "<input name='reguler_kuantiti_per_item[]' nilaiarray='" + i + "' value='" + (typeof holdvalue[i] !== "undefined" ? holdvalue[i] : "") + "' type='text' id='hargake" + addh + "' style='font-family: monospace; width: 100%' keterangan='hargaregular' onblur='testKalkulasi(this); amountCalculationRegular(this);' />";
                    td03.innerHTML = "";
                    tr01.setAttribute("id", "PRDK_" + objs.options[i].value);
                    tr01.appendChild(td01);
                    tr01.appendChild(td04);
                    tr01.appendChild(td05);
                    tr01.appendChild(td06);
                    tr01.appendChild(td02);
                    tr01.appendChild(td03);
                    tbdy.appendChild(tr01);
                    beginNumber("hargake" + addh, "regular");
                    if(typeof holdvalue[i] !== "undefined"){
                        var objn = document.getElementById('hargake' + addh);
                        testKalkulasi(objn);
                    }
                    addh++;
                }
            }
            if (addh === 0) {
                var objsid = document.getElementById("transaksinya");
                var divprn = objsid.parentNode.parentNode.parentNode.parentNode;
                tbdy.parentNode.removeChild(tbdy);
                objsid.parentNode.removeChild(objsid);
                divprn.parentNode.removeChild(divprn);
            } else {
                jumlahkan(document.getElementById("hargake0"));
                if(typeof objn !== "undefined"){
                    /* console.log(objn); */
                    amountCalculationRegular(objn);
                }
            }
        }
    }
}

function testKalkulasi(objs){
    /* console.log(objs); */
    var gettd = objs.parentNode;
    var gettr = gettd.parentNode;
    var inphd = "";
    var isitd = gettr.getElementsByTagName("td");
    if(Number(objs.value) > Number(isitd[3].innerHTML.split("<input")[0])){
        alert("Jumlah Item Tidak Cukup.");
        objs.value = "";
    }
    isitd[(isitd.length - 1)].innerHTML = Number(isitd[1].innerHTML.split("<input")[0].replace(/\./g, "")) * Number(objs.value);
    if(objs.getAttribute("idpaket") !== ""){
        inphd = "<input type='hidden' name='promo_harga_per_item_seluruh[" + objs.getAttribute("idpaket") + "][]' value='" + isitd[(isitd.length - 1)].innerHTML + "' />";
    } else {
        inphd = "<input type='hidden' name='reguler_harga_per_item_seluruh[]' value='" + isitd[(isitd.length - 1)].innerHTML + "' />";
    }
    isitd[(isitd.length - 1)].innerHTML = setTitik(isitd[(isitd.length - 1)].innerHTML)[0] + inphd;
    /* document.getElementById("approval").style.display = "block"; */
    if(objs.value !== ""){
        var tombol = document.getElementById("step-1OrderEntry");
        /* console.log(tombol); */
        tombol.removeAttribute("disabled");
    }
}

function amountCalculationRegular(objs){
    var gettd = objs.parentNode;
    var gettr = gettd.parentNode;
    var gettb = gettr.parentNode;
    var trchl = gettb.getElementsByTagName("tr");
    var trlst = trchl[(trchl.length - 1)];
    var tdlst = trlst.getElementsByTagName("td");
    var ttlhr = 0;
    for(var i = 0; i < (trchl.length - 1); i++){
        var tdins = trchl[i].getElementsByTagName("td");
        var tdhrg = Number(tdins[(tdins.length - 1)].innerHTML.split("<input ")[0].replace(/\./g, ""));
        ttlhr = ttlhr + tdhrg;
    }
    tdlst[(tdlst.length - 1)].innerHTML = setTitik(ttlhr.toString())[0] + "<input type='hidden' name='reguler_harga_item_seluruh[]' value='" + ttlhr.toString() + "' />"; 
}

function amountCalculationPromo(objs,param){
    var idpkt = objs.getAttribute("idpaket");
    var gettd = objs.parentNode;
    var gettr = gettd.parentNode;
    var alamat = objs.getAttribute("alamat");
    if(document.getElementById("syaratHargaPromo" + alamat)){
        var syaratHarga = document.getElementById("syaratHargaPromo" + alamat);
    }
    if(typeof param !== "undefined"){
        var tdins = gettr.getElementsByTagName("td");
        tdins[(tdins.length - 1)].innerHTML = "0";
        var inputTD = tdins[(tdins.length - 2)].getElementsByTagName("input");
        if(inputTD.length > 0){
            inputTD[0].value = "0";
            jumlahkan(inputTD[0]);
        }
    }
    var gettb = gettr.parentNode;
    var trchl = gettb.getElementsByTagName("tr");
    var trtmb = 0;
    var ttlhr = 0;
    for(var i = 0; i < (trchl.length - 1); i++){
        var fonts = trchl[i].getElementsByTagName("font");
        if(fonts.length === 0){
            trtmb = trchl[i];
            break;
        }
        var tdins = trchl[i].getElementsByTagName("td");
        var tdhrg = Number(tdins[(tdins.length - 1)].innerHTML.split("<input ")[0].replace(/\./g, ""));
        ttlhr = ttlhr + tdhrg;
    }
    var tdlst = trtmb.getElementsByTagName("td");
    tdlst[(tdlst.length - 1)].innerHTML = setTitik(ttlhr.toString())[0] + "<input type='hidden' name='promo_harga_item_seluruh[" + idpkt + "][]' value='" + ttlhr.toString() + "' />"; 
    if(typeof syaratHarga !== "undefined"){
        /* console.log("Check Syarat Harga."); */
        checkSyaratHarga(syaratHarga,ttlhr);
    }
}

function checkSyaratHarga(syaratHarga,ttlhr/* Total Harga */) {
    var alamat = syaratHarga.getAttribute("alamat");
    var getSyaratHarga = syaratHarga.innerText.split(" ( - ");
    var getSyaratOperator = getSyaratHarga[1].split(" - )");
    if(document.getElementById("syaratJumlahPromo" + alamat)){
        var syaratJumlah = document.getElementById("syaratJumlahPromo" + alamat);
    }
    /* 
    console.log(syaratHarga.innerText);
    console.log(syaratHarga.innerText.split(" ( - ")[0]); */
    if(getSyaratOperator[0] === "Lebih Besar"){
        if(ttlhr > Number(getSyaratHarga[0].replace(/\./g, ""))) {
            syaratHarga.style.color = "black";
            if(typeof syaratJumlah === "undefined"){
                kondisi_paket["promonya" + alamat] = "Terpenuhi";
            } else {
                if(kondisi_pertama["promonya" + alamat] === "Terpenuhi"){
                    kondisi_paket["promonya" + alamat] = "Terpenuhi";
                }
                kondisi_pertama["promonya" + alamat] = "Terpenuhi";
            }
        } else {
            syaratHarga.style.color = "red";
            kondisi_paket["promonya" + alamat] = "";
        }
    }
    if(getSyaratOperator[0] === "Lebih Kecil"){
        if(ttlhr < Number(getSyaratHarga[0].replace(/\./g, ""))) {
            syaratHarga.style.color = "black";
            if(typeof syaratJumlah === "undefined"){
                kondisi_paket["promonya" + alamat] = "Terpenuhi";
            } else {
                if(kondisi_pertama["promonya" + alamat] === "Terpenuhi"){
                    kondisi_paket["promonya" + alamat] = "Terpenuhi";
                }
                kondisi_pertama["promonya" + alamat] = "Terpenuhi";
            }
        } else {
            syaratHarga.style.color = "red";
            kondisi_paket["promonya" + alamat] = "";
        }
    }
    if(getSyaratOperator[0] === "Lebih Besar Sama Dengan"){
        if(ttlhr >= Number(getSyaratHarga[0].replace(/\./g, ""))) {
            syaratHarga.style.color = "black";
            if(typeof syaratJumlah === "undefined"){
                kondisi_paket["promonya" + alamat] = "Terpenuhi";
            } else {
                if(kondisi_pertama["promonya" + alamat] === "Terpenuhi"){
                    kondisi_paket["promonya" + alamat] = "Terpenuhi";
                }
                kondisi_pertama["promonya" + alamat] = "Terpenuhi";
            }
        } else {
            syaratHarga.style.color = "red";
            kondisi_paket["promonya" + alamat] = "";
        }
    }
    if(getSyaratOperator[0] === "Lebih Kecil Sama Dengan"){
        if(ttlhr <= Number(getSyaratHarga[0].replace(/\./g, ""))) {
            syaratHarga.style.color = "black";
            if(typeof syaratJumlah === "undefined"){
                kondisi_paket["promonya" + alamat] = "Terpenuhi";
            } else {
                if(kondisi_pertama["promonya" + alamat] === "Terpenuhi"){
                    kondisi_paket["promonya" + alamat] = "Terpenuhi";
                }
                kondisi_pertama["promonya" + alamat] = "Terpenuhi";
            }
        } else {
            syaratHarga.style.color = "red";
            kondisi_paket["promonya" + alamat] = "";
        }
    }
    if(getSyaratOperator[0] === "Sama Dengan"){
        if(ttlhr === Number(getSyaratHarga[0].replace(/\./g, ""))) {
            syaratHarga.style.color = "black";
            if(typeof syaratJumlah === "undefined"){
                kondisi_paket["promonya" + alamat] = "Terpenuhi";
            } else {
                if(kondisi_pertama["promonya" + alamat] === "Terpenuhi"){
                    kondisi_paket["promonya" + alamat] = "Terpenuhi";
                }
                kondisi_pertama["promonya" + alamat] = "Terpenuhi";
            }
        } else {
            syaratHarga.style.color = "red";
            kondisi_paket["promonya" + alamat] = "";
        }
    }
    /* Kondisi Paket */
    checkCondition();
}

function tahanvalue(objs) {
    var nilai = objs.getAttribute("nilaiarray");
    holdvalue[nilai] = objs.value;
}

function jumlahkan(objs) {
    var rsltvals = 0;
    /* console.log("Masuk Jumlahkan"); */
    var ktrngans = objs.getAttribute("keterangan");
    if (ktrngans === "hargaregular") {
        if (document.getElementById("JumlahReguler")) {
            document.getElementById("JumlahReguler").parentNode.removeChild(document.getElementById("JumlahReguler"));
        }
        var parenttr = objs.parentNode.parentNode.parentNode;
        var bagiantr = parenttr.getElementsByTagName("tr");
        var jumlahtr = bagiantr.length;
        var jmlhs = 0;
        for (var i = 0; i < jumlahtr; i++) {
            if (document.getElementById("hargake" + i)) {
                jmlhs = jmlhs + Number(document.getElementById("hargake" + i).value);
            }
        }
        var trnya = document.createElement("tr");
        var tdny1 = document.createElement("td");
        var tdny2 = document.createElement("td");
        var tdny3 = document.createElement("td");
        var tdny4 = document.createElement("td");
        var tdny5 = document.createElement("td");
        var tdny6 = document.createElement("td");
        trnya.setAttribute("id", "JumlahReguler");
        tdny3.setAttribute("style", "text-align: right;");
        tdny1.innerHTML = "<div style='width: 120px; text-align: right;'>Total : </div>";
        tdny4.innerHTML = "";
        tdny5.innerHTML = "";
        tdny2.innerHTML = "&nbsp;" + jmlhs + "<input type='hidden' name='reguler_kuantiti_item[]' value='" + jmlhs + "' />";
        tdny3.innerHTML = "";
        trnya.appendChild(tdny1);
        trnya.appendChild(tdny4);
        trnya.appendChild(tdny5);
        trnya.appendChild(tdny6);
        trnya.appendChild(tdny2);
        trnya.appendChild(tdny3);
        parenttr.appendChild(trnya);
        /* console.log(jmlhs); */
    } else {
        var jmlhelem = objs.getAttribute("jumlah");
        var addrelem = objs.getAttribute("alamat");
        
        for (var i = 0; i < Number(jmlhelem); i++) {
            if (document.getElementById("promotext_" + i + "_" + addrelem)) {
                var vals = document.getElementById("promotext_" + i + "_" + addrelem).value.replace(/\./g, "");
                rsltvals = rsltvals + (vals === "" ? 0 : Number(vals));
            }
        }
        if (document.getElementById("syaratJumlahPromo" + addrelem)){
            var syaratJumlah = document.getElementById("syaratJumlahPromo" + addrelem);
        }
        if (document.getElementById("jumlahitem_" + addrelem)) {
            document.getElementById("jumlahitem_" + addrelem).innerHTML = "&nbsp;" + rsltvals + "<input type='hidden' name='promo_kuantiti_item[" + objs.getAttribute("idpaket") + "][]' value='" + rsltvals + "' />";
        }
        if (typeof syaratJumlah !== "undefined") {
            /* console.log("Check Syarat Jumlah."); */
            checkSyaratJumlah(syaratJumlah,rsltvals);
        }
    }
}

function checkSyaratJumlah(syaratJumlah,rsltvals/* Jumlah Produk */) {
    var alamat = syaratJumlah.getAttribute("alamat");
    var getSyaratJumlah = syaratJumlah.innerText.split(" ( - ");
    var getSyaratOperator = getSyaratJumlah[1].split(" - )");
    if(document.getElementById("syaratJumlahPromo" + alamat)){
        var syaratHarga = document.getElementById("syaratHargaPromo" + alamat);
    }
    if(getSyaratOperator === "Lebih Besar"){
        if(rsltvals > Number(getSyaratJumlah[0])){
            syaratJumlah.style.color = "black";
            if(typeof syaratHarga === "undefined"){
                kondisi_paket["promonya" + alamat] = "Terpenuhi";
            } else {
                if(kondisi_pertama["promonya" + alamat] === "Terpenuhi"){
                    kondisi_paket["promonya" + alamat] = "Terpenuhi";
                }
                kondisi_pertama["promonya" + alamat] = "Terpenuhi";
            }
        } else {
            syaratJumlah.style.color = "red";
            kondisi_paket["promonya" + alamat] = "";
        }
    }
    if(getSyaratOperator === "Lebih Kecil"){
        if(rsltvals < Number(getSyaratJumlah[0])){
            syaratJumlah.style.color = "black";
            if(typeof syaratHarga === "undefined"){
                kondisi_paket["promonya" + alamat] = "Terpenuhi";
            } else {
                if(kondisi_pertama["promonya" + alamat] === "Terpenuhi"){
                    kondisi_paket["promonya" + alamat] = "Terpenuhi";
                }
                kondisi_pertama["promonya" + alamat] = "Terpenuhi";
            }
        } else {
            syaratJumlah.style.color = "red";
            kondisi_paket["promonya" + alamat] = "";
        }
    }
    if(getSyaratOperator === "Lebih Besar Sama Dengan"){
        if(rsltvals >= Number(getSyaratJumlah[0])){
            syaratJumlah.style.color = "black";
            if(typeof syaratHarga === "undefined"){
                kondisi_paket["promonya" + alamat] = "Terpenuhi";
            } else {
                if(kondisi_pertama["promonya" + alamat] === "Terpenuhi"){
                    kondisi_paket["promonya" + alamat] = "Terpenuhi";
                }
                kondisi_pertama["promonya" + alamat] = "Terpenuhi";
            }
        } else {
            syaratJumlah.style.color = "red";
            kondisi_paket["promonya" + alamat] = "";
        }
    }
    if(getSyaratOperator === "Lebih Kecil Sama Dengan"){
        if(rsltvals <= Number(getSyaratJumlah[0])){
            syaratJumlah.style.color = "black";
            if(typeof syaratHarga === "undefined"){
                kondisi_paket["promonya" + alamat] = "Terpenuhi";
            } else {
                if(kondisi_pertama["promonya" + alamat] === "Terpenuhi"){
                    kondisi_paket["promonya" + alamat] = "Terpenuhi";
                }
                kondisi_pertama["promonya" + alamat] = "Terpenuhi";
            }
        } else {
            syaratJumlah.style.color = "red";
            kondisi_paket["promonya" + alamat] = "";
        }
    }
    if(getSyaratOperator === "Sama Dengan"){
        if(rsltvals === Number(getSyaratJumlah[0])){
            syaratJumlah.style.color = "black";
            if(typeof syaratHarga === "undefined"){
                kondisi_paket["promonya" + alamat] = "Terpenuhi";
            } else {
                if(kondisi_pertama["promonya" + alamat] === "Terpenuhi"){
                    kondisi_paket["promonya" + alamat] = "Terpenuhi";
                }
                kondisi_pertama["promonya" + alamat] = "Terpenuhi";
            }
        } else {
            syaratJumlah.style.color = "red";
            kondisi_paket["promonya" + alamat] = "";
        }
    }
    /* Kondisi Paket */
    checkCondition();
}

function getcustomer(objs) {
    customers = objs.options[objs.selectedIndex].text;
}

function cancelPakcage(objs,addrs) {
    var panelHeading = objs.parentNode;
    var panelSuccess = panelHeading.parentNode;
    var colLg12_12A = panelSuccess.parentNode;
    var form_grup = colLg12_12A.parentNode;
    form_grup.parentNode.removeChild(form_grup);
    if(jumlah_select_paket > 1) {
        jumlah_select_paket--;
        delete kondisi_paket["promonya" + addrs];
        var selectProduct = document.getElementById("paket" + addrs);
        var parent01 = selectProduct.parentNode;
        var parent02 = parent01.parentNode;
        parent02.parentNode.removeChild(parent02);
    } else {
        $("#paket" + addrs).select2("val","");
    }
    /* Kondisi Paket */
    checkCondition();
}

function barisBawahProduk(objs, addr) {
    if (typeof amountstd[addr] !== "undefined") {
        amountstd[addr] = (Number(amountstd[addr]) - 1);
    }
    if (typeof amountstd[addr] !== "undefined" && amountstd[addr] > 0) {
        var gettd = objs.parentNode;
        var gettr = gettd.parentNode;
        var gettb = gettr.parentNode;
        var isitd = gettr.getElementsByTagName("td");
        var tr001 = document.createElement("tr");
        var td001 = document.createElement("td");
        var td002 = document.createElement("td");
        var td003 = document.createElement("td");
        var td004 = document.createElement("td");
        var td005 = document.createElement("td");
        var td006 = document.createElement("td");
        td004.setAttribute("style","text-align: right; display: none;");
        td005.setAttribute("style","text-align: right; display: none;");
        td006.setAttribute("style","text-align: right; display: none;");
        td001.innerHTML = gettd.innerHTML.replace("<i class=\"fa fa-fw fa-remove\"></i>", "<i class=\"fa fa-fw fa-plus\"></i>").replace("barisBawahProduk", "barisAtasProduk");
        td004.innerHTML = isitd[1].innerHTML;
        td005.innerHTML = isitd[2].innerHTML;
        td006.innerHTML = isitd[3].innerHTML;
        td002.innerHTML = "";
        td003.innerHTML = "";
        tr001.appendChild(td001);
        tr001.appendChild(td004);
        tr001.appendChild(td005);
        tr001.appendChild(td006);
        tr001.appendChild(td002);
        tr001.appendChild(td003);
        gettb.appendChild(tr001);
        gettr.parentNode.removeChild(gettr);
    } else {
        document.location = url_samamodal();
        document.getElementById("Alertnya").innerHTML = "Harus ada minimal 1 produk.";
    }
    if (amountstd[addr] === 0) {
        amountstd[addr] = 1;
    }
    var parentTD = objs.parentNode;
    var parentTR = parentTD.parentNode;
    var inputans = parentTR.getElementsByTagName("input");
    jumlahkan(inputans[0]);
}

function barisAtasProduk(objs, addr, addt, jmlh) {
    if (typeof amountstd[addr] !== "undefined") {
        amountstd[addr] = (Number(amountstd[addr]) + 1);
    }
    var gettd = objs.parentNode;
    var gettr = gettd.parentNode;
    var gettb = gettr.parentNode;
    var attpk = objs.getAttribute("idpaket");
    var isitd = gettr.getElementsByTagName("td");
    var tr001 = document.createElement("tr");
    var td001 = document.createElement("td");
    var td002 = document.createElement("td");
    var td003 = document.createElement("td");
    var td004 = document.createElement("td");
    var td005 = document.createElement("td");
    var td006 = document.createElement("td");
    td004.setAttribute("style","text-align: right;");
    td005.setAttribute("style","text-align: right;");
    td006.setAttribute("style","text-align: right;");
    td003.setAttribute("style","text-align: right;");
    td001.innerHTML = gettd.innerHTML.replace("<i class=\"fa fa-fw fa-plus\"></i>", "<i class=\"fa fa-fw fa-remove\"></i>").replace("barisAtasProduk", "barisBawahProduk");
    td004.innerHTML = isitd[1].innerHTML + "<input type='hidden' name='promo_harga[" + attpk + "][]' value='" + isitd[1].innerHTML.replace(/\./g, "") + "' />";
    td005.innerHTML = isitd[2].innerHTML + "<input type='hidden' name='promo_stok_pusat[" + attpk + "][]' value='" + isitd[2].innerHTML + "' />";
    td006.innerHTML = isitd[3].innerHTML + "<input type='hidden' name='promo_stok_gudang[" + attpk + "][]' value='" + isitd[3].innerHTML + "' />";
    td002.innerHTML = "<input type='text' name='promo_kuantiti_per_item[" + attpk + "][]' idpaket='" + attpk + "' jumlah='" + jmlh + "' alamat='" + addr + "' style='font-family: monospace; width: 100%' id='promotext_" + addt + "_" + addr + "' onblur='testKalkulasi(this); amountCalculationPromo(this);' />";
    td003.innerHTML = "";
    tr001.appendChild(td001);
    tr001.appendChild(td004);
    tr001.appendChild(td005);
    tr001.appendChild(td006);
    tr001.appendChild(td002);
    tr001.appendChild(td003);
    var trke0 = gettb.getElementsByTagName("tr");
    gettb.insertBefore(tr001, trke0[0]);
    gettr.parentNode.removeChild(gettr);
    beginNumber("promotext_" + addt + "_" + addr, "regular");
}

function setLoading(address,objs){
    if(objs.value !== ""){
        /* console.log("Test"); */
        /* console.log(typeof address); */
        for(var i = 0; i <= counter_select_paket; i++){
            if(i !== Number(address)){
                if(document.getElementById("paket" + i)){
                    $("#paket" + i).select2("enable", false);
                }
            }
        }
        if(document.getElementById("paketLoading" + address)){
            var paketLoading = document.getElementById("paketLoading" + address);
            paketLoading.parentNode.removeChild(paketLoading);
        }
        if(document.getElementById("promonya" + address)){
            var objectTable = document.getElementById("promonya" + address);
            var divParent1 = objectTable.parentNode;
            var divParent2 = divParent1.parentNode;
            var divParent3 = divParent2.parentNode;
            var divParent4 = divParent3.parentNode;
            divParent4.parentNode.removeChild(divParent4);
        }
        if(!document.getElementById("tampungPaket" + address)){
            /* var divTampung = '<div id="tampungPaket'+address+'"></div>'; */
            var divTampung = document.createElement("div");
            divTampung.setAttribute("id", "tampungPaket"+address);
        }
        var divLoading = '<div id="paketLoading'+address+'" class="form-group" style="margin-bottom: 0px; margin-top: 0px;">' + 
                '<div class="col-lg-12 col-lg-12a">'+
                '<div class="panel panel-success" style="overflow: hidden;">'+
                '<div class="panel-heading" style="padding-bottom: 10px; overflow-x: auto; white-space: nowrap;">'+
                'Loading Paket..'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>';
        if(typeof divTampung !== "undefined"){
            var promoTransaksi = document.getElementById("promotransaksi");
            promoTransaksi.appendChild(divTampung);
        }
        var tampungPaket = document.getElementById("tampungPaket" + address);
        tampungPaket.innerHTML = divLoading;
    }
}

var counter_select_paket = 0;
var jumlah_select_paket = 1;
var kondisi_paket = {};
var kondisi_pertama = {};
if(document.getElementById("paket0")){
    var selectPaket0 = document.getElementById("paket0");
    var isiSelectPaket = selectPaket0.innerHTML;
}

function checkCondition() {
    /* console.log("Check Kondisi Paket."); */
    var addr = 0;
    var btns = document.getElementById("step-1OrderEntry");
    for(var key in kondisi_paket){
        if(kondisi_paket[key] === "Terpenuhi"){
            addr++;
        }
    }
    if(addr === jumlah_select_paket){
        btns.setAttribute("type","submit");
        btns.removeAttribute("onclick");
    } else {
        btns.setAttribute("type","button");
        btns.setAttribute("onclick", "alert('Kondisi paket belum terpenuhi.')");
    }
}

function createSelect() {
    if(changecst === 1){
        jumlah_select_paket++;
        counter_select_paket++;
        var selectProduct = document.getElementById("produk");
        var parent01 = selectProduct.parentNode;
        var parent02 = parent01.parentNode;
        var parent03 = parent02.parentNode;

        var divFormGroup = document.createElement("div");
        var labelControll = document.createElement("label");
        var divColSM = document.createElement("div");
        var selectPaket = document.createElement("select");

        divFormGroup.setAttribute("class","form-group");

        labelControll.setAttribute("class","control-label col-sm-2");
        labelControll.setAttribute("for","paket" + counter_select_paket);
        labelControll.innerHTML = "Paket :";

        divColSM.setAttribute("class","col-sm-10");
        divColSM.setAttribute("id","paketnya" + counter_select_paket);

        selectPaket.setAttribute("alamatSelect", counter_select_paket);
        selectPaket.setAttribute("modelinput", "select");
        selectPaket.setAttribute("id", "paket" + counter_select_paket);
        selectPaket.setAttribute("name", "paketPilihan");
        selectPaket.setAttribute("class", "form-control select2");
        selectPaket.setAttribute("style", "width: 100%;");
        selectPaket.setAttribute("onchange", "setLoading(this.getAttribute('alamatSelect'),this);setCampaignValue( this.value.split(' || ')[1] );tabelPaket('POST','"+url_campaign()+"','tampilpaket','&idcampaign=' + this.value.split(' || ')[1] + '&idpaket=' + this.value.split(' || ')[0],this.value.split(' || ')[0],this.getAttribute('alamatSelect'));");
        selectPaket.innerHTML = isiSelectPaket;

        divColSM.appendChild(selectPaket);
        divFormGroup.appendChild(labelControll);
        divFormGroup.appendChild(divColSM);

        parent03.insertBefore(divFormGroup,parent02);

        $("#paket" + counter_select_paket).select2();
    
    }
}

function hidePakcage(param){
    if(document.getElementById("divPaketInside" + param)){
        var divInside = document.getElementById("divPaketInside" + param);
        /* console.log(divInside.getAttribute("style").split("none").length); */
        if(divInside.getAttribute("style").split("none").length > 1){
            divInside.style.display = "block";
            divInside.style.overflowX = "auto";
            divInside.style.whiteSpace = "nowrap";
            for(var i = 0; i <= counter_select_paket; i++){
                if(i !== Number(param)){
                    if(document.getElementById("divPaketInside" + i)){
                        document.getElementById("divPaketInside" + i).style.display = "none";
                    }
                }
            }
        } else {
            divInside.style.display = "none";
        }
    }
}

function gettrinfo(objs/*, addr */, paketvalue, paketaddress) {
    /* console.log(objs); */
    addresstr = paketaddress;
    if(document.getElementById("paketLoading" + paketaddress)){
        var paketLoading = document.getElementById("paketLoading" + paketaddress);
        paketLoading.parentNode.removeChild(paketLoading);
        if(document.getElementById("promonya" + paketaddress)){
            var objectTable = document.getElementById("promonya" + paketaddress);
            var divParent1 = objectTable.parentNode;
            var divParent2 = divParent1.parentNode;
            var divParent3 = divParent2.parentNode;
            var divParent4 = divParent3.parentNode;
            divParent4.parentNode.removeChild(divParent4);
        }
    }
    var tdtd = objs.getElementsByTagName("td");
    var cust = document.getElementById("customer");
    var pkts = {value : paketvalue};
    var opts = cust.options[cust.options.selectedIndex].value;
    var optt = cust.options[cust.options.selectedIndex].text;
    var elmn = [];
    var jdls = "";
    var hrga = "";
    var jmlh = "";
    var opsn = "";
    var nmcm = "";
    var nmpk = "";
    var prdk = 0;
    var cusc = 0;
    if (opts !== "") {
        for (var i = 0; i < tdtd.length; i++) {
            if (tdtd[i].getAttribute("namatags") === "NamaPaket") {
                nmcm = document.getElementById("campaign").options[document.getElementById("campaign").options.selectedIndex].text;
                nmpk = tdtd[i].innerHTML;
                jdls = "Transaksi " + nmpk.replace("<isian>", "").replace("</isian>", "").replace("<br>", "").replace("<br />", "") + " ( - Transaksi Promo - ) ( - " + nmcm + " - ) ( - OPSNYA - ) ( - <font onclick=\"cancelPakcage(this,"+paketaddress+");\" style='color: blue; cursor: pointer;'><i class=\"fa fa-fw fa-remove\"></i></font> - )  ( - <font onclick=\"hidePakcage('"+paketaddress+"');\" style='color: blue; cursor: pointer;'>m</font> - )";
            }
            if (tdtd[i].getAttribute("namatags") === "ParameterProduk") {
                var html = tdtd[i].innerHTML;
                var ulul = tdtd[i].getElementsByTagName("ul");
                var lili = (ulul.length > 0) ? ulul[0].getElementsByTagName("li") : "";
                for (var j = 0; j < lili.length; j++) {
                    elmn[j] = lili[j].innerHTML;
                }
                if (lili.length > 0) {
                    prdk = 1;
                }
                opsn = html.split("( - ")[1].replace(" - )", "");
            }
            if (tdtd[i].getAttribute("namatags") === "ParameterHarga") {
                hrga = tdtd[i].innerHTML;
            }
            if (tdtd[i].getAttribute("namatags") === "ParameterQuantity") {
                jmlh = tdtd[i].innerHTML;
            }
            if (tdtd[i].getAttribute("namatags") === "ParameterCustomer") {
                var liliC = tdtd[i].getElementsByTagName("li");
                for (var j = 0; j < liliC.length; j++) {
                    if (liliC[j].innerText !== optt) {
                        cusc = 1;
                    } else {
                        cusc = 0;
                        break;
                    }
                }
            }
        }
        if (cusc === 0) {
            if (prdk === 1) {
                var tampung = document.getElementById("tampungPaket" + paketaddress);
                if (!document.getElementById("promonya" + addresstr)) {
                    kondisi_paket["promonya" + addresstr] = "";
                    kondisi_pertama["promonya" + addresstr] = "";
                    baseTable("promonya" + addresstr, "bodynyapromo" + addresstr, tampung, jdls.replace("OPSNYA", opsn), true, paketaddress);
                    var tbdy = document.getElementById("bodynyapromo" + addresstr);
                    amountstd[addresstr] = elmn.length;
                    for (var i = 0; i < elmn.length; i++) {
                        var tr01 = document.createElement("tr");
                        var td01 = document.createElement("td");
                        var td02 = document.createElement("td");
                        var td03 = document.createElement("td");
                        var td04 = document.createElement("td");
                        var td05 = document.createElement("td");
                        var td06 = document.createElement("td");
                        td04.setAttribute("style","text-align: right;");
                        td05.setAttribute("style","text-align: right;");
                        td06.setAttribute("style","text-align: right;");
                        td03.setAttribute("style","text-align: right;");
                        var slng = "";
                        var idpr = elmn[i].split(" || ")[4];
                        if (opsn === "Opsional") {
                            slng = "( - <font style='cursor: pointer; color: blue;' alamat='" + addresstr + "' idproduk='" + idpr + "' idpaket='" + pkts.value + "' onclick=' amountCalculationPromo(this,true); barisBawahProduk(this," + addresstr + "," + i + "," + elmn.length + ");'><i class=\"fa fa-fw fa-remove\"></i></font> - ) ";
                        }
                        var expldstrip = elmn[i].split(" || ");
                        td01.innerHTML = slng + expldstrip[0] + "<input type='hidden' name='promo_produk[" + pkts.value + "][]' value='" + expldstrip[4] + "' />";
                        td04.innerHTML = setTitik(expldstrip[3])[0] + "<input type='hidden' name='promo_harga[" + pkts.value + "][]' value='" + expldstrip[3] + "' />";
                        td05.innerHTML = expldstrip[1] + "<input type='hidden' name='promo_stok_pusat[" + pkts.value + "][]' value='" + expldstrip[1] + "' />";
                        td06.innerHTML = expldstrip[2] + "<input type='hidden' name='promo_stok_gudang[" + pkts.value + "][]' value='" + expldstrip[2] + "' />";
                        td02.innerHTML = "<input type='text' name='promo_kuantiti_per_item[" + pkts.value + "][]' idpaket='" + pkts.value + "' jumlah='" + elmn.length + "' alamat='" + addresstr + "' style='font-family: monospace; width: 100%' id='promotext_" + i + "_" + addresstr + "' keterangan='hargapromo' onblur='testKalkulasi(this); amountCalculationPromo(this);' />";
                        td03.innerHTML = "";
                        tr01.appendChild(td01);
                        tr01.appendChild(td04);
                        tr01.appendChild(td05);
                        tr01.appendChild(td06);
                        tr01.appendChild(td02);
                        tr01.appendChild(td03);
                        tbdy.appendChild(tr01);
                        beginNumber("promotext_" + i + "_" + addresstr, "regular");
                    }
                    var tr01 = document.createElement("tr");
                    var td01 = document.createElement("td");
                    var td02 = document.createElement("td");
                    var td03 = document.createElement("td");
                    var td04 = document.createElement("td");
                    var td05 = document.createElement("td");
                    var td06 = document.createElement("td");
                    /* td02.setAttribute("style","text-align: right;"); */
                    td03.setAttribute("style","text-align: right;");
                    td01.innerHTML = "<div style='width: 120px; text-align: right;'>Total : </div>";
                    td04.innerHTML = "";
                    td05.innerHTML = "";
                    td06.innerHTML = "";
                    td02.innerHTML = "&nbsp;0";
                    td03.innerHTML = "&nbsp;0";
                    td02.setAttribute("id", "jumlahitem_" + addresstr);
                    td03.setAttribute("id", "jumlahharga_" + addresstr);
                    tr01.appendChild(td01);
                    tr01.appendChild(td04);
                    tr01.appendChild(td05);
                    tr01.appendChild(td06);
                    tr01.appendChild(td02);
                    tr01.appendChild(td03);
                    tbdy.appendChild(tr01);
                    var tr11 = document.createElement("tr");
                    var td11 = document.createElement("td");
                    var td12 = document.createElement("td");
                    var td13 = document.createElement("td");
                    var td14 = document.createElement("td");
                    var td15 = document.createElement("td");
                    var td16 = document.createElement("td");
                    td11.innerHTML = "<div style='width: 120px; text-align: right;'>Syarat : </div>";
                    td14.innerHTML = "";
                    td15.innerHTML = "";
                    td16.innerHTML = "";
                    td12.innerHTML = (jmlh !== "") ? "&nbsp;<font id='syaratJumlahPromo" + addresstr + "' alamat='" + addresstr + "' style='color: red;'>" + jmlh.replace("( - ", " ( - ") + "</font>" : "&nbsp;-";
                    td13.innerHTML = (hrga !== "") ? "&nbsp;<font id='syaratHargaPromo" + addresstr + "' alamat='" + addresstr + "' style='color: red;'>" + hrga.replace("( - ", " ( - ") + "</font>" : "&nbsp;-";
                    td12.setAttribute("id", "syaratjumlah_" + addresstr);
                    td13.setAttribute("id", "syaratharga_" + addresstr);
                    tr11.appendChild(td11);
                    tr11.appendChild(td14);
                    tr11.appendChild(td15);
                    tr11.appendChild(td16);
                    tr11.appendChild(td12);
                    tr11.appendChild(td13);
                    tbdy.appendChild(tr11);
                    var idjumlah = document.getElementById("syaratjumlah_" + addresstr);
                    var idsharga = document.getElementById("syaratharga_" + addresstr);
                    var brbr01 = idjumlah.getElementsByTagName("br");
                    var brbr02 = idsharga.getElementsByTagName("br");
                    for (var i = 0; i < brbr01.length; i++) {
                        brbr01[i].parentNode.removeChild(brbr01[i]);
                    }
                    for (var i = 0; i < brbr02.length; i++) {
                        brbr02[i].parentNode.removeChild(brbr02[i]);
                    }
                    var htmljmlh = idjumlah.innerHTML;
                    var htmlhrga = idsharga.innerHTML;
                    var expldjmlh = htmljmlh.split(" ( - ");
                    var expldhrga = htmlhrga.split(" ( - ");
                    if (typeof expldjmlh[1] !== "undefined") {
                        var inputjmlh = (
                                "<input type='hidden' id='jumlahinput" + addresstr + "' value='" + expldjmlh[0] + "' />" +
                                "<input type='hidden' id='oprtorinput" + addresstr + "' value='" + expldjmlh[1].replace(" - )", "") + "' />"
                                );
                        var inputhrga = (
                                "<input type='hidden' id='harga_input" + addresstr + "' value='" + expldhrga[0] + "' />" +
                                "<input type='hidden' id='oprtr_input" + addresstr + "' value='" + expldhrga[1].replace(" - )", "") + "' />"
                                );
                    }
                    idjumlah.innerHTML = idjumlah.innerHTML + ((typeof inputjmlh !== "undefined") ? inputjmlh : "");
                    idsharga.innerHTML = idsharga.innerHTML + ((typeof inputhrga !== "undefined") ? inputhrga : "");

                    /* Get Reward */
                    var lireward = tdtd[(tdtd.length - 1)].getElementsByTagName("li");
                    var rowspans = lireward.length;
                    if (rowspans > 0) {
                        var trawalan = document.createElement("tr");
                        var tdawalan = document.createElement("td");
                        tdawalan.setAttribute("style", "vertical-align: middle");
                        tdawalan.setAttribute("rowspan", rowspans);
                        tdawalan.innerHTML = "<div style='width: 120px; text-align: right;'>Reward : </div>";
                        trawalan.appendChild(tdawalan);
                        tbdy.appendChild(trawalan);
                        for (var i = 0; i < lireward.length; i++) {
                            var isinya = lireward[i].innerText;
                            var explds = isinya.split(" : ");
                            if (explds.length === 1) {
                                if (i === 0) {
                                    var tdins = document.createElement("td");
                                    var prnts = lireward[i].parentNode;
                                    var lilic = prnts.getElementsByTagName("li");
                                    var htmls = prnts.innerText;
                                    var expld = htmls.split(" :");
                                    tdins.innerHTML = "&nbsp;" + expld[0];
                                    tdins.setAttribute("rowspan", lilic.length);
                                    tdins.setAttribute("colspan", "4");
                                    tdins.setAttribute("style", "vertical-align: middle");
                                    trawalan.appendChild(tdins);
                                    for (var j = 0; j < lilic.length; j++) {
                                        if (j === 0) {
                                            var tdind = document.createElement("td");
                                            tdind.innerHTML = "&nbsp;" + lilic[j].innerHTML;
                                            trawalan.appendChild(tdind);
                                            tbdy.appendChild(trawalan);
                                        } else {
                                            var trind = document.createElement("tr");
                                            var tdint = document.createElement("td");
                                            tdint.innerHTML = "&nbsp;" + lilic[j].innerHTML;
                                            trind.appendChild(tdint);
                                            tbdy.appendChild(trind);
                                        }
                                    }
                                    i = (i + lilic.length) - 1;
                                } else {
                                    var trins = document.createElement("tr");
                                    var tdins = document.createElement("td");
                                    var prnts = lireward[i].parentNode;
                                    var lilic = prnts.getElementsByTagName("li");
                                    var htmls = prnts.innerText;
                                    var expld = htmls.split(" :");
                                    tdins.innerHTML = "&nbsp;" + expld[0];
                                    tdins.setAttribute("rowspan", lilic.length);
                                    tdins.setAttribute("colspan", "4");
                                    tdins.setAttribute("style", "vertical-align: middle");
                                    trins.appendChild(tdins);
                                    for (var j = 0; j < lilic.length; j++) {
                                        if (j === 0) {
                                            var tdind = document.createElement("td");
                                            tdind.innerHTML = "&nbsp;" + lilic[j].innerHTML;
                                            trins.appendChild(tdind);
                                            tbdy.appendChild(trins);
                                        } else {
                                            var trind = document.createElement("tr");
                                            var tdint = document.createElement("td");
                                            tdint.innerHTML = "&nbsp;" + lilic[j].innerHTML;
                                            trind.appendChild(tdint);
                                            tbdy.appendChild(trind);
                                        }
                                    }
                                    i = (i + lilic.length) - 1;
                                }
                            } else {
                                if (i === 0) {
                                    var tdins = document.createElement("td");
                                    var tdinc = document.createElement("td");
                                    tdins.setAttribute("colspan", "4");
                                    tdins.innerHTML = "&nbsp;" + explds[0];
                                    tdinc.innerHTML = "&nbsp;" + explds[1];
                                    trawalan.appendChild(tdins);
                                    trawalan.appendChild(tdinc);
                                } else {
                                    var trins = document.createElement("tr");
                                    var tdins = document.createElement("td");
                                    var tdinc = document.createElement("td");
                                    tdins.setAttribute("colspan", "4");
                                    tdins.innerHTML = "&nbsp;" + explds[0];
                                    tdinc.innerHTML = "&nbsp;" + explds[1];
                                    trins.appendChild(tdins);
                                    trins.appendChild(tdinc);
                                    tbdy.appendChild(trins);
                                }
                            }
                        }
                    }
                    /* Kondisi Paket */
                    checkCondition();
                }
            }
            /* addresstr++; */
        } else {
            document.location = url_samamodal();
            document.getElementById("Alertnya").innerHTML = "Customer yang dipilih tidak terdapat di list.";
        }
    } else {
        document.location = url_samamodal();
        document.getElementById("Alertnya").innerHTML = "Customer harus dipilih dulu.";
    }
}

function setCampaignValue(nilai){
    if(document.getElementById("campaign")){
        $("#campaign").select2('val', nilai);
    }
}

$("#customer").change(function () {
    if(this.value !== ""){
        changecst = 1;
    } else {
        changecst = 0;
    }
    for(var i = 1; i <= counter_select_paket; i++){
        if(document.getElementById("paket" + i)){
            if(jumlah_select_paket > 1){
                var selectProduct = document.getElementById("paket" + i);
                var parent01 = selectProduct.parentNode;
                var parent02 = parent01.parentNode;
                parent02.parentNode.removeChild(parent02);
                jumlah_select_paket--;
            }
        }
    }
    for(var i = 1; i <= counter_select_paket; i++){
        if(document.getElementById("paket" + i)){
            $("#paket" + i).select2('val', "");
            $("#paket" + i).select2("enable", false);
        }
    }
    counter_select_paket = 0;
    
    var div01 = document.getElementById("tampilpaket");
    var div02 = document.getElementById("promotransaksi");
    var div03 = document.getElementById("tabeltransaksi");

    div01.innerHTML = "";
    div02.innerHTML = "";
    div03.innerHTML = "";
    
    if(document.getElementById("campaign")){
        $("#campaign").select2('val', '');
        $("#campaign").select2("enable", (this.value !== "") ? true : false);
    }
    
    if(document.getElementById("paket0")){
        $("#paket0").select2('val', '');
        $("#paket0").select2("enable", (this.value !== "") ? true : false);
    }
    
    if(document.getElementById("produk")){
        /* console.log("Masuk Produk"); */
        $("#produk").select2('val', '');
        $("#produk").select2("enable", (this.value !== "") ? true : false);
    }
    /* changecst = 0; */
});

var fontDisplay = document.getElementById("fontDisplay");
var fontRegular = document.getElementById("fontRegular");

var enableDisplay = 0;
var enableRegular = 1;

fontDisplay.onclick = function() {
    if(enableDisplay === 0) {
        this.style.color = 'blue';
        this.style.cursor = 'default';
        fontRegular.style.color = 'black';
        fontRegular.style.cursor = 'pointer';
        enableDisplay = 1;
        enableRegular = 0;
        if(document.getElementById("paket")){
            $("#paket").select2('val', '');
            $("#paket").select2("enable", false);
        }
    }
};

fontRegular.onclick = function() {
    if(enableRegular === 0) {
        this.style.color = 'blue';
        this.style.cursor = 'default';
        fontDisplay.style.color = 'black';
        fontDisplay.style.cursor = 'pointer';
        enableDisplay = 0;
        enableRegular = 1;
        if(document.getElementById("paket") && changecst === 1){
            $("#paket").select2('val', '');
            $("#paket").select2("enable", true);
        }
    }
};

beginNumber("diskonRequest", "regular");
getCustomerOrderEntry("GET", url_get("getCustomerByIdSales/"+sessionSales), "customer", false, "customer");
getProductOrderEntry("GET", url_get("getPoductByIdSales/"+sessionSales), "produk", false, "produk");