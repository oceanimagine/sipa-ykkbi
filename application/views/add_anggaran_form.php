<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SIPA YKKBI</title>
        <style type="text/css">
            html, body {
                font-family: consolas, monospace;
                cursor: default;
                width: 100%;
                height: 100%;
                margin: 0px;
                padding: 0px;
            }
            pre {
                font-family: consolas, monospace;
            }
        </style>
        <script type="text/javascript">
            /* Script Goes Here */
        </script>
    </head>
    <body>
        <style type="text/css">
            .styled-table {
                border-collapse: collapse;
                margin: 0px 0;
                font-size: 0.9em;
                font-family: sans-serif;
                min-width: 100%;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            }
            .styled-table thead tr {
                background-color: #009879;
                color: #ffffff;
                text-align: left;
            }
            .styled-table th, .styled-table td {
                padding: 12px 15px;
            }
            .styled-table tbody tr {
                border-bottom: 1px solid #f1f1f1;
            }
            /* 
            .styled-table tbody tr:nth-of-type(even) {
                background-color: #f3f3f3;
            } */

            .styled-table tbody tr:last-of-type {
                border-bottom: 2px solid #009879;
            }
            .styled-table tbody tr.active-row {
                font-weight: bold;
                color: #009879;
            }
            .form-horizontal .form-group {
                margin-right: 0px;
                margin-left: 0px;
            }
            @media (min-width: 768px){
                .control-label {
                    margin-bottom: 5px !important;
                    text-align: left !important;
                }
                #form_group_a {
                    /* margin-bottom: 20px; */
                }
                
            }
            @media (max-width: 991.9px){
                .tambah-margin-bawah {
                    margin-bottom: 10px;
                }
            }
            
            @media (max-width: 900px){
                .merah {
                    color: red;
                }
            }
            
            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
            }

            /* Firefox */
            input[type=number] {
                -moz-appearance: textfield;
            }

        </style>
        <script type="text/javascript">
        
        function detect_address_input_delete(object_input){
            var get_td = object_input.parentNode;
            var get_tr = get_td.parentNode;
            
            var get_name = object_input.getAttribute("name");
            var get_split = get_name.split("_");
            var get_split_b = get_split[get_split.length-1].split("[]");
            
            
            var inisial = "_" + get_split_b[0];
            var get_i_tr = get_tr.getElementsByTagName("i");
            if(get_i_tr[0].getAttribute("class") === "fa fa-minus"){
                var fungsi = get_i_tr[0].getAttribute("onclick");
                var split_comma = fungsi.split(",");
                var split_kurung = split_comma[split_comma.length - 1].split(")");
                kurangi_anak_grup(get_i_tr[0], inisial, Number(split_kurung[0]));
            }
        }
        
        function detect_address_input(object_input){
            // console.log("MASUK MASUK");
            var get_td = object_input.parentNode;
            var get_tr = get_td.parentNode;
            var get_td_input = get_tr.getElementsByTagName("input");
            var count_amount = 0;
            var count_active = 0;
            for(var i = 0; i < get_td_input.length; i++){
                if(get_td_input[i].getAttribute("type") === "number"){
                    count_amount++;
                }
            }
            for(var i = 0; i < get_td_input.length; i++){
                count_active++;
                if(get_td_input[i] === object_input){
                    break;
                }
            }
            // console.log(count_amount);
            // console.log(count_active);
            
            var get_name = object_input.getAttribute("name");
            var get_split = get_name.split("_");
            var get_split_b = get_split[get_split.length-1].split("[]");
            var get_tbody = get_tr.parentNode;
            
            // console.log(get_split_b[0]);
            // console.log("");
            var inisial = "_" + get_split_b[0];
            var detect_tr = 0;
            if(get_tr.getAttribute("style") === "border-bottom: rgb(242,220,219) 2px solid;" || get_tr.getAttribute("style") === "border-bottom: 2px solid rgb(242, 220, 219);"){
                detect_tr = 1;
            }
            if(detect_tr && count_amount === count_active){
                // console.log("Masuk");
                // console.log(inisial);
                
                var get_i_tbody = get_tbody.getElementsByTagName("i");
                for(var i = 0; i < get_i_tbody.length; i++){
                    if(get_i_tbody[i].getAttribute("urutan_grup") === "tombol_anakan" + inisial){
                        var fungsi = get_i_tbody[i].getAttribute("onclick");
                        // console.log(fungsi);
                        var split_comma = fungsi.split(",");
                        var split_kurung = split_comma[split_comma.length - 1].split(")");
                        // console.log(split_kurung[0]);
                        tambah_anak_grup(get_i_tbody[i], inisial, Number(split_kurung[0]));
                        break;
                    }
                }
            }
        }
        
        function kurangi_anak_grup(object_button, inisial, jumlah_anakan){
            if(jumlah_anakan <= 1){
                var pesan_modal = document.getElementById("pesan_modal");
                pesan_modal.innerHTML = "Sorry only left 1 row and cannot do delete.";
                $('#modal-success').modal('show');
                return false;
            }
            var get_td = object_button.parentNode;
            var get_tr = get_td.parentNode;
            var get_tbody = get_tr.parentNode;
            var get_i_tbody = get_tbody.getElementsByTagName("i");
            var masuk_tambah = 0;
            var masuk_kurang = 0;
            for(var i = 0; i < get_i_tbody.length; i++){
                if(get_i_tbody[i].getAttribute("urutan_grup") === "tombol_anakan_hapus" + inisial){
                    get_i_tbody[i].setAttribute("onclick", "kurang_anak_grup(this,'_1'," + (jumlah_anakan - 1) + ");");
                    masuk_kurang = 1;
                }
                if(get_i_tbody[i].getAttribute("urutan_grup") === "tombol_anakan" + inisial){
                    get_i_tbody[i].setAttribute("onclick", "tambah_anak_grup(this,'_1'," + (jumlah_anakan - 1) + ");");
                    masuk_tambah = 1;
                }
                if(masuk_kurang && masuk_tambah){
                    break;
                }
            }
            get_tr.parentNode.removeChild(get_tr);
            var get_tr_inside = get_tbody.getElementsByTagName("tr");
            var get_tr_active = {};
            var count = 1;
            for(var i = 0; i < get_tr_inside.length; i++){
                if(get_tr_inside[i].getAttribute("class") === "anakan_group" + inisial){
                    get_tr_active = get_tr_inside[i];
                    var get_td_ = get_tr_active.getElementsByTagName("td");
                    for(var j = 0; j < get_td_.length; j++){
                        if(get_td_[j].getAttribute("class") === "td_number" + inisial){
                            get_td_[j].innerHTML = count;
                            break;
                        }
                    }
                    var get_i = get_tr_active.getElementsByTagName("i");
                    if(get_i[0].getAttribute("class") === "fa fa-minus"){
                        get_i[0].setAttribute("onclick", "kurangi_anak_grup(this,'_1'," + (jumlah_anakan - 1) + ");");
                    }
                    if(count === jumlah_anakan){
                        break;
                    }
                    count++;
                }
            }
            get_tr_active.style.borderBottom = "rgb(242,220,219) 2px solid";
            
        }
        
        function kurang_anak_grup(object_button, inisial, jumlah_anakan){
            if(jumlah_anakan <= 1){
                var pesan_modal = document.getElementById("pesan_modal");
                pesan_modal.innerHTML = "Sorry only left 1 row and cannot do delete.";
                $('#modal-success').modal('show');
                return false;
            }
            var get_td = object_button.parentNode;
            var get_tr = get_td.parentNode;
            var get_tbody = get_tr.parentNode;
            
            var get_i_tbody = get_tbody.getElementsByTagName("i");
            for(var i = 0; i < get_i_tbody.length; i++){
                if(get_i_tbody[i].getAttribute("urutan_grup") === "tombol_anakan" + inisial){
                    get_i_tbody[i].setAttribute("onclick", "tambah_anak_grup(this,'_1'," + (jumlah_anakan - 1) + ");");
                    break;
                }
            }
            
            var get_tr_inside = get_tbody.getElementsByTagName("tr");
            var get_tr_active = {};
            var get_tr_active_before = {};
            var count = 1;
            for(var i = 0; i < get_tr_inside.length; i++){
                if(get_tr_inside[i].getAttribute("class") === "anakan_group" + inisial){
                    get_tr_active = get_tr_inside[i];
                    var get_i = get_tr_active.getElementsByTagName("i");
                    if(get_i[0].getAttribute("class") === "fa fa-minus"){
                        get_i[0].setAttribute("onclick", "kurangi_anak_grup(this,'_1'," + (jumlah_anakan - 1) + ");");
                    }
                    if(count === jumlah_anakan){
                        get_tr_active.parentNode.removeChild(get_tr_inside[i]);
                        break;
                    } else {
                        get_tr_active_before = get_tr_inside[i];
                    }
                    count++;
                }
            }
            object_button.setAttribute("onclick", "kurang_anak_grup(this,'_1'," + (jumlah_anakan - 1) + ");");
            get_tr_active_before.style.borderBottom = "rgb(242,220,219) 2px solid";
        }
        
        function tambah_anak_grup(object_button, inisial, jumlah_anakan){
            // console.log("TAMBAH");
            var get_td = object_button.parentNode;
            var get_tr = get_td.parentNode;
            var get_tbody = get_tr.parentNode;
            
            var get_i_tbody = get_tbody.getElementsByTagName("i");
            for(var i = 0; i < get_i_tbody.length; i++){
                if(get_i_tbody[i].getAttribute("urutan_grup") === "tombol_anakan_hapus" + inisial){
                    get_i_tbody[i].setAttribute("onclick", "kurang_anak_grup(this,'_1'," + (jumlah_anakan + 1) + ");");
                    break;
                }
            }
            
            var get_tr_inside = get_tbody.getElementsByTagName("tr");
            var get_tr_active = {};
            var count = 1;
            for(var i = 0; i < get_tr_inside.length; i++){
                if(get_tr_inside[i].getAttribute("class") === "anakan_group" + inisial){
                    get_tr_active = get_tr_inside[i];
                    var get_i = get_tr_active.getElementsByTagName("i");
                    if(get_i[0].getAttribute("class") === "fa fa-minus"){
                        get_i[0].setAttribute("onclick", "kurangi_anak_grup(this,'_1'," + (jumlah_anakan + 1) + ");");
                    }
                    if(count === jumlah_anakan){
                        break;
                    }
                    count++;
                }
            }
            var clone_tr = get_tr_active.cloneNode(true);
            var get_td_clone = clone_tr.getElementsByTagName("td");
            for(var i = 0; i < get_td_clone.length; i++){
                if(get_td_clone[i].getAttribute("class") === "td_number" + inisial){
                    get_td_clone[i].innerHTML = (jumlah_anakan + 1);
                    break;
                }
            }
            var get_td_input_clone = clone_tr.getElementsByTagName("input");
            for(var i = 0; i < get_td_input_clone.length; i++){
                if(get_td_input_clone[i].getAttribute("type") === "number"){
                    get_td_input_clone[i].value = "0.00";
                }
            }
            object_button.setAttribute("onclick", "tambah_anak_grup(this,'_1'," + (jumlah_anakan + 1) + ");");
            get_tr_active.style.border = "";
            get_tbody.insertBefore(clone_tr, get_tr_active.nextSibling);
            re_trigger_numberonly_input();
        }
        </script>
        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group">
                    <label for="kode_project" class="col-md-2 control-label merah">Kode Project</label>
                    <div class="col-md-10">
                        <input type="text" id="kode_project" class="form-control" name="kode_project" placeholder="Kode Project" value="{replace_project_modal}" disabled>
                        <input type="hidden" name="kode" value="{replace_project_modal}" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="satuan_kerja" class="col-md-2 control-label">Satuan Kerja</label>
                    <div class="col-md-10">
                        <input required type="text" id="satuan_kerja" class="form-control tambah-margin-bawah" name="satuan_kerja" placeholder="Satuan Kerja" value="<?php echo isset($satuan_kerja) ? $satuan_kerja : ""; ?>">
                    </div>
                    
                </div>
                
                <div class="form-group">
                    <label for="kegiatan_program_kerja" class="col-md-2 control-label">Kegiatan Program Kerja</label>
                    <div class="col-md-8">
                        <input required type="text" id="kegiatan_program_kerja" class="form-control tambah-margin-bawah" name="kegiatan_program_kerja" placeholder="Kegiatan Program Kerja" value="<?php echo isset($kegiatan_program_kerja) ? $kegiatan_program_kerja : ""; ?>">
                    </div>
                    <div class="col-md-2">
                        <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search">Search</button>
                    </div>
                </div>
                <div class="form-group" id="form_group_a">
                    <label for="mata_anggaran" class="col-md-2 control-label">Mata Anggaran</label>
                    <div class="col-md-8">
                        <input required type="text" id="satuan_kerja" class="form-control tambah-margin-bawah" name="mata_anggaran" placeholder="Mata Anggaran" value="<?php echo isset($mata_anggaran) ? $mata_anggaran : ""; ?>">
                    </div>
                    <div class="col-md-2">
                        <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search">Search</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <table class="styled-table" style="border: #f1f1f1 1px solid; ">
                            <thead>
                                <tr>
                                    <th colspan="7" style="text-align: center; border-right: #f1f1f1 1px solid; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Rincian Mata Anggaran</th>
                                    <th colspan="10" style="text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">RPPT</th>
                                </tr>
                                <tr>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2" colspan="2">Nomor</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">Nama</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Ref. Tarif</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Q</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">F</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Tarif</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Sub Total</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW I</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW II</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="3">TW III</th>
                                    <th style="border-bottom: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" colspan="2">TW IV</th>
                                </tr>
                                <tr>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                    <th style="border-right: #f1f1f1 1px solid; white-space: nowrap;">&nbsp;</th>
                                    <th style="border-right: #f1f1f1 1px solid; white-space: nowrap;">&nbsp;</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" colspan="2">Nom</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border-left: #f1f1f1 1px solid; text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-minus" urutan_grup="tombol_anakan_hapus_1" style="cursor: pointer;" onclick="kurang_anak_grup(this,'_1',1);"></i></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-plus" urutan_grup="tombol_anakan_1" style="cursor: pointer;" onclick="tambah_anak_grup(this,'_1',1);"></i></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid; background-color: rgb(220,230,241);" colspan="14"><b>GROUP DEFAULT</b></td>
                                    <td style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-plus"></i></td>
                                </tr>
                                <tr style="border-bottom: rgb(242,220,219) 2px solid;" class="anakan_group_1">
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 4.25%;" colspan="2" class="td_number_1">1</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;">LOOKUP</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="Q_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="Q" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="F_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="F" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="tarif_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="tarif_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="persen_tw1_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="tw1_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="persen_tw2_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="tw2_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="persen_tw3_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="tw3_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="persen_tw4_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="tw4_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="border-right: #f1f1f1 1px solid; text-align: center; width: 40px; padding: 0px; vertical-align: middle; width: 4.25%;"><i class="fa fa-minus" onclick="kurangi_anak_grup(this,'_1',1);" style="cursor: pointer;"></i></td>
                                </tr>
                                <tr class="jumlah_anakan_1">
                                    <td style="text-align: right; border-right: #f0f0f0 1px solid;" colspan="7">Total</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);">&nbsp;</td>
                                    <td style="border-right: #f1f1f1 1px solid; text-align: center; width: 40px"><i class="fa fa-plus"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>