/* ---------------------------------------------------------------------- */
/* Pembuatan Paket */

var tbodypaket = "";
var tbodypaked = "";
var tbodypakes = "";
var divsspaket = "";
var divsspaked = "";
var isinapaket = "";
var namapakets = [];
var isipaketss = [];
var getpaketnm = [];
var setpaketnm = [];
var getcombine = [];
var strcombine = "";
var strparamtr = "";
var sprparamtr = "";
var addrsetpkt = 0;
var jmlhkmbnsi = 0;
var addrpakets = 0;
var callcombns = 0;
var counternya = 1;
var mkombinasi = 0;
var paketsadds = 0;
var tampunghdd = document.getElementById("tampunghidden");
var tampungcmp = document.getElementById("tampungcampgn");
var addspakets = document.getElementById("addpaket");

/* variabel edit */
var channledit = "";
var areassedit = "";
var brandsedit = "";
var ktgoriedit = "";
var channinner = "";
var areasinner = "";
var brandinner = "";
var ktgorinner = "";

var nmpkttmprs = "";
var kmbnstmprs = "";
var channtmprs = "";
var areastmprs = "";
var brandtmprs = "";
var ktgrstmprs = "";
var prmtrarrss = [];
var rewrdtmprs = "";
var namedivprm = "";

var nmpktvalss = "";
var nmpktaddrs = "";
var changedble = "";
var channvalss = "";
var areasvalss = "";
var brandvalss = "";
var ktgrsvalss = "";
var prmtrvalss = [];
var mndtrvalss = [];
var rewrdvalss = [];

var temporartd = "";
var stabletrss =  0;

var edithidden = "";
var mdtrhidden = "";
var paramedits = "";
var rfrshprgss =  0;

var divsubahsl =  0;
var mandatorys = "";

for (var i = 0; i < paramarr.length; i++) {
    strparamtr = strparamtr + sprparamtr + paramarr[i];
    sprparamtr = "-";
    var objs = document.getElementById("ID_" + paramarr[i]);
    if (objs.getAttribute("modelinput") === "select") {
        objs.tampung = [];
        $("#ID_" + paramarr[i]).change(function () {
            this.tampung = $(this).val();
            /* console.log("Ubah"); */
            editParameter(this.tampung,this.getAttribute("id"));
            /* console.log($(this).val()); */
        });
    }
    if (objs.getAttribute("modelinput") === "text") {
        if (objs.getAttribute("inputannya") === "Money") {
            beginNumber("ID_" + paramarr[i]);
        }
        if (objs.getAttribute("inputannya") === "Number") {
            beginNumber("ID_" + paramarr[i], "regular");
        }
        objs.onblur = function(){
            /* console.log("Test Test Coba Text"); */
            editParameter(this.value,this.getAttribute("id"),"text");
        };
    }
}

function getList(arrs,vlid) {
    if(arrs !== null && arrs.length > 0){
        var result = "<ul>";
        for (var i = 0; i < arrs.length; i++) {
            var ob = (typeof vlid !== "undefined") ? document.getElementById(vlid) : "";
            var op = (typeof ob === "object") ? ob.getElementsByTagName("option") : "";
            var vl = arrs[i];
            if(op !== ""){
                for(var k = 0; k < op.length; k++){
                    if(op[k].getAttribute("labelnya") === vlid + "--" + arrs[i]){
                        vl = op[k].innerHTML;
                    }
                }
            }
            result = result + "<li>" + vl + "</li>";
        }
        result = result + "</ul>";
        return result;
    }
    return "";
}

function gethidden(arrs) {
    var result = "";
    var pnghbn = "";
    if(arrs !== null){
        for (var i = 0; i < arrs.length; i++) {
            result = result + pnghbn + arrs[i];
            pnghbn = "-";
        }
    }
    return result;
}

function kombinasipaket() {
    /* console.log(isipaketss); */
    var samaar = 0;
    if (samaar === 0) {
        if (strcombine !== "") {
            if (typeof getcombine[strcombine] !== "undefined") {
                samaar = 1;
                document.location = url_samamodal();
                document.getElementById("Alertnya").innerHTML = "Kombinasi paket telah tersedia.";
            }
        }
    }
    if (samaar === 0) {
        mkombinasi = 1;
        callcombns = 1;
        jmlhkmbnsi = jmcmb;
        for (var i = 0; i < jmlhkmbnsi; i++) {
            getpaketnm = isipaketss[cmbns[i]];
            beginPackage();
        }
        var tbodynya = document.getElementById("tbodypaket");
        var tbodyttr = tbodynya.getElementsByTagName("tr");
        var totalttr = tbodyttr.length;
        var alamattr = totalttr - jmlhkmbnsi;
        for (var i = 0; i < jmlhkmbnsi; i++) {
            var tdtd = tbodyttr[alamattr].getElementsByTagName("td");
            if (i === 0) {
                tdtd[0].setAttribute("rowspan", jmlhkmbnsi);
                tdtd[0].setAttribute("style", "vertical-align: middle;");
                tdtd[(tdtd.length - 1)].setAttribute("rowspan", jmlhkmbnsi);
                tdtd[(tdtd.length - 1)].setAttribute("style", "vertical-align: middle;");
                for(var j = 0; j < tdtd.length; j++){
                    var divs = tdtd[j].getElementsByTagName("div");
                    var idna = divs[0].getAttribute("id");
                    var fontnya = tdtd[j].getElementsByTagName("font");
                    if(fontnya[0]){
                        fontnya[0].parentNode.removeChild(fontnya[0]);
                    }
                    if(checkString(idna,"channel") || checkString(idna,"area") || checkString(idna,"brand") || checkString(idna,"kategori") || checkString(idna,"Harga") || checkString(idna,"Quantity")){
                        tdtd[j].setAttribute("rowspan", jmlhkmbnsi);
                        tdtd[j].setAttribute("style", "vertical-align: middle;");
                        if(checkString(idna,"Harga")){
                            tdtd[j].innerHTML = "<font style='color: blue; cursor: pointer;'>( + )</font>";
                        }
                        if(checkString(idna,"Quantity")){
                            tdtd[j].innerHTML = "<font style='color: blue; cursor: pointer;'>( + )</font>";
                        }
                    } 
                }
            } else {
                tdtd[0].parentNode.removeChild(tdtd[0]);
                tdtd[(tdtd.length - 1)].parentNode.removeChild(tdtd[(tdtd.length - 1)]);
                for(var j = 0; j < tdtd.length; j++){
                    var divs = tdtd[j].getElementsByTagName("div");
                    var idna = divs[0].getAttribute("id");
                    if(checkString(idna,"channel") || checkString(idna,"area") || checkString(idna,"brand") || checkString(idna,"kategori") || checkString(idna,"Harga") || checkString(idna,"Quantity")){
                        tdtd[j].parentNode.removeChild(tdtd[j]);
                        j = j - 1;
                    } 
                }
            }
            alamattr++;
        }
        $("#formkombinasi").slideUp("slow");
        callcombns = 0;
        mkombinasi = 0;
        getcombine[strcombine] = true;
    }
}

function button_reward(idname, start, jmlhbt) {
    for (var i = start; i <= jmlhbt; i++) {
        /* console.log("Inject ID : " + idname + i); */
        $("#" + idname + i).click(function () {
            $("#formlabel").slideUp("slow");
            $("#formsubmit").slideUp("slow");
            $("#formkombinasi").slideUp("slow");
            for (var i = 0; i < paramarr.length; i++) {
                $("#step-Package" + paramarr[i] + (i + 1)).slideUp("slow");
            }
            $("#formreward").slideDown("slow");
            bariskeReward = this.getAttribute("bariske");
        });
    }
}

function begincopy(objs){
    if(counternya === 1 && tbodypaket === "" && addrsetpkt === 0){
        if(typeof alamatcaunt !== "undefined" && typeof tbodyinnerd !== "undefined"){
            counternya = alamatcaunt + 1;
            tbodypaket = tbodyinnerd;
            addrsetpkt = alamatcaunt;
        }
    }
    if(objs.getAttribute("style") === "background-color: rgba(0, 0, 0, 0.08);"){
        objs.removeAttribute("style");
        var pkts = document.getElementById("addpaket");
        
        nmpkttmprs = "";
        kmbnstmprs = "";
        channtmprs = "";
        areastmprs = "";
        brandtmprs = "";
        ktgrstmprs = "";
        prmtrarrss = [];
        rewrdtmprs = "";
        
        nmpktvalss = "";
        channvalss = "";
        areasvalss = "";
        brandvalss = "";
        ktgrsvalss = "";
        prmtrvalss = [];
        mndtrvalss = [];
        rewrdvalss = [];
        
        pkts.innerHTML = "Add Package";
        
        if(document.getElementById("pemisahs")){
            document.getElementById("pemisahs").parentNode.removeChild(document.getElementById("pemisahs"));
        }
        if(document.getElementById("dllpaket")){
            document.getElementById("dllpaket").parentNode.removeChild(document.getElementById("dllpaket"));
        }
    } else {
        var prnt = objs.parentNode;
        var trtr = prnt.getElementsByTagName("tr");
        for(var i = 0; i< trtr.length; i++){
            trtr[i].removeAttribute("style");
        }
        if(stabletrss === 0){   
            if(typeof temporartd === "object"){
                temporartd.removeAttribute("style");
                temporartd = "";
            }
            var dvhdd = document.getElementById("tampunghidden");
            var inphd = dvhdd.getElementsByTagName("input");
            var adrtr = Number(objs.getAttribute("alamatnya")) - 1;
            var tempr = objs.innerHTML;
            var finds = "<isian>";
            var findd = "</isian>";
            var fibr1 = "<br>";
            var fibr2 = "</br>";
            var fibr3 = "<br />";
            var tag01 = new RegExp(finds, "g");
            var tag02 = new RegExp(findd, "g");
            var tag03 = new RegExp(fibr1, "g");
            var tag04 = new RegExp(fibr2, "g");
            var tag05 = new RegExp(fibr3, "g");
            objs.innerHTML = objs.innerHTML.replace(tag01, "");
            objs.innerHTML = objs.innerHTML.replace(tag02, "");
            objs.innerHTML = objs.innerHTML.replace(tag03, "");
            objs.innerHTML = objs.innerHTML.replace(tag04, "");
            objs.innerHTML = objs.innerHTML.replace(tag05, "");

            objs.setAttribute("style","background-color: rgba(0, 0, 0, 0.08);");
            var prnt = objs.parentNode;
            var trch = prnt.getElementsByTagName("tr");
            var pkts = document.getElementById("addpaket");
            var divs = objs.getElementsByTagName("div");
            for(var i = 0; i < trch.length; i++){
                if(trch[i].getAttribute("style") === "background-color: rgba(0, 0, 0, 0.08);"){
                    nmpktaddrs = i;
                    break;
                }
            }
            for(var i = 0; i < inphd.length; i++){
                if(inphd[i].getAttribute("labelnya") === "namapaket" + adrtr.toString()){
                    nmpktvalss = inphd[i].value + "_cp" + trtr.length;
                }
                if(inphd[i].getAttribute("labelnya") === "channelpaket" + adrtr.toString()){
                    channvalss = inphd[i].value;
                }
                if(inphd[i].getAttribute("labelnya") === "areapaket" + adrtr.toString()){
                    areasvalss = inphd[i].value;
                }
                if(inphd[i].getAttribute("labelnya") === "brandpaket" + adrtr.toString()){
                    brandvalss = inphd[i].value;
                }
                if(inphd[i].getAttribute("labelnya") === "kategoripaket" + adrtr.toString()){
                    ktgrsvalss = inphd[i].value;
                }
            }
            nmpkttmprs = (divs[2].getElementsByTagName("ul").length > 0 || divs[2].innerHTML.split("( - ").length > 1) ? ("<isian>" + divs[0].innerHTML + "_cp" + trtr.length + ((divs[0].innerHTML.split("( - ").length > 1) ? "<br />" : "") + "</isian>") : "";
            kmbnstmprs = (divs[1].getElementsByTagName("ul").length > 0 || divs[1].innerHTML.split("( - ").length > 1) ? ("<isian>" + divs[1].innerHTML + ((divs[1].getElementsByTagName("ul").length === 0 || divs[1].innerHTML.split("( - ").length > 1) ? "<br />" : "") + "</isian>") : "";
            channtmprs = (divs[2].getElementsByTagName("ul").length > 0 || divs[2].innerHTML.split("( - ").length > 1) ? ("<isian>" + divs[2].innerHTML + ((divs[2].getElementsByTagName("ul").length === 0 || divs[2].innerHTML.split("( - ").length > 1) ? "<br />" : "") + "</isian>") : "";
            areastmprs = (divs[3].getElementsByTagName("ul").length > 0 || divs[3].innerHTML.split("( - ").length > 1) ? ("<isian>" + divs[3].innerHTML + ((divs[3].getElementsByTagName("ul").length === 0 || divs[3].innerHTML.split("( - ").length > 1) ? "<br />" : "") + "</isian>") : "";
            brandtmprs = (divs[4].getElementsByTagName("ul").length > 0 || divs[4].innerHTML.split("( - ").length > 1) ? ("<isian>" + divs[4].innerHTML + ((divs[4].getElementsByTagName("ul").length === 0 || divs[4].innerHTML.split("( - ").length > 1) ? "<br />" : "") + "</isian>") : "";
            ktgrstmprs = (divs[5].getElementsByTagName("ul").length > 0 || divs[5].innerHTML.split("( - ").length > 1) ? ("<isian>" + divs[5].innerHTML + ((divs[5].getElementsByTagName("ul").length === 0 || divs[5].innerHTML.split("( - ").length > 1) ? "<br />" : "") + "</isian>") : "";
            var addrss = 6;
            for (var i = 0; i < paramarr.length; i++) {
                for(var j = 0; j < inphd.length; j++){
                    if(inphd[j].getAttribute("labelnya") === "parameterValue" + i + "_" + adrtr.toString()){
                        prmtrvalss[i] = inphd[j].value;
                    }
                    if(inphd[j].getAttribute("labelnya") === "parameterAddition" + i + "_" + adrtr.toString()){
                        mndtrvalss[i] = inphd[j].value;
                    }
                }
                prmtrarrss[i] = (divs[addrss].getElementsByTagName("ul").length > 0 || divs[addrss].innerHTML.split("( - ").length > 1) ? ("<isian>" + divs[addrss].innerHTML + ((divs[addrss].getElementsByTagName("ul").length === 0 || divs[addrss].innerHTML.split("( - ").length > 1) ? "<br />" : "") + "</isian>") : "";
                prmtrarrss[i] = (divs[addrss].getElementsByTagName("ul").length === 0 && divs[addrss].innerHTML.split("( - ").length > 1) ? prmtrarrss[i].replace(new RegExp("<br />", "g"),"").replace("( - ","<br />( - ").replace("</isian>","</isian><br />") : prmtrarrss[i];
                prmtrarrss[i] = (divs[addrss].getElementsByTagName("ul").length > 0) ? prmtrarrss[i].replace(new RegExp("<br />", "g"),"").replace("</isian>","</isian><br />") : prmtrarrss[i];
                addrss++;
            }
            for (var i = 0; i < rewrdarr.length; i++) {
                for(var j = 0; j < inphd.length; j++){
                    if(inphd[j].getAttribute("labelnya") === "reward_" + rewrdarr[i] + adrtr.toString()){
                        rewrdvalss[rewrdarr[i]] = inphd[j].value;
                        /* console.log("Set for Temprary Reward."); */
                    }
                }
            }
            /*
            console.log("Temprary Reward : ");
            console.log(rewrdvalss); */
            rewrdtmprs = divs[addrss].innerHTML;
            /* console.log(rewrdtmprs); */
            pkts.innerHTML = "Copy Package";
            objs.innerHTML = tempr;
            
            if(!document.getElementById("pemisahs") && !document.getElementById("dllpaket") && trtr.length > 1){
                var fontpshs = document.createElement("font");
                var fonthpss = document.createElement("font");
                fontpshs.setAttribute("id","pemisahs");
                fonthpss.setAttribute("id","dllpaket");
                fonthpss.setAttribute("style","cursor: pointer; color: blue;");
                fonthpss.innerHTML = "Delete Package";
                fontpshs.innerHTML = " - ";
                pkts.parentNode.appendChild(fontpshs);
                pkts.parentNode.appendChild(fonthpss);
            }
            hapusPaketnya(objs);
            button_reward("addreward", 1, trtr.length);
        }
    }
    ubahbarisBaseParameter();
    stabletrss = 0;
}

function hapusPaketnya(objs){
    if(document.getElementById("dllpaket")){
        document.getElementById("dllpaket").onclick = function(){
            nmpkttmprs = "";
            kmbnstmprs = "";
            channtmprs = "";
            areastmprs = "";
            brandtmprs = "";
            ktgrstmprs = "";
            prmtrarrss = [];
            rewrdtmprs = "";
            
            $(".selectpackage option:eq("+nmpktaddrs+")").remove();
            delete namapakets[nmpktaddrs];
            namapakets.filter (function () {return true;});
            /* $(".selectpackage option[value='"+nmpktaddrs+"']").remove(); */
            /* $(".selectpackage").select2(); */
            nmpktvalss = "";
            nmpktaddrs = "";
            channvalss = "";
            areasvalss = "";
            brandvalss = "";
            ktgrsvalss = "";
            prmtrvalss = [];
            mndtrvalss = [];
            rewrdvalss = [];
            
            var alamatTR = Number(objs.getAttribute("alamatnya"));
            var alamatIN = alamatTR - 1;
            var dvhdd = document.getElementById("tampunghidden");
            var inphd = dvhdd.getElementsByTagName("input");
            for(var i = 0; i < inphd.length; i++){
                if(inphd[i] && inphd[i].getAttribute("labelnya") === "namapaket" + alamatIN.toString()){
                    inphd[i].parentNode.removeChild(inphd[i]);
                }
                if(inphd[i] && inphd[i].getAttribute("labelnya") === "kombinasipaket" + alamatIN.toString()){
                    inphd[i].parentNode.removeChild(inphd[i]);
                }
                if(inphd[i] && inphd[i].getAttribute("labelnya") === "channelpaket" + alamatIN.toString()){
                    inphd[i].parentNode.removeChild(inphd[i]);
                }
                if(inphd[i] && inphd[i].getAttribute("labelnya") === "areapaket" + alamatIN.toString()){
                    inphd[i].parentNode.removeChild(inphd[i]);
                }
                if(inphd[i] && inphd[i].getAttribute("labelnya") === "brandpaket" + alamatIN.toString()){
                    inphd[i].parentNode.removeChild(inphd[i]);
                }
                if(inphd[i] && inphd[i].getAttribute("labelnya") === "kategoripaket" + alamatIN.toString()){
                    inphd[i].parentNode.removeChild(inphd[i]);
                }
                for (var j = 0; j < paramarr.length; j++) {
                    if(inphd[i] && inphd[i].getAttribute("labelnya") === "parameterValue" + j + "_" + alamatIN.toString()){
                        inphd[i].parentNode.removeChild(inphd[i]);
                    }
                    if(inphd[i] && inphd[i].getAttribute("labelnya") === "parameterAddition" + j + "_" + alamatIN.toString()){
                        inphd[i].parentNode.removeChild(inphd[i]);
                    }
                }
                for (var j = 0; j < rewrdarr.length; j++) {
                    if(inphd[i] && inphd[i].getAttribute("labelnya") === "reward_" + rewrdarr[j] + alamatIN.toString()){
                        inphd[i].parentNode.removeChild(inphd[i]);
                    }
                }
            }
            if(document.getElementById("pemisahs")){
                document.getElementById("pemisahs").parentNode.removeChild(document.getElementById("pemisahs"));
            }
            if(document.getElementById("dllpaket")){
                document.getElementById("dllpaket").parentNode.removeChild(document.getElementById("dllpaket"));
            }
            objs.parentNode.removeChild(objs);
        };
    }
}

function getInputHidden(param){
    /* console.log(param); */
    var inpud = tampunghdd.getElementsByTagName("input");
    var reslt = false;
    for(var i = 0; i < inpud.length; i++){
        if(inpud[i].getAttribute("labelnya") === param){
            reslt = inpud[i];
            break;
        }
    }
    return reslt;
}

function ubahbarisBaseParameter(){
    for(var i = 0; i <= addrsetpkt; i++){
        var pktmb = (document.getElementById("packagename"+i)) ? document.getElementById("packagename"+i) : {};
        var chann = (document.getElementById("channeledit"+i)) ? document.getElementById("channeledit"+i) : {};
        var areas = (document.getElementById("areaedit"+i)) ? document.getElementById("areaedit"+i) : {};
        var brand = (document.getElementById("brandedit"+i)) ? document.getElementById("brandedit"+i) : {};
        var ktgri = (document.getElementById("kategoriedit"+i)) ? document.getElementById("kategoriedit"+i) : {};
        var ichnn = 0;
        var iarea = 0;
        var ibrnd = 0;
        var iktgr = 0;
        pktmb.onclick = function(){
            /* console.log("Package Name Click."); */
            areassedit = "";
            brandsedit = "";
            channledit = "";
            ktgoriedit = "";
            edithidden = "";
            if(typeof temporartd === "object" && temporartd !== this.parentNode.parentNode){
                temporartd.removeAttribute("style");
            }
            if(namedivprm !== ""){
                $("#" + namedivprm).slideUp("slow");
            }
            stabletrss = 1;
            temporartd = this.parentNode.parentNode;
            var tdprnt = this.parentNode.parentNode;
            var trprnt = tdprnt.parentNode;
            var tbprnt = trprnt.parentNode;
            var trchld = tbprnt.getElementsByTagName("tr");
            var addrtr = 0;
            tdprnt.setAttribute("style","background-color: rgba(255, 0, 0, 0.08);");
            var buttonhidden = this.getAttribute("buttonhidden");
            var parentdiv = this.getAttribute("parentdiv");
            var hidebuttn = document.getElementById(buttonhidden);
            var typelabel = document.getElementById("tipeLabel");
            var inputpkts = document.getElementById("inputpaket");
            refreshformBaseParameter();
            for(var i = 0; i < trchld.length; i++){
                var tdchld = trchld[i].getElementsByTagName("td");
                var ibreak = 0;
                for(var j = 0; j < tdchld.length; j++){
                    if(tdchld[j].getAttribute("style") === "background-color: rgba(255, 0, 0, 0.08);"){
                        addrtr = (i + 1);
                        ibreak = 1;
                        break;
                    }
                }
                if(ibreak === 1){
                    break;
                }
            }
            $("#" + parentdiv).slideDown("slow",function(){
                document.location = url_pagar("footerpart");
            });
            typelabel.style.display = "none";
            hidebuttn.style.display = "none";
            edithidden = getInputHidden(this.getAttribute("labelinput"));
            paramedits = this.parentNode;
            namedivprm = parentdiv;
            changedble = "true";
            inputpkts.onblur = function(){
                /* console.log("Ubah Paket");
                var nilaiubah = (nmpktaddrs === "") ? this.value : nmpktaddrs;
                $('.selectpackage option:contains("'+nilaiubah+'")').text(this.value);
                $(".selectpackage option[value='"+nilaiubah+"']").val(this.value);
                /* $(".selectpackage").select2(); */
                if(changedble === "true"){
                    $(".selectpackage option:eq("+addrtr+")").text(this.value);
                    $(".selectpackage option:eq("+addrtr+")").val(this.value);
                    namapakets[(addrtr - 1)] = this.value;
                    htmlt = divss.innerHTML;
                    /*
                    console.log("Inside inputpkts.onblur");
                    console.log(htmlt);
                    console.log("\n"); */
                    editParameter(this.value,this.getAttribute("id"),"text");
                }
            };
        };
        chann.onclick = function(){
            /*
            console.log("Channeledit Click.");
            console.log("\n"); */
            document.location = url_pagar("step-1");
            var idubh = this.getAttribute("idubah");
            var idhde = this.getAttribute("idhide");
            var chanl = document.getElementById("channeldiv");
            var arean = document.getElementById("areaawal");
            var buttn = document.getElementById("button_step-3");
            iarea = 0;
            ibrnd = 0;
            iktgr = 0;
            if(typeof temporartd === "object" && temporartd !== this.parentNode.parentNode){
                temporartd.removeAttribute("style");
            }
            stabletrss = 1;
            temporartd = this.parentNode.parentNode;
            var tdprnt = this.parentNode.parentNode;
            tdprnt.setAttribute("style","background-color: rgba(255, 0, 0, 0.08);");
            areassedit = "";
            brandsedit = "";
            ktgoriedit = "";
            refreshformBaseParameter();
            edithidden = getInputHidden(this.getAttribute("labelinput"));
            channledit = this.parentNode;
            $("#" + idubh).slideUp("slow",function(){
                if(ichnn === 0){
                    chanl.style.display = "block";
                    arean.style.display = "none";
                    buttn.style.display = "none";
                    $("#" + idubh).slideDown("slow");
                    ichnn = 1;
                }
            });
            $("#" + idhde).slideUp("slow",function(){
                if(ichnn === 1){
                    chanl.style.display = "block";
                    arean.style.display = "none";
                    buttn.style.display = "none";
                    $("#" + idubh).slideDown("slow");
                }
            });
        };
        areas.onclick = function(){
            /*
            console.log("Arealedit Click.");
            console.log("\n"); */
            document.location = url_pagar("step-1");
            var idubh = this.getAttribute("idubah");
            var idhde = this.getAttribute("idhide");
            var arean = document.getElementById("areaawal");
            var chanl = document.getElementById("channeldiv");
            var buttn = document.getElementById("button_step-3");
            ichnn = 0;
            ibrnd = 0;
            iktgr = 0;
            if(typeof temporartd === "object" && temporartd !== this.parentNode.parentNode){
                temporartd.removeAttribute("style");
            }
            stabletrss = 1;
            temporartd = this.parentNode.parentNode;
            var tdprnt = this.parentNode.parentNode;
            tdprnt.setAttribute("style","background-color: rgba(255, 0, 0, 0.08);");
            brandsedit = "";
            ktgoriedit = "";
            channledit = "";
            refreshformBaseParameter();
            edithidden = getInputHidden(this.getAttribute("labelinput"));
            areassedit = this.parentNode;
            $("#" + idubh).slideUp("slow",function(){
                if(iarea === 0){
                    arean.style.display = "block";
                    chanl.style.display = "none";
                    buttn.style.display = "none";
                    $("#" + idubh).slideDown("slow");
                    iarea = 1;
                }
            });
            $("#" + idhde).slideUp("slow",function(){
                if(iarea === 1){
                    arean.style.display = "block";
                    chanl.style.display = "none";
                    buttn.style.display = "none";
                    $("#" + idubh).slideDown("slow");
                }
            });
        };
        brand.onclick = function(){
            /*
            console.log("Brandedit Click.");
            console.log("\n"); */
            document.location = url_pagar("step-1");
            var idubh = this.getAttribute("idubah");
            var idhde = this.getAttribute("idhide");
            var brand = document.getElementById("branddiv");
            var ktgri = document.getElementById("kategoridiv");
            var buttn = document.getElementById("button_step-4");
            ichnn = 0;
            iarea = 0;
            iktgr = 0;
            if(typeof temporartd === "object" && temporartd !== this.parentNode.parentNode){
                temporartd.removeAttribute("style");
            }
            stabletrss = 1;
            temporartd = this.parentNode.parentNode;
            var tdprnt = this.parentNode.parentNode;
            tdprnt.setAttribute("style","background-color: rgba(255, 0, 0, 0.08);");
            areassedit = "";
            ktgoriedit = "";
            channledit = "";
            refreshformBaseParameter();
            edithidden = getInputHidden(this.getAttribute("labelinput"));
            brandsedit = this.parentNode;
            $("#" + idubh).slideUp("slow",function(){
                if(ibrnd === 0){
                    brand.style.display = "block";
                    ktgri.style.display = "none";
                    buttn.style.display = "none";
                    $("#" + idubh).slideDown("slow");
                    ibrnd = 1;
                }
            });
            $("#" + idhde).slideUp("slow",function(){
                if(ibrnd === 1){
                    brand.style.display = "block";
                    ktgri.style.display = "none";
                    buttn.style.display = "none";
                    $("#" + idubh).slideDown("slow");
                }
            });
        };
        ktgri.onclick = function(){
            /*
            console.log("Kategoriedit Click.");
            console.log("\n"); */
            document.location = url_pagar("step-1");
            var idubh = this.getAttribute("idubah");
            var idhde = this.getAttribute("idhide");
            var ktgri = document.getElementById("kategoridiv");
            var brand = document.getElementById("branddiv");
            var buttn = document.getElementById("button_step-4");
            ichnn = 0;
            iarea = 0;
            ibrnd = 0;
            if(typeof temporartd === "object" && temporartd !== this.parentNode.parentNode){
                temporartd.removeAttribute("style");
            }
            stabletrss = 1;
            temporartd = this.parentNode.parentNode;
            var tdprnt = this.parentNode.parentNode;
            tdprnt.setAttribute("style","background-color: rgba(255, 0, 0, 0.08);");
            areassedit = "";
            brandsedit = "";
            channledit = "";
            refreshformBaseParameter();
            edithidden = getInputHidden(this.getAttribute("labelinput"));
            ktgoriedit = this.parentNode;
            $("#" + idubh).slideUp("slow",function(){
                if(iktgr === 0){
                    ktgri.style.display = "block";
                    brand.style.display = "none";
                    buttn.style.display = "none";
                    $("#" + idubh).slideDown("slow");
                    iktgr = 1;
                }
            });
            $("#" + idhde).slideUp("slow",function(){
                if(iktgr === 1){
                    ktgri.style.display = "block";
                    brand.style.display = "none";
                    buttn.style.display = "none";
                    $("#" + idubh).slideDown("slow");
                }
            });
        };
        for (var j = 0; j < paramarr.length; j++) {
            if(document.getElementById(paramarr[j] + i)){
                var idnya = document.getElementById(paramarr[j] + i);
                idnya.onclick = function(){
                    areassedit = "";
                    brandsedit = "";
                    channledit = "";
                    ktgoriedit = "";
                    edithidden = "";
                    if(typeof temporartd === "object" && temporartd !== this.parentNode.parentNode){
                        temporartd.removeAttribute("style");
                    }
                    if(namedivprm !== ""){
                        $("#" + namedivprm).slideUp("slow");
                    }
                    stabletrss = 1;
                    temporartd = this.parentNode.parentNode;
                    var tdprnt = this.parentNode.parentNode;
                    tdprnt.setAttribute("style","background-color: rgba(255, 0, 0, 0.08);");
                    var buttonhidden = this.getAttribute("buttonhidden");
                    var parentdiv = this.getAttribute("parentdiv");
                    var hidebuttn = document.getElementById(buttonhidden);
                    refreshformBaseParameter();
                    $("#" + parentdiv).slideDown("slow",function(){
                        document.location = url_pagar("footerpart");
                    });
                    hidebuttn.style.display = "none";
                    edithidden = getInputHidden(this.getAttribute("labelvalue"));
                    mdtrhidden = getInputHidden(this.getAttribute("labeladdition"));
                    paramedits = this.parentNode;
                    namedivprm = parentdiv;
                };
            }
        }
    }
}

function editParameter(param,idname,text){
    /* console.log(paramedits); */
    if(typeof paramedits === "object"){
        /* console.log(paramedits); */
        var isian = paramedits.getElementsByTagName("isian");
         if(isian[0]){
            isian[0].parentNode.removeChild(isian[0]);
        }
        var temps = paramedits.innerHTML;
        var brbrs = idname !== "inputpaket" ? "<br />" : "";
        paramedits.innerHTML = (typeof text !== "undefined" && text === "text") ? 
            "<isian>" + param + brbrs + "</isian>" + temps : 
            "<isian>" + getList(param,idname) + "</isian>" + temps;
        /*
        console.log(paramedits.innerHTML);
        console.log("\n"); */
        isian = paramedits.getElementsByTagName("isian");
        mandatorys = isian[0];
        if(typeof edithidden === "object") {
            edithidden.value = (typeof text !== "undefined" && text === "text") ? param : gethidden(param);
        }
        if(addrsetpkt > 1){
            ubahbarisBaseParameter();
        }
    }
}

function barispaket(counternya, paketnya) {
    for (var i = 0; i < paramarr.length; i++) {
        var pkts = document.getElementById("inputpaket");
        var pktd = document.getElementById("namapaket" + counternya.toString());
        var chnn = document.getElementById("channelpaket" + counternya.toString());
        var area = document.getElementById("areapaket" + counternya.toString());
        var brnd = document.getElementById("brand" + counternya.toString());
        var ktgr = document.getElementById("kategori" + counternya.toString());
        var kmbn = document.getElementById("kombinasipaket" + counternya.toString());
        var objs = document.getElementById("ID_" + paramarr[i]);
        var objd = document.getElementById("baris" + paramarr[i].toString() + counternya.toString());
        if (i === 0) {
            var paketnmfnt = "<br /><font style='cursor: pointer; color: blue;' id='packagename"+addrsetpkt+"' parentdiv='formlabel' buttonhidden='formlabelButton' labelinput='namapaket"+addrsetpkt+"'>( + )</font>";
            var chnnsnmfnt = "<font style='cursor: pointer; color: blue;' idhide='step-4' idubah='step-3' alamat='"+addrsetpkt+"' id='channeledit"+addrsetpkt+"' labelinput='channelpaket"+addrsetpkt+"'>( + )</font>";
            var areasnmfnt = "<font style='cursor: pointer; color: blue;' idhide='step-4' idubah='step-3' alamat='"+addrsetpkt+"' id='areaedit"+addrsetpkt+"' labelinput='areapaket"+addrsetpkt+"'>( + )</font>";
            var brandnmfnt = "<font style='cursor: pointer; color: blue;' idhide='step-3' idubah='step-4' alamat='"+addrsetpkt+"' id='brandedit"+addrsetpkt+"' labelinput='brandpaket"+addrsetpkt+"'>( + )</font>";
            var ktgrinmfnt = "<font style='cursor: pointer; color: blue;' idhide='step-3' idubah='step-4' alamat='"+addrsetpkt+"' id='kategoriedit"+addrsetpkt+"' labelinput='kategoripaket"+addrsetpkt+"'>( + )</font>";
            pktd.innerHTML = (!paketsadds) ? "<isian>" + pkts.value + "</isian>" + paketnmfnt : nmpkttmprs + paketnmfnt; /* Nama Paket */
            kmbn.innerHTML = (!paketsadds) ? ((typeof paketnya !== "undefined" && typeof paketnya === "object") ? paketnya[0] : "Single Package") : "Single Package"; /* Tipe Paket */
            chnn.innerHTML = (!paketsadds) ? ((typeof paketnya !== "undefined" && typeof paketnya === "object") ? paketnya[1] : "<isian>" + getList(getchannel()) + "</isian>" + chnnsnmfnt) : channtmprs + chnnsnmfnt; /* Channel */
            area.innerHTML = (!paketsadds) ? ((typeof paketnya !== "undefined" && typeof paketnya === "object") ? paketnya[2] : "<isian>" + getList(getarea(),"piliharea") + "</isian>" + areasnmfnt) : areastmprs + areasnmfnt; /* Area */
            brnd.innerHTML = (!paketsadds) ? ((typeof paketnya !== "undefined" && typeof paketnya === "object") ? paketnya[3] : "<isian>" + getList(getbrand()) + "</isian>" + brandnmfnt) : brandtmprs + brandnmfnt; /* Brand */
            ktgr.innerHTML = (!paketsadds) ? ((typeof paketnya !== "undefined" && typeof paketnya === "object") ? paketnya[4] : "<isian>" + getList(getkategori()) + "</isian>" + ktgrinmfnt) : ktgrstmprs + ktgrinmfnt; /* Kategori */
            var getcombine = (typeof paketnya !== "undefined" && typeof paketnya === "object") ? $("#tipepaket").val() : "Single Package";
            if (typeof paketnya === "undefined") {
                tampunghdd.innerHTML = (
                        tampunghdd.innerHTML +
                        "<input type='hidden' name='namapaket[]' value='" + ((!paketsadds) ? pkts.value : nmpktvalss) + "' id='paket' labelnya='namapaket"+addrsetpkt+"' />" +
                        "<input type='hidden' name='kombinasipaket[]' value='" + getcombine + "' labelnya='kombinasipaket"+addrsetpkt+"' />" +
                        "<input type='hidden' name='channelpaket[]' value='" + ((!paketsadds) ? gethidden(getchannel()) : channvalss) + "' labelnya='channelpaket"+addrsetpkt+"' />" +
                        "<input type='hidden' name='areapaket[]' value='" + ((!paketsadds) ? gethidden(getarea()) : areasvalss) + "' labelnya='areapaket"+addrsetpkt+"' />" +
                        "<input type='hidden' name='brandpaket[]' value='" + ((!paketsadds) ? gethidden(getbrand()) : brandvalss) + "' labelnya='brandpaket"+addrsetpkt+"' />" +
                        "<input type='hidden' name='kategoripaket[]' value='" + ((!paketsadds) ? gethidden(getkategori()) : ktgrsvalss) + "' labelnya='kategoripaket"+addrsetpkt+"' />"
                        );
            } else {
                tampunghdd.innerHTML = (
                        tampunghdd.innerHTML +
                        "<input type='hidden' name='notsingle[" + pkts.value.replace(/\s/g, "_") + "][]' value='" + paketnya[0] + "' />" +
                        "<input type='hidden' name='kombinasipaket[" + pkts.value.replace(/\s/g, "_") + "][]' value='" + getcombine + " Package' />"
                        );
            }
            if(rewrdtmprs !== ""){
                var isiDiv = document.getElementById("reward" + counternya).innerHTML;
                var ulDivs = document.getElementById("reward" + counternya).getElementsByTagName("ul");
                var fontss = document.getElementById("reward" + counternya).getElementsByTagName("font");
                if(ulDivs.length > 0){
                    fontss[0].parentNode.removeChild(fontss[0]);
                    document.getElementById("reward" + counternya).innerHTML = rewrdtmprs + isiDiv;
                }
            }
            button_reward("addreward", 1, counternya);
            if (typeof paketnya === "undefined") {
                isipaketss[pkts.value] = [];
                setpaketnm[addrsetpkt] = pkts.value;
                isipaketss[pkts.value][0] = pkts.value;
                isipaketss[pkts.value][1] = getList(getchannel());
                isipaketss[pkts.value][2] = getList(getarea(),"piliharea");
                isipaketss[pkts.value][3] = getList(getbrand());
                isipaketss[pkts.value][4] = getList(getkategori());
                jmlhkmbnsi++;
                addrsetpkt++;
            }
            var alamatpaket = 5;
            /*
             if (document.getElementById('paketcombineNUMBS')) {
             document.getElementById('paketcombineNUMBS').options.add(new Option(pkts.value, pkts.value));
             } */
            if (typeof paketnya === "undefined") {
                /*
                console.log("addrpakets nilai : " + addrpakets);
                console.log($('.selectpackage')); */
                namapakets[addrpakets] = (!paketsadds) ? pkts.value : nmpktvalss;
                if(paketsadds) {
                    $('option', $('.selectpackage')).not(':eq(0), :selected').remove();
                }
                for (var j = 0; j < namapakets.length; j++) {
                    /* console.log("Nama Paket Terbentuk : " + namapakets[j]); */
                    $('.selectpackage').append($("<option></option>").attr("value", namapakets[j]).text(namapakets[j]));
                }
                /*
                console.log(namapakets.length);
                console.log(namapakets);
                console.log("\n"); */
                addrpakets++;
            }
            if (mkombinasi === 0) {
                htmlt = divss.innerHTML;
            }
        }
        if (objs.getAttribute("modelinput") === "text") {
            var paketsaddrs = (addrsetpkt - 1);
            var tambahannya = (operator[paramarr[i]] !== "undefined" && operator[paramarr[i]] !== "" && objs.value !== "") ? "<br />" + operator[paramarr[i]] : "";
            var textnamefnt = "<font style='cursor: pointer; color: blue;' alamat='"+paketsaddrs+"' id='"+paramarr[i]+paketsaddrs+"' buttonhidden='"+paramarr[i]+"_buttonDiv' parentdiv='step-Package"+paramarr[i]+(i + 1)+"' labelvalue='parameterValue"+i+"_"+paketsaddrs+"' labeladdition='parameterAddition"+i+"_"+paketsaddrs+"'>( + )</font>";
            objd.innerHTML = (objs.value !== "") ? ((typeof paketnya !== "undefined" && typeof paketnya === "object") ? paketnya[alamatpaket] : objs.value + tambahannya) : "";
            objd.innerHTML = (!paketsadds) ? ((typeof paketnya !== "undefined") ? paketnya[alamatpaket] : "<isian>" + objd.innerHTML + "</isian><br />" + textnamefnt) : ((typeof prmtrarrss[i] !== "undefined") ? prmtrarrss[i] : "") + textnamefnt;
            if (typeof paketnya === "undefined") {
                var oprt = operator[paramarr[i]].split("( - ");
                var oprd = oprt[1].split(" - )");
                tampunghdd.innerHTML = (
                        tampunghdd.innerHTML +
                        "<input type='hidden' name='parameter[" + paramarr[i] + "][]' value='" + ((!paketsadds) ? objs.value : prmtrvalss[i]) + "' labelnya='parameterValue"+i+"_"+paketsaddrs+"' />" +
                        "<input type='hidden' name='parameter[" + paramarr[i] + "_operator][]' value='" + ((!paketsadds) ? oprd[0] : mndtrvalss[i]) + "' labelnya='parameterAddition"+i+"_"+paketsaddrs+"' />"
                        );
                isipaketss[pkts.value][alamatpaket] = objs.value + tambahannya;
            }
            alamatpaket++;
        }
        if (objs.getAttribute("modelinput") === "select") {
            var paketsaddrs = (addrsetpkt - 1);
            var inputan = objs.tampung;
            var results = "<ul>";
            var produkj = "";
            /* var produkj = (paramarr[i] === "Produk") ? "<div onclick=\"inputjumlah(this,'" + strparamtr + "');\"><font style='color: blue; cursor: pointer;'>Jumlah</font></div>" : ""; */
            for (var j = 0; j < inputan.length; j++) {
                var op = objs.getElementsByTagName("option");
                var vl = inputan[j];
                for(var k = 0; k < op.length; k++){
                    if(op[k].getAttribute("labelnya") === "ID_" + paramarr[i] + "--" + inputan[j]){
                        vl = op[k].innerHTML;
                    }
                }
                results = results + "<li>" + vl + produkj + "</li>";
            }
            results = results + "</ul>";
            var tambahannya = (opsional[paramarr[i]] !== "undefined" && opsional[paramarr[i]] !== "" && inputan.length > 0) ? opsional[paramarr[i]] : "";
            var slctnamefnt = "<font style='cursor: pointer; color: blue;' alamat='"+paketsaddrs+"' id='"+paramarr[i]+paketsaddrs+"' buttonhidden='"+paramarr[i]+"_buttonDiv' parentdiv='step-Package"+paramarr[i]+(i + 1)+"' labelvalue='parameterValue"+i+"_"+paketsaddrs+"' labeladdition='parameterAddition"+i+"_"+paketsaddrs+"'>( + )</font>";
            objd.innerHTML = (inputan.length > 0) ? ((typeof paketnya !== "undefined" && typeof paketnya === "object") ? paketnya[alamatpaket] : results + tambahannya) : "";
            objd.innerHTML = (!paketsadds) ? ((typeof paketnya !== "undefined") ? paketnya[alamatpaket] : "<isian>" + objd.innerHTML + "</isian><br />" + slctnamefnt) : ((typeof prmtrarrss[i] !== "undefined") ? prmtrarrss[i] : "") + slctnamefnt;
            if (typeof paketnya === "undefined") {
                var opsn = opsional[paramarr[i]].split("( - ");
                var opsm = (typeof opsn[1] !== "undefined") ? opsn[1].split(" - )") : ['Opsional'];
                tampunghdd.innerHTML = (
                        tampunghdd.innerHTML +
                        "<input type='hidden' name='parameter[" + paramarr[i] + "][]' value='" + ((!paketsadds) ? gethidden(inputan) : prmtrvalss[i]) + "' labelnya='parameterValue"+i+"_"+paketsaddrs+"' />" +
                        "<input type='hidden' name='parameter[" + paramarr[i] + "_mandatory][]' value='" + ((!paketsadds) ? opsm[0] : mndtrvalss[i]) + "' labelnya='parameterAddition"+i+"_"+paketsaddrs+"' />"
                        );
                isipaketss[pkts.value][alamatpaket] = results + tambahannya;
            }
            alamatpaket++;
        }
        if (i === 0) {
            if(rewrdvalss.length > 0){
                for(var key in rewrdvalss) {
                    tampunghdd.innerHTML = (
                        tampunghdd.innerHTML +
                        "<input type='hidden' name='REWARD[" + key + "][]' value='" + rewrdvalss[key] + "' labelnya='reward_" + key + (counternya - 1) + "' />"
                        );
                }
            }
        }
        if (paketsadds) {
            ubahbarisBaseParameter();
        }
    }
}

function refreshformBaseParameter() {
    rfrshprgss = 1;
    $('#allpromo').iCheck('check');
    $('#allpromo').iCheck('uncheck');
    $("#step-2").slideUp("slow");
    /* console.log("allpromo uncheck."); */
    
    $('#allchannel').iCheck('check');
    $('#allchannel').iCheck('uncheck');
    $('#allchannel').iCheck('check');
    $('#allchannel').iCheck('uncheck');
    
    setidforselect("piliharea");
    removeSelect("step-3", "Pilih Area");
    $("#step-3").slideUp("slow");
    /* console.log("allchannel uncheck."); */
    
    $('#allbrand').iCheck('check');
    $('#allbrand').iCheck('uncheck'); 
    
    /* console.log("allbrand uncheck."); */
    
    $('#allkategori').iCheck('check');
    $('#allkategori').iCheck('uncheck'); 
    
    /* console.log("allkategori uncheck.");
       console.log("\n"); */
    $("#step-4").slideUp("slow");
    $("#formlabel").slideUp("slow");
    $("#formreward").slideUp("slow");
    rfrshprgss = 0;
}

function refreshform() {
    for (var i = 0; i < paramarr.length; i++) {
        var pkts = document.getElementById("inputpaket");
        var objs = document.getElementById("ID_" + paramarr[i]);
        if (i === 0) {
            pkts.value = "";
        }
        if (objs.getAttribute("modelinput") === "text") {
            objs.value = "";
        }
        if (objs.getAttribute("modelinput") === "select") {
            var slcs = objs.tampung;
            if (slcs.length > 0) {
                setidforselect("ID_" + paramarr[i]);
                removeSelect("DIVS_" + paramarr[i], paramarr[i]);
            }
            objs.tampung = [];
        }
    }
}

function normalizePlus(){
    if(counternya > 1){
        var tbody = document.getElementById("tbodypaket");
        var trtrs = tbody.getElementsByTagName("tr");
        var tdtds = trtrs[counternya - 1].getElementsByTagName("td");
        for(var i = 0; i < tdtds.length; i++){
            var fonts = tdtds[i].getElementsByTagName("font");
            if(fonts.length > 1){
                fonts[0].parentNode.removeChild(fonts[0]);
            }
        }
    }
}

var countenter = 1;
function beginPackage() {
    if (document.getElementById("inputpaket").value !== "" || paketsadds) {
        if (tbodypaket === "") {
            divsspaket = document.getElementById("isitabel").innerHTML;
            tbodypaket = document.getElementById("tbodypaket").innerHTML;
            isinapaket = tbodypaket.replace(/NUMBS1234/g, counternya);
            divsspaked = divsspaket.replace(tbodypaket, isinapaket);
            document.getElementById("isitabel").innerHTML = divsspaked;
            if (callcombns === 0) {
                barispaket(counternya);
            } else {
                barispaket(counternya, getpaketnm);
            }
        }
        if (counternya > 1) {
            divsspaket = document.getElementById("isitabel").innerHTML;
            tbodypaked = document.getElementById("tbodypaket").innerHTML;
            isinapaket = tbodypaket.replace(/NUMBS1234/g, counternya);
            tbodypakes = tbodypaked + isinapaket;
            divsspaked = divsspaket.replace(tbodypaked, tbodypakes);
            document.getElementById("isitabel").innerHTML = divsspaked;
            if (callcombns === 0) {
                barispaket(counternya);
            } else {
                barispaket(counternya, getpaketnm);
            }
            normalizePlus();
        }
        counternya++;
        if (callcombns === 0) {
            refreshform();
        }
        $("#step-PackageList").slideDown("slow");
        if(paketsadds) {
            refreshformBaseParameter();
        }
        for (var i = 0; i < paramarr.length; i++) {
            $("#step-Package" + paramarr[i] + (i + 1)).slideUp("slow");
        }
        begins = 0;
        paketsadds = 0;
    } else {
        document.location = url_samamodal();
        document.getElementById("Alertnya").innerHTML = "Harap nama paket diisi.";
    }
}

function packageHandler() {
    $('#createpackage').click(function () {
        beginPackage();
        /* console.log("Buat Paket.. " + countenter + "\n"); */
        refreshformBaseParameter();
        countenter++;
        /* $('#createpackage').unbind( "click" ); */
    });
}

addspakets.onclick = function(){
    document.location = url_pagar("footerpart");
    paketsadds = 1;
    callcombns = 0;
    beginPackage();
};