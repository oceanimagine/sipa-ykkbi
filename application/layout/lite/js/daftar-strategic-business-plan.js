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
                hidden_active.value = get_attr_data[1];
                input_active.value = hasil_concate_display;
                get_sbp_no_urut(get_attr_data[1]);
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

function get_sbp_no_urut(param){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState === 4 && this.status === 200){
            var sbp_nourut_display = document.getElementById("sbp_nourut_display");
            var sbp_nourut = document.getElementById("sbp_nourut");
            sbp_nourut_display.value = convert_number_alphabet(Number(param)) + "." + this.responseText;
            sbp_nourut.value = convert_number_alphabet(Number(param)) + "." + this.responseText;
        }
    };
    xmlhttp.open("GET", "../../../index.php/daftar-strategic-business-plan/get_nomor_urut_sbp/" + param);
    xmlhttp.send(null);
}

window.addEventListener("load", function () {
    $( "#buka_dialog_kode_ps" ).click(function(){
        set_loading();
        $.get("../../../index.php/daftar-strategic-business-plan/get-ps-only/", function(data, status){
            if(status === "success"){
                if(check_session(data)){
                    var kode_ps_pilih = document.getElementById("kode_ps_pilih");
                    var tbody_daftar_kode_ps = document.getElementById("tbody_daftar_kode_ps");
                    tbody_daftar_kode_ps.innerHTML = data;
                    $('#modal-daftar-kode-ps').modal('show');
                    set_tr_click_inside_tbody(tbody_daftar_kode_ps,kode_ps_pilih,'modal-daftar-kode-ps','1,3');
                    removeLoading();
                }
            }
        });
    });
    $("#search_text_kode_ps").bind("keypress keyup keydown", function () {
        search_from_tbody(document.getElementById('tbody_daftar_kode_ps'), this, '3', document.getElementById('kode_ps_pilih'), 'modal-daftar-kode-ps', '1,3');
    });
    
    var kode_ps_program_strategis = document.getElementById("kode_ps_program_strategis");
    var jenis_entri = document.getElementById("jenis_entri");
    jenis_entri.onchange = function(){
        var value_select = this.value;
        var sbp_nourut_display = document.getElementById("sbp_nourut_display");
        var sbp_nourut = document.getElementById("sbp_nourut");
        var tempat_kode_pks_pkns = document.getElementById("tempat_kode_pks_pkns");
        var tempat_nomor_pks_pkns = document.getElementById("tempat_nomor_pks_pkns");
        
        var get_option = kode_ps_program_strategis.getElementsByTagName("option");
        for(var i = 0; i < get_option; i++){
            get_option[i].removeAttribute("selected");
        }
        kode_ps_program_strategis.value = "";
        
        if(value_select === "PS"){
            
            tempat_kode_pks_pkns.style.display = "none";
            tempat_nomor_pks_pkns.style.display = "none";
            
            sbp_nourut_display.value = "A";
            sbp_nourut.value = "A";
        }
        
        if(value_select === "PKS"){
            sbp_nourut_display.value = "A.1";
            sbp_nourut.value = "A.1";
            var nomor_pks_pkns = document.getElementById("nomor_pks_pkns");
            nomor_pks_pkns.removeAttribute("disabled");
            
            var kode_pks_pkns_display = document.getElementById("kode_pks_pkns_display");
            var kode_pks_pkns = document.getElementById("kode_pks_pkns");
            kode_pks_pkns.value = "1";
            kode_pks_pkns_display.value = "1";
        }
        
        if(value_select === "PKNS"){
            sbp_nourut_display.value = "A.1";
            sbp_nourut.value = "A.1";
            var nomor_pks_pkns = document.getElementById("nomor_pks_pkns");
            nomor_pks_pkns.removeAttribute("disabled");
            
            var kode_pks_pkns_display = document.getElementById("kode_pks_pkns_display");
            var kode_pks_pkns = document.getElementById("kode_pks_pkns");
            kode_pks_pkns.value = "2";
            kode_pks_pkns_display.value = "2";
        }
        
        if(value_select !== "PS"){
            var tempat_kode_ps_input = document.getElementById("tempat_kode_ps_input");
            var get_select = tempat_kode_ps_input.getElementsByTagName("select");
            get_select[0].removeAttribute("disabled", "");
            get_select[0].setAttribute("disabled", "");
            tempat_kode_ps_input.style.display = "none";
            
            var tempat_kode_ps_pilih = document.getElementById("tempat_kode_ps_pilih");
            var get_input = tempat_kode_ps_pilih.getElementsByTagName("input");
            get_input[1].removeAttribute("disabled", "");
            tempat_kode_ps_pilih.style.display = "";
            
            tempat_kode_pks_pkns.style.display = "";
            tempat_nomor_pks_pkns.style.display = "";
            
        }
        if(value_select === "PS"){
            var nomor_pks_pkns = document.getElementById("nomor_pks_pkns");
            var get_option = nomor_pks_pkns.getElementsByTagName("option");
            for(var i = 0; i < get_option.length; i++){
                get_option[i].removeAttribute("selected");
            }
            nomor_pks_pkns.value = "";
            nomor_pks_pkns.setAttribute("disabled","");
            
            var kode_pks_pkns_display = document.getElementById("kode_pks_pkns_display");
            var kode_pks_pkns = document.getElementById("kode_pks_pkns");
            kode_pks_pkns.value = "";
            kode_pks_pkns_display.value = "0";
            
            var tempat_kode_ps_input = document.getElementById("tempat_kode_ps_input");
            var get_select = tempat_kode_ps_input.getElementsByTagName("select");
            get_select[0].removeAttribute("disabled", "");
            tempat_kode_ps_input.style.display = "";
            
            var tempat_kode_ps_pilih = document.getElementById("tempat_kode_ps_pilih");
            var get_input = tempat_kode_ps_pilih.getElementsByTagName("input");
            get_input[0].value = "";
            get_input[1].removeAttribute("disabled");
            get_input[1].setAttribute("disabled", "");
            tempat_kode_ps_pilih.style.display = "none";
        }
    };
    
    kode_ps_program_strategis.onchange = function(){
        var sbp_nourut_display = document.getElementById("sbp_nourut_display");
        var sbp_nourut = document.getElementById("sbp_nourut");
        sbp_nourut_display.value = convert_number_alphabet(Number(this.value));
        sbp_nourut.value = convert_number_alphabet(Number(this.value));
    };
});