function check_session(HTMLTAG){
    var split_login = HTMLTAG.split("<div class=\"login-box\">");
    if(split_login.length > 1){
        document.location = "../../../index.php/login";
        return false;
    }
}

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
    var pkt_kode = document.getElementById("pkt_kode");
    pkt_kode.innerHTML = "";
    var option = "<option value=''>PILIH</option>";
    for(var i = 1; i <= 99; i++){
        option = option + "<option value='"+nilai_angka+"."+samakan(i, 99)+"'>"+nilai_angka+"."+samakan(i, 99)+"</option>";
    }
    pkt_kode.innerHTML = option;
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
            },2000);
            
        };
    }
}

window.addEventListener("load", function () {
    $( "#buka_dialog_iku_kode" ).click(function(){
        set_loading();
        $.get("../../../index.php/daftar-program-kerja-tahunan/get-iku-only/", function(data, status){
            if(status === "success"){
                check_session(data);
                var iku_kode = document.getElementById("iku_kode");
                var tbody_daftar_iku = document.getElementById("tbody_daftar_iku");
                tbody_daftar_iku.innerHTML = data;
                $('#modal-daftar-iku').modal('show');
                set_tr_click_inside_tbody(tbody_daftar_iku,iku_kode,'modal-daftar-iku','0,1');
                removeLoading();
            }
        });
    });
    $( "#buka_dialog_sbpps_kode" ).click(function(){
        set_loading();
        $.get("../../../index.php/daftar-program-kerja-tahunan/get-sbpps-only/", function(data, status){
            if(status === "success"){
                check_session(data);
                var sbpps_kode = document.getElementById("sbpps_kode");
                var tbody_daftar_sbpps = document.getElementById("tbody_daftar_sbpps");
                tbody_daftar_sbpps.innerHTML = data;
                $('#modal-daftar-sbpps').modal('show');
                set_tr_click_inside_tbody(tbody_daftar_sbpps,sbpps_kode,'modal-daftar-sbpps','0,2');
                removeLoading();
            }
        });
    });
});