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

var collection_array = [];
function set_tr_click_inside_tbody(tbody_active,input_active,id_dialog,display_address){
    var get_tr = tbody_active.getElementsByTagName("tr");
    for(var i = 0; i < get_tr.length; i++){
        get_tr[i].onclick = function(){
            set_loading();
            var get_td = this.getElementsByTagName("td");
            var get_div = get_td[0].getElementsByTagName("div");
            collection_array[get_div[0].getAttribute("attr_data")] = true;
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
            set_to_table(get_attr_data,"2,0,5",get_div[0].getAttribute("attr_data"));
        };
    }
}

function delete_row(span_object){
    var get_td = span_object.parentNode;
    var get_tr = get_td.parentNode;
    var get_tbody = get_tr.parentNode;
    var get_div = get_tr.getElementsByTagName("td");
    delete collection_array[get_div[0].getAttribute("attr_data")];
    get_tr.parentNode.removeChild(get_tr);
    var get_tr_ = get_tbody.getElementsByTagName("tr");
    
    var count = 1;
    for(var i = 0; i < get_tr_.length; i++){
        var get_td_inside = get_tr_[i].getElementsByTagName("td");
        get_td_inside[0].style.textAlign = "right";
        var temp = "<input" + get_td_inside[0].innerHTML.split("<input")[1];
        get_td_inside[0].innerHTML = count.toString() + "." + temp;
        count++;
    }
    if(get_tr_.length === 0){
        var create_tr = document.createElement("tr");
        var create_td_0 = document.createElement("td");
        create_td_0.setAttribute("colspan","5");
        create_td_0.innerHTML = "No Data.";
        create_tr.appendChild(create_td_0);
        get_tbody.appendChild(create_tr);
    }
}

function set_to_table(attr_data,display_address,raw_attr_data){
    var pkt_detail = document.getElementById("pkt_detail");
    var get_tr = pkt_detail.getElementsByTagName("tr");
    var get_td = get_tr[0].getElementsByTagName("td");
    if(get_td[0].getAttribute("colspan") !== null){
        while(typeof get_tr[0] !== "undefined"){
            get_tr[0].parentNode.removeChild(get_tr[0]);
        }
    }
    var count = 1;
    for(var i = 0; i < get_tr.length; i++){
        var get_td_inside = get_tr[i].getElementsByTagName("td");
        get_td_inside[0].style.textAlign = "right";
        var temp = "<input" + get_td_inside[0].innerHTML.split("<input")[1];
        get_td_inside[0].innerHTML = count.toString() + "." + temp;
        count++;
    }
    var create_tr = document.createElement("tr");
    var split_address = display_address.split(",");
    var create_td_0 = document.createElement("td");
    create_td_0.innerHTML = count.toString() + ".";
    create_td_0.style.textAlign = "right";
    create_td_0.setAttribute("attr_data",raw_attr_data);
    var get_attr_data = JSON.parse(raw_attr_data);
    var create_input = document.createElement("input");
    create_input.setAttribute("type", "hidden");
    create_input.setAttribute("name", "pkt_sbp[]");
    create_input.setAttribute("value", get_attr_data[0] + "," + get_attr_data[2]);
    create_td_0.appendChild(create_input);
    create_tr.appendChild(create_td_0);
    
    for(var i = 0; i < split_address.length; i++){
        var create_td_1 = document.createElement("td");
        create_td_1.innerHTML = attr_data[Number(split_address[i])];
        create_tr.appendChild(create_td_1);
    }
    var create_td_2 = document.createElement("td");
    create_td_2.innerHTML = "<i class=\"fa fa-trash\" style='cursor: pointer;' onclick=\"delete_row(this);\"></i>";
    create_tr.appendChild(create_td_2);
    pkt_detail.appendChild(create_tr);    
}

function unset_exists(tbody_object){
    var get_tr = tbody_object.getElementsByTagName("tr");
    var get_tr_temporary = [];
    var address_tr_temporary = 0;
    var masuk = 0;
    for(var i = 0; i < get_tr.length; i++){
        var get_div = get_tr[i].getElementsByTagName("div");
        if(typeof collection_array[get_div[0].getAttribute("attr_data")] !== "undefined"){
            get_tr_temporary[address_tr_temporary] = get_tr[i];
            address_tr_temporary++;
            masuk = 1;
        }
    }
    if(masuk){
        for(var i = 0; i < get_tr_temporary.length; i++){
            get_tr_temporary[i].parentNode.removeChild(get_tr_temporary[i]);
        }
    }
}


window.addEventListener("load", function () {
    $( "#buka_dialog_kegiatan_kode" ).click(function(){
        set_loading();
        $.get("../../../index.php/daftar-iku/get-kegiatan-only/", function(data, status){
            if(status === "success"){
                if(check_session(data)){
                    var kegiatan_kode = document.getElementById("kegiatan_kode");
                    var tbody_hasil_data_kegiatan_only = document.getElementById("tbody_hasil_data_kegiatan_only");
                    tbody_hasil_data_kegiatan_only.innerHTML = data;
                    unset_exists(tbody_hasil_data_kegiatan_only);
                    $('#modal-kegiatan-only').modal('show');
                    set_tr_click_inside_tbody(tbody_hasil_data_kegiatan_only,kegiatan_kode,'modal-kegiatan-only','0,5');
                    removeLoading();
                }
            }
        });
    });
    $("#search_text_dialog_kegiatan_only").bind("keypress keyup keydown", function () {
        search_from_tbody(document.getElementById('tbody_hasil_data_kegiatan_only'), this, '4', document.getElementById('kegiatan_kode'), 'modal-kegiatan-only', '0,5');
    });
});