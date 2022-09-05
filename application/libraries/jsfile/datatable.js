var url__ = typeof url__ !== "undefined" && url__ !== "" ? url__ : "";
var ajax_ = 0;
var anggaran_tahunan = typeof anggaran_tahunan !== "undefined" ? anggaran_tahunan : false;

function check_exist(img_url, img_object) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            change_to_image(img_object);
        }
    };
    xhttp.open("GET", img_url, true);
    xhttp.send();
}

function change_to_image(img_object){
    var get_id = img_object.getAttribute("id");
    var get_split = get_id.split("_");
    var get_number = get_split[1];
    document.getElementById("image_" + get_number).style.visibility = "";
    document.getElementById("font_image" + get_number).style.display = "none";
    document.getElementById("br_" + get_number).style.display = "none";
}

function group_based_sbp_jenis_anggaran_tahunan(){
    var table_data = document.getElementsByTagName("table");
    var count = 0;
    for(var i = 0; i < table_data.length; i++){
        if(table_data[i].getAttribute("class") === "table table-bordered table-hover no-footer dataTable"){
            if(count === 1){
                console.log(table_data[i]);
                var get_tbody = table_data[i].getElementsByTagName("tbody");
                var get_tr = get_tbody[0].getElementsByTagName("tr");
                var temp_fourth = "";
                var temp_td = "";
                var total_rowspan = 0;

                for(var j = 0; j < get_tr.length; j++){
                    var get_td = get_tr[j].getElementsByTagName("td");
                    var td_fourth = get_td[4].innerHTML;
                    if(td_fourth === temp_fourth){
                        get_td[11].parentNode.removeChild(get_td[11]);
                        console.log(temp_td);
                        total_rowspan++;
                    } else {
                        if(total_rowspan > 1){
                            temp_td.setAttribute("rowspan", total_rowspan);
                            temp_td.setAttribute("style", "vertical-align: middle;");
                            console.log(total_rowspan);
                        }
                        temp_td = get_td[11];
                        total_rowspan = 1;
                    }
                    temp_fourth = td_fourth;
                } 
                break;
            }
            count++;
        }
    }
}

function set_loading_(message){
    var div = document.createElement("div");
    var span = document.createElement("span");
    div.style.top = "0";
    div.style.left = "0";
    div.style.width = "100%";
    div.style.height = "100%";
    div.style.zIndex = "99999";
    div.style.position = "fixed";
    div.style.display = "table";
    div.style.backgroundColor = "rgba(0,0,0,0.95)";
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

function removeLoading_(message,loading_message){
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

function change_based_sbp_jenis_anggaran_tahunan(){
    var table_data = document.getElementsByTagName("table");
    var count = 0;
    for(var i = 0; i < table_data.length; i++){
        if(table_data[i].getAttribute("class") === "table table-bordered table-hover no-footer dataTable"){
            if(count === 1){
                console.log(table_data[i]);
                var get_tbody = table_data[i].getElementsByTagName("tbody");
                var get_tr = get_tbody[0].getElementsByTagName("tr");
                for(var j = 0; j < get_tr.length; j++){
                    var get_td = get_tr[j].getElementsByTagName("td");
                    var td_first = get_td[4].innerHTML;
                    if(td_first === "SBP"){
                        get_td[11].innerHTML = "(NONE)";
                    } else {
                        get_td[11].innerHTML = '<a href="../../../index.php/anggaran-tahunan/kegiatan/2022.1">Kegiatan</a>';
                    }
                }
                break;
            }
            count++;
        }
    }
}

function remove_modal_a(){
    var table_data = document.getElementsByTagName("table");
    var count = 0;
    for(var i = 0; i < table_data.length; i++){
        if(table_data[i].getAttribute("class") === "table table-bordered table-hover no-footer dataTable"){
            if(count === 1){
                var get_tbody = table_data[i].getElementsByTagName("tbody");
                var get_tr = get_tbody[0].getElementsByTagName("tr");
                for(var j = 0; j < get_tr.length; j++){
                    var get_td = get_tr[j].getElementsByTagName("td");
                    var a_object = get_td[get_td.length - 1].getElementsByTagName("a");
                    if(a_object.length > 0){
                        a_object[a_object.length - 1].removeAttribute("data-target");
                        a_object[a_object.length - 1].removeAttribute("data-toggle");
                        a_object[a_object.length - 1].removeAttribute("onclick");
                        var get_href = a_object[a_object.length - 1].getAttribute("href").split("#").join("");
                        a_object[a_object.length - 1].setAttribute("href", get_href);
                    }
                }
                break;
            }
            count++;
        }
    }
}

function isAlphaOrParen(str) {
  return /^[a-zA-Z()]+$/.test(str);
}

function is_tag(param){
    return param.substr(0,1) === "<" && isAlphaOrParen(param.substr(1,1));
}

var oTable = {};
$(document).ready(function () {
    
    var url_ = url__;
    var url_data = url_;
    loadData();
    
    function add_clear_both(){
        var get_div = document.getElementsByTagName("div");
        for(var i = 0; i < get_div.length; i++){
            if(get_div[i].getAttribute("class") === "panel-heading"){
                var create_p = document.createElement("p");
                create_p.style.clear = "both";
                create_p.style.margin = "0px";
                get_div[i].appendChild(create_p);
                break;
            }
        }
    }
    
    function loadData() {
        $('#table-data').dataTable().fnDestroy();
        var url = '';
        url = url_data;
        
        var table_data = document.getElementById("table-data");
        var get_thead = table_data.getElementsByTagName("thead");
        
        oTable = $('#table-data').on('draw.dt', function () {
            /* on draw table datatables */
        }).dataTable({
            "autoWidth": false,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": url,
            "ordering": false,
            "scrollY": 300,
            "scrollX": true,
            "paging": true,
            "searching": true,
            "info": false,
            "iDisplayLength": anggaran_tahunan ? 1000 : 10,
            "createdRow" : function(row, data){
                var address = 0;
                $.each($('td', row), function () {
                    if(address > 0){
                        if(!is_tag(data[address + 1])){
                            $(this).attr('title', data[address + 1]);
                            $(this).html(data[address + 1].length > 80 ? data[address + 1].substr(0,80) + " ...." : data[address + 1]);
                        }
                    }
                    address++;
                });
            },
            "aoColumnDefs": [
                {"aTargets":  [1], "bVisible": false}, //idx
                {"aTargets":  [get_thead.length - 1], "bVisible": (typeof only_view_table !== "undefined" && only_view_table ? false : true)}
            ],
            "initComplete": function () {
                /* on complete render table datatables */
                setTimeout(function(){
                    if(anggaran_tahunan){
                        change_based_sbp_jenis_anggaran_tahunan();
                    }
                    if(typeof add_anggaran_list !== "undefined" && add_anggaran_list){
                        remove_modal_a();
                    }
                }, 1500);
            }
        });

        window.update_size = function () {
            $(oTable).css({width: $(oTable).parent().width()});
            oTable.fnAdjustColumnSizing();
            add_clear_both();
            setTimeout(function(){
                if(anggaran_tahunan){
                    change_based_sbp_jenis_anggaran_tahunan();
                }
            }, 100);
        };

        $(window).resize(function () {
            clearTimeout(window.refresh_size);
            window.refresh_size = setTimeout(function () {
                update_size();
            }, 250);
        });
        if(typeof add_anggaran_list !== "undefined" && add_anggaran_list){
            set_loading_("PREPARING TABLE.");
        }
        
        setTimeout(function () {
            update_size();
            if(typeof add_anggaran_list !== "undefined" && add_anggaran_list){
                removeLoading_();
            }
        }, 1000);
    }
});

$( document ).ajaxComplete(function() {
    if(!ajax_){
        var table_data = document.getElementById("table-data");
        var get_image = table_data.getElementsByTagName("img");
        count = get_image.length;
        for(var i = 0; i < get_image.length; i++){
            var id_image = get_image[i].getAttribute("id");
            if(id_image !== null){
                var split_ = id_image.split("_");
                if(split_[0] === "image"){
                    var get_url = get_image[i].getAttribute("src");
                    check_exist(get_url, get_image[i]);
                }
            }
        }
    }
});