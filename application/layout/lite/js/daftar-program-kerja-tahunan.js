function set_loading(message){
    var div = document.createElement("div");
    var span = document.createElement("span");
    div.style.top = "0";
    div.style.left = "0";
    div.style.width = "100%";
    div.style.height = "100%";
    div.style.zIndex = "99999";
    div.style.position = "fixed";
    div.style.display = "table";
    div.style.backgroundColor = "rgba(0,0,0,0.9)";
    div.setAttribute("id","div_loading");
    span.style.width = "100%";
    span.style.height = "100%";
    span.style.display = "table-cell";
    span.style.verticalAlign = "middle";
    span.style.textAlign = "center";
    span.style.color = "white";
    span.style.fontFamily = "consolas, monospace";
    span.innerHTML = typeof message !== "undefined" ? message : "LOADING....";
    span.setAttribute("id","span_loading");
    div.appendChild(span);
    document.body.appendChild(div);
}

function removeLoading(message,loading_message){
    if(document.getElementById("div_loading")){
        var span_loading = document.getElementById("span_loading");
        span_loading.style.fontSize = "20px";
        span_loading.innerHTML = typeof message !== "undefined" ? message : "DONE.";
        setTimeout(function(){
            var div_loading = document.getElementById("div_loading");
            div_loading.parentNode.removeChild(div_loading);
            if(typeof loading_message !== "undefined"){
                set_loading(loading_message);
            }
        }, typeof message !== "undefined" && typeof loading_message === "undefined" ? 4000 : 1000);
    }
}

function set_select_number(hidden_active){
    var nilai_hidden = hidden_active.value;
    var nilai_hidden_split = nilai_hidden.split(".");
    var nilai_angka = Number(nilai_hidden_split[nilai_hidden_split.length - 1]);
    if(document.getElementById("pkt_kode")){
        var pkt_kode = document.getElementById("pkt_kode");
        pkt_kode.innerHTML = "";
        var option = "<option value=''>PILIH</option>";
        for(var i = 1; i <= 99; i++){
            option = option + "<option value='"+nilai_angka+"."+samakan(i, 99)+"'>"+nilai_angka+"."+samakan(i, 99)+"</option>";
        }
        pkt_kode.innerHTML = option;
    }
}

function samakan(param_a, param_b){
    var param_1 = param_a.toString();
    var param_2 = param_b.toString();
    var selisih = param_2.length - param_1.length;
    var results = "";
    for(var i = 0; i < selisih; i++){
        results = results + "0";
    }
    return results + param_1;
}

function set_hidden(object_reference, value_active){
    var get_id = object_reference.getAttribute("id");
    var get_name = object_reference.getAttribute("name");
    var create_hidden = document.createElement("input");
    create_hidden.setAttribute("type", "hidden");
    create_hidden.setAttribute("id", get_id + "_hidden");
    create_hidden.setAttribute("name", get_name);
    create_hidden.value = value_active;
    object_reference.parentNode.appendChild(create_hidden);
}

function reset_satker_and_nokegiatan(){
    var satker_pkt_kode = document.getElementById("satker_pkt_kode");
    var nokegiatan_pkt_kode = document.getElementById("nokegiatan_pkt_kode");
    var get_option_satker = satker_pkt_kode.getElementsByTagName("option");
    var get_option_pkt_kode = nokegiatan_pkt_kode.getElementsByTagName("option");
    for(var i = 0; i < get_option_satker.length; i++){
        get_option_satker[i].removeAttribute("selected");
    }
    for(var i = 0; i < get_option_pkt_kode.length; i++){
        get_option_pkt_kode[i].removeAttribute("selected");
    }
    satker_pkt_kode.removeAttribute("disabled");
    nokegiatan_pkt_kode.removeAttribute("disabled");
    if(document.getElementById("satker_pkt_kode_hidden")){
        var satker_pkt_kode_hidden = document.getElementById("satker_pkt_kode_hidden");
        satker_pkt_kode_hidden.parentNode.removeChild(satker_pkt_kode_hidden);
        var nokegiatan_pkt_kode_hidden = document.getElementById("nokegiatan_pkt_kode_hidden");
        nokegiatan_pkt_kode_hidden.parentNode.removeChild(nokegiatan_pkt_kode_hidden);
    }
}

function auto_set_satker_and_nokegiatan(nomor_kegiatan){
    var explode_titik = nomor_kegiatan.split(".");
    var satker = explode_titik[0];
    var kegiatan = explode_titik[1];
    console.log("SATKER : " + satker);
    console.log("KEGIATAN : " + kegiatan);
    var satker_pkt_kode = document.getElementById("satker_pkt_kode");
    var nokegiatan_pkt_kode = document.getElementById("nokegiatan_pkt_kode");
    var get_option_satker = satker_pkt_kode.getElementsByTagName("option");
    var get_option_pkt_kode = nokegiatan_pkt_kode.getElementsByTagName("option");
    for(var i = 0; i < get_option_satker.length; i++){
        get_option_satker[i].removeAttribute("selected");
    }
    for(var i = 0; i < get_option_satker.length; i++){
        if(get_option_satker[i].getAttribute("value") === satker){
            get_option_satker[i].setAttribute("selected","");
        }
    }
    for(var i = 0; i < get_option_pkt_kode.length; i++){
        get_option_pkt_kode[i].removeAttribute("selected");
    }
    for(var i = 0; i < get_option_pkt_kode.length; i++){
        if(get_option_pkt_kode[i].getAttribute("value") === kegiatan){
            get_option_pkt_kode[i].setAttribute("selected","");
        }
    }
    satker_pkt_kode.setAttribute("disabled","");
    nokegiatan_pkt_kode.setAttribute("disabled","");
    set_hidden(satker_pkt_kode, satker);
    set_hidden(nokegiatan_pkt_kode, kegiatan);
}

function set_tr_click_inside_tbody(tbody_active,input_active,id_dialog,display_address){
    var get_tr = tbody_active.getElementsByTagName("tr");
    for(var i = 0; i < get_tr.length; i++){
        get_tr[i].onclick = function(){
            set_loading();
            var get_td = this.getElementsByTagName("td");
            var get_div = get_td[0].getElementsByTagName("div");
            var get_attr_data = JSON.parse(get_div[0].getAttribute("attr_data"));
            var get_address = display_address.split(",");
            var hasil_concate = "";
            var pemisah = "";
            var hasil_concate_display = "";
            var pemisah_display = "";
            for(var i = 0; i < get_attr_data.length; i++){
                hasil_concate = hasil_concate + pemisah + get_attr_data[i];
                pemisah = " ---- ";
            }
            
            for(var i = 0; i < get_address.length; i++){
                hasil_concate_display = hasil_concate_display + pemisah_display + get_attr_data[Number(get_address[i])];
                pemisah_display = " # ";
            }
            var tr_active = this;
            removeLoading();
            setTimeout(function(){
                var get_id = input_active.getAttribute("id");
                var hidden_id = get_id + "_hidden";
                var hidden_active = document.getElementById(hidden_id);
                hidden_active.value = get_attr_data[0];
                input_active.value = hasil_concate_display;
                $('#'+id_dialog).modal('hide');
                if(get_id + "_hidden" === "sbpps_kode_hidden"){
                    set_select_number(hidden_active);
                }
                if(tr_active.getAttribute("info") === "kegiatan"){
                    auto_set_satker_and_nokegiatan(hidden_active.value);
                }
            },2000);
            
        };
    }
}

var get_filter_sbp = true;
function set_click_checkbox(div_container){
    var get_span = div_container.getElementsByTagName("span");
    var get_div = get_span[0].parentNode.parentNode;
    var get_input = get_div.getElementsByTagName("input");
    get_span[0].onclick = function(){
        // console.log(this);
        var get_div = this.parentNode;
        var get_div_parent = get_div.parentNode;
        var get_input = get_div_parent.getElementsByTagName("input");
        if(get_input[0].checked){
            get_input[0].checked = false;
            get_filter_sbp = false;
        } else {
            var sbpps_kode_hidden = document.getElementById("sbpps_kode_hidden");
            if(sbpps_kode_hidden.value){
                get_input[0].checked = true;
                get_filter_sbp = true;
            } else {
                var pesan_modal = document.getElementById("pesan_modal");
                pesan_modal.innerHTML = "SBP Kode tidak boleh kosong untuk mengaktifkan filter.";
                $('#modal-success').modal('show');
            }
        }
    };
    get_input[0].onclick = function(){
        // console.log(this.checked);
        if(this.checked){
            var sbpps_kode_hidden = document.getElementById("sbpps_kode_hidden");
            if(sbpps_kode_hidden.value){
                this.checked = true;
                get_filter_sbp = true;
            } else {
                var pesan_modal = document.getElementById("pesan_modal");
                pesan_modal.innerHTML = "SBP Kode tidak boleh kosong untuk mengaktifkan filter.";
                $('#modal-success').modal('show');
                this.checked = false;
                get_filter_sbp = false;
            }
        } else {
            // console.log(this.checked);
            get_filter_sbp = false;
        }
    };
}

function set_handler_rk(){
    var tempat_satker_pkt_kode = document.getElementById("tempat_satker_pkt_kode");
    var tempat_nokegiatan_pkt_kode = document.getElementById("tempat_nokegiatan_pkt_kode");
    var tempat_norinciankegiatan_pkt_kode = document.getElementById("tempat_norinciankegiatan_pkt_kode");
    var tempat_kegiatan_kode = document.getElementById("tempat_kegiatan_kode");
    var filter_sbp_container = document.getElementById("filter_sbp_container");
    tempat_satker_pkt_kode.setAttribute("class","col-xs-4");
    tempat_nokegiatan_pkt_kode.setAttribute("class","col-xs-3");
    tempat_nokegiatan_pkt_kode.style.paddingRight = "6px";
    tempat_norinciankegiatan_pkt_kode.setAttribute("class","col-xs-3");
    tempat_norinciankegiatan_pkt_kode.style.paddingLeft = "6px";
    tempat_norinciankegiatan_pkt_kode.style.display = "";
    tempat_kegiatan_kode.style.display = "";
    var satker_pkt_kode = document.getElementById("satker_pkt_kode");
    var nokegiatan_pkt_kode = document.getElementById("nokegiatan_pkt_kode");
    satker_pkt_kode.setAttribute("disabled","");
    nokegiatan_pkt_kode.setAttribute("disabled","");
    var kegiatan_kode_hidden = document.getElementById("kegiatan_kode_hidden");
    if(kegiatan_kode_hidden.value === ""){
        var pesan_modal = document.getElementById("pesan_modal");
        pesan_modal.innerHTML = "Pilih Kode Kegiatan Untuk Melanjutkan.";
        $('#modal-success').modal('show');
    }
    filter_sbp_container.style.display = "";
    // set_click_checkbox(filter_sbp_container);
}

function unset_click_checkbox(div_container){
    var get_span = div_container.getElementsByTagName("span");
    $(get_span[0]).unbind();
}

window.addEventListener("load", function () {
    $( "#buka_dialog_iku_kode" ).click(function(){
        set_loading();
        $.get("../../../index.php/daftar-program-kerja-tahunan/get-iku-only/", function(data, status){
            if(status === "success"){
                if(check_session(data)){
                    var iku_kode = document.getElementById("iku_kode");
                    var tbody_daftar_iku = document.getElementById("tbody_daftar_iku");
                    tbody_daftar_iku.innerHTML = data;
                    $('#modal-daftar-iku').modal('show');
                    set_tr_click_inside_tbody(tbody_daftar_iku,iku_kode,'modal-daftar-iku','0,1');
                    removeLoading();
                }
            }
        });
    });
    $( "#buka_dialog_sbpps_kode" ).click(function(){
        set_loading();
        $.get("../../../index.php/daftar-program-kerja-tahunan/get-sbpps-only/", function(data, status){
            if(status === "success"){
                if(check_session(data)){
                    var sbpps_kode = document.getElementById("sbpps_kode");
                    var tbody_daftar_sbpps = document.getElementById("tbody_daftar_sbpps");
                    tbody_daftar_sbpps.innerHTML = data;
                    $('#modal-daftar-sbpps').modal('show');
                    set_tr_click_inside_tbody(tbody_daftar_sbpps,sbpps_kode,'modal-daftar-sbpps','0,2');
                    removeLoading();
                }
            }
        });
    });
    $( "#buka_dialog_kegiatan_kode" ).click(function(){
        set_loading();
        var sbpkode_filter = "";
        // console.log(get_filter_sbp);
        if(get_filter_sbp){
            var sbpps_kode_hidden = document.getElementById("sbpps_kode_hidden");
            sbpkode_filter = sbpps_kode_hidden.value;
            // console.log(sbpkode_filter);
        }
        $.get("../../../index.php/daftar-program-kerja-tahunan/get-kegiatan-only/" + sbpkode_filter, function(data, status){
            if(status === "success"){
                if(check_session(data)){
                    var kegiatan_kode = document.getElementById("kegiatan_kode");
                    var tbody_hasil_data_kegiatan_only = document.getElementById("tbody_hasil_data_kegiatan_only");
                    tbody_hasil_data_kegiatan_only.innerHTML = data;
                    $('#modal-kegiatan-only').modal('show');
                    set_tr_click_inside_tbody(tbody_hasil_data_kegiatan_only,kegiatan_kode,'modal-kegiatan-only','0,5');
                    removeLoading();
                }
            }
        });
    });
    $("#search_text_dialog_sbpps").bind("keypress keyup keydown", function () {
        search_from_tbody(document.getElementById('tbody_daftar_sbpps'), this, '3', document.getElementById('sbpps_kode'), 'modal-daftar-sbpps', '0,2');
    });
    $("#search_text_dialog_iku").bind("keypress keyup keydown", function () {
        search_from_tbody(document.getElementById('tbody_daftar_iku'), this, '3', document.getElementById('iku_kode'), 'modal-daftar-iku', '0,1');
    });
    $("#search_text_dialog_kegiatan_only").bind("keypress keyup keydown", function () {
        search_from_tbody(document.getElementById('tbody_hasil_data_kegiatan_only'), this, '4', document.getElementById('kegiatan_kode'), 'modal-kegiatan-only', '0,5');
    });
    
    $("#pktkrk").change(function(){
        // console.log(this.value);
        var tempat_satker_pkt_kode = document.getElementById("tempat_satker_pkt_kode");
        var tempat_nokegiatan_pkt_kode = document.getElementById("tempat_nokegiatan_pkt_kode");
        var tempat_norinciankegiatan_pkt_kode = document.getElementById("tempat_norinciankegiatan_pkt_kode");
        var tempat_kegiatan_kode = document.getElementById("tempat_kegiatan_kode");
        var kegiatan_kode = document.getElementById("kegiatan_kode");
        var kegiatan_kode_hidden = document.getElementById("kegiatan_kode_hidden");
        var filter_sbp_container = document.getElementById("filter_sbp_container");
        var pktnama = document.getElementById("pktnama");
        var pktoutput = document.getElementById("pktoutput");
        if(this.value === "RK"){
            tempat_satker_pkt_kode.setAttribute("class","col-xs-4");
            tempat_nokegiatan_pkt_kode.setAttribute("class","col-xs-3");
            tempat_nokegiatan_pkt_kode.style.paddingRight = "6px";
            tempat_norinciankegiatan_pkt_kode.setAttribute("class","col-xs-3");
            tempat_norinciankegiatan_pkt_kode.style.paddingLeft = "6px";
            tempat_norinciankegiatan_pkt_kode.style.display = "";
            tempat_kegiatan_kode.style.display = "";
            var satker_pkt_kode = document.getElementById("satker_pkt_kode");
            var nokegiatan_pkt_kode = document.getElementById("nokegiatan_pkt_kode");
            satker_pkt_kode.setAttribute("disabled","");
            nokegiatan_pkt_kode.setAttribute("disabled","");
            var pesan_modal = document.getElementById("pesan_modal");
            pesan_modal.innerHTML = "Pilih Kode Kegiatan Untuk Melanjutkan.";
            $('#modal-success').modal('show');
            filter_sbp_container.style.display = "";
            // set_click_checkbox(filter_sbp_container);
        }
        if(this.value === "K"){
            tempat_satker_pkt_kode.setAttribute("class","col-xs-5");
            tempat_nokegiatan_pkt_kode.setAttribute("class","col-xs-5");
            tempat_nokegiatan_pkt_kode.style.paddingRight = "";
            tempat_norinciankegiatan_pkt_kode.setAttribute("class","col-xs-5");
            tempat_norinciankegiatan_pkt_kode.style.paddingLeft = "";
            tempat_norinciankegiatan_pkt_kode.style.display = "none";
            tempat_kegiatan_kode.style.display = "none";
            kegiatan_kode.value = "";
            kegiatan_kode_hidden.value = "";
            pktnama.value = "";
            pktoutput.value = "";
            filter_sbp_container.style.display = "none";
            // unset_click_checkbox(filter_sbp_container);
            reset_satker_and_nokegiatan();
        }
    });
    var pktkrk = document.getElementById("pktkrk");
    // var sbpps_kode_filter = document.getElementById("sbpps_kode_filter");
    // sbpps_kode_filter.checked = false;
    if(pktkrk.value === "RK"){
        set_handler_rk();
    }
    if(typeof merah !== "undefined" && merah === "merah"){
        setTimeout(function(){
            var pesan_modal = document.getElementById("pesan_modal");
            pesan_modal.innerHTML = "Mohon diperhatikan Kode SBP pada kegiatan terpilih tidak sama dengan Kode SBP pada rincian kegiatan.";
            $('#modal-success').modal('show');
        }, 500);
    }
});