var url__ = typeof url__ !== "undefined" && url__ !== "" ? url__ : "";
var ajax_ = 0;

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
            "aoColumnDefs": [
                {"aTargets": [1], "bVisible": false}, //idx
            ],
            "initComplete": function () {
                /* on complete render table datatables */
            }
        });

        window.update_size = function () {
            $(oTable).css({width: $(oTable).parent().width()});
            oTable.fnAdjustColumnSizing();
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