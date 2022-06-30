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

var oTable = {};
$(document).ready(function () {
    
    var url_ = url__;
    var url_data = url_;
    loadData();

    function loadData() {
        $('#table-data').dataTable().fnDestroy();
        var url = '';
        url = url_data;

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
            "aoColumnDefs": [
                {"aTargets": [1], "bVisible": false}, //idx
            ],
            "initComplete": function () {
                /* on complete render table datatables */
                setTimeout(function(){
                    if(anggaran_tahunan){
                        change_based_sbp_jenis_anggaran_tahunan();
                    }
                }, 100);
            }
        });

        window.update_size = function () {
            $(oTable).css({width: $(oTable).parent().width()});
            oTable.fnAdjustColumnSizing();
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