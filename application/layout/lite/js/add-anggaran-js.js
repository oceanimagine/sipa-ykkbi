function detect_address_left(object_input){
    setTimeout(function(){
        var get_td = object_input.parentNode;
        var get_tr = get_td.parentNode;
        var get_name = object_input.getAttribute("name");

        var get_input_ = get_tr.getElementsByTagName("input");
        var get_focus = 0;
        for(var i = 0; i < get_input_.length; i++){
            if(get_input_[i].getAttribute("type") === "number" || get_input_[i].getAttribute("type") === "text"){
                if(get_input_[i].getAttribute("name") === get_name){
                    break;
                }
                get_input_[i].focus();
                get_focus = 1;
            }
        }
        if(!get_focus){
            for(var i = 0; i < get_input_.length; i++){
                if(get_input_[i].getAttribute("type") === "number" || get_input_[i].getAttribute("type") === "text"){
                    get_input_[i].focus();
                }
            }
        }
    },100);
    
}

function detect_address_right(object_input){
    setTimeout(function(){
        var get_td = object_input.parentNode;
        var get_tr = get_td.parentNode;
        var get_name = object_input.getAttribute("name");

        var get_input_ = get_tr.getElementsByTagName("input");
        var after = 0;
        var get_focus = 0;
        for(var i = 0; i < get_input_.length; i++){
            if(get_input_[i].getAttribute("type") === "number" || get_input_[i].getAttribute("type") === "text"){
                if(!after){
                    if(get_input_[i].getAttribute("name") === get_name){
                        after = 1;
                    }
                } else {
                    get_input_[i].focus();
                    get_focus = 1; 
                    break;
                }
            }
        }
        if(!get_focus){
            for(var i = 0; i < get_input_.length; i++){
                if(get_input_[i].getAttribute("type") === "number" || get_input_[i].getAttribute("type") === "text"){
                    get_input_[i].focus();
                    break;
                }
            }
        }
    },100);
}

function detect_address_down(object_input){
    setTimeout(function(){
        var get_td = object_input.parentNode;
        var get_tr = get_td.parentNode;
        get_tr.setAttribute("active_down", "down_row");

        var get_name = object_input.getAttribute("name");
        var get_split = get_name.split("_");
        var get_split_b = get_split[get_split.length-1].split("[]");
        var inisial = "_" + get_split_b[0];

        var get_tbody = get_tr.parentNode;
        var get_tr_tbody = get_tbody.getElementsByTagName("tr");
        var get_tr_active = false;
        var after_tr = 0;
        for(var i = 0; i < get_tr_tbody.length; i++){
            if(get_tr_tbody[i].getAttribute("class") === "anakan_group" + inisial){
                if(!after_tr){
                    if(get_tr_tbody[i].getAttribute("active_down") === "down_row"){
                        after_tr = 1;
                    }
                } else {
                    get_tr_active = get_tr_tbody[i];
                    break;
                }
            }
        }
        if(!get_tr_active){
            for(var i = 0; i < get_tr_tbody.length; i++){
                if(get_tr_tbody[i].getAttribute("class") === "anakan_group" + inisial){
                    get_tr_active = get_tr_tbody[i];
                    break;
                }
            }
        }
        var get_input_ = get_tr_active.getElementsByTagName("input");
        for(var i = 0; i < get_input_.length; i++){
            if(get_input_[i].getAttribute("type") === "number" || get_input_[i].getAttribute("type") === "text"){
                if(get_input_[i].getAttribute("name") === get_name){
                    get_input_[i].focus();
                    break;
                }
            }
        }
        get_tr.removeAttribute("active_down");
    },100);
}

function detect_address_up(object_input){
    setTimeout(function(){
        var get_td = object_input.parentNode;
        var get_tr = get_td.parentNode;
        get_tr.setAttribute("active_up", "up_row");

        var get_name = object_input.getAttribute("name");
        var get_split = get_name.split("_");
        var get_split_b = get_split[get_split.length-1].split("[]");
        var inisial = "_" + get_split_b[0];

        var get_tbody = get_tr.parentNode;
        var get_tr_tbody = get_tbody.getElementsByTagName("tr");
        var get_tr_active = false;
        for(var i = 0; i < get_tr_tbody.length; i++){
            if(get_tr_tbody[i].getAttribute("class") === "anakan_group" + inisial){
                if(get_tr_tbody[i].getAttribute("active_up") === "up_row"){
                    break;
                }
                get_tr_active = get_tr_tbody[i];
            }
        }
        if(!get_tr_active){
            for(var i = 0; i < get_tr_tbody.length; i++){
                if(get_tr_tbody[i].getAttribute("class") === "anakan_group" + inisial){
                    get_tr_active = get_tr_tbody[i];
                }
            }
        }
        var get_input_ = get_tr_active.getElementsByTagName("input");
        for(var i = 0; i < get_input_.length; i++){
            if(get_input_[i].getAttribute("type") === "number" || get_input_[i].getAttribute("type") === "text"){
                if(get_input_[i].getAttribute("name") === get_name){
                    get_input_[i].focus();
                    break;
                }
            }
        }
        get_tr.removeAttribute("active_up");
    },100);
}

function detect_address_input_delete(object_input){
    var get_td = object_input.parentNode;
    var get_tr = get_td.parentNode;
    get_tr.setAttribute("active_delete_esc", "delete_esc");

    var get_name = object_input.getAttribute("name");
    var get_split = get_name.split("_");
    var get_split_b = get_split[get_split.length-1].split("[]");

    var inisial = "_" + get_split_b[0];

    var get_tbody = get_tr.parentNode;
    var get_tr_tbody = get_tbody.getElementsByTagName("tr");
    var get_tr_after = {};
    if(get_tr.getAttribute("style") === "border-bottom: rgb(242,220,219) 2px solid;" || get_tr.getAttribute("style") === "border-bottom: 2px solid rgb(242, 220, 219);"){
        for(var i = 0; i < get_tr_tbody.length; i++){
            if(get_tr_tbody[i].getAttribute("class") === "anakan_group" + inisial){
                get_tr_after = get_tr_tbody[i - 1];
            }
        }
    } else {
        var after_found = 0;
        for(var i = 0; i < get_tr_tbody.length; i++){
            if(get_tr_tbody[i].getAttribute("class") === "anakan_group" + inisial){
                if(after_found){
                    get_tr_after = get_tr_tbody[i];
                    break;
                }
                if(get_tr_tbody[i].getAttribute("active_delete_esc") === "delete_esc"){
                    after_found = 1;
                }
            }
        }
    }
    get_tr.removeAttribute("active_delete_esc");
    // console.log("TR AFTER");
    // console.log(get_tr_after);

    var get_input_ = get_tr_after.getElementsByTagName("input");
    var tmp_input_ = {"undefined":true};
    for(var i = 0; i < get_input_.length; i++){
        if(get_input_[i].getAttribute("type") === "number" || get_input_[i].getAttribute("type") === "text"){
            if(get_input_[i].getAttribute("name") === get_name){
                tmp_input_ = get_input_[i];
                break;
            }
        }
    }

    var get_i_tr = get_tr.getElementsByTagName("i");
    if(get_i_tr[0].getAttribute("class") === "fa fa-minus"){
        var fungsi = get_i_tr[0].getAttribute("onclick");
        var split_comma = fungsi.split(",");
        var split_kurung = split_comma[split_comma.length - 1].split(")");
        kurangi_anak_grup(get_i_tr[0], inisial, Number(split_kurung[0]));
        if(typeof tmp_input_.undefined === "undefined"){
            tmp_input_.focus();
        }
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
        if(get_td_input[i].getAttribute("type") === "number" || get_td_input[i].getAttribute("type") === "text"){
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
    if(typeof konfirmasi_hapus !== "undefined" && konfirmasi_hapus){
        var pesan_modal = document.getElementById("pesan_modal");
        pesan_modal.innerHTML = "Tombol disabled sedang dalam mode konfirmasi hapus.";
        $('#modal-success').modal('show');
        return false;
    }
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
            get_i_tbody[i].setAttribute("onclick", "kurang_anak_grup(this,'"+inisial+"'," + (jumlah_anakan - 1) + ");");
            masuk_kurang = 1;
        }
        if(get_i_tbody[i].getAttribute("urutan_grup") === "tombol_anakan" + inisial){
            get_i_tbody[i].setAttribute("onclick", "tambah_anak_grup(this,'"+inisial+"'," + (jumlah_anakan - 1) + ");");
            masuk_tambah = 1;
        }
        if(masuk_kurang && masuk_tambah){
            break;
        }
    }
    get_tr.parentNode.removeChild(get_tr);
    var get_tr_inside = get_tbody.getElementsByTagName("tr");
    var get_tr_active = {};
    var tmp_input = {};
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
            var get_input = get_tr_active.getElementsByTagName("input");
            for(var j = 0; j < get_input.length; j++){
                if(get_input[j].getAttribute("name").substr(0, "subtotal_".length) === "subtotal_"){
                    tmp_input = get_input[j];
                    break;
                }
            }
            if(get_i[0].getAttribute("class") === "fa fa-minus"){
                get_i[0].setAttribute("onclick", "kurangi_anak_grup(this,'"+inisial+"'," + (jumlah_anakan - 1) + ");");
            }
            if(count === jumlah_anakan){
                break;
            }
            count++;
        }
    }
    tmp_input.focus();
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
            get_i_tbody[i].setAttribute("onclick", "tambah_anak_grup(this,'"+inisial+"'," + (jumlah_anakan - 1) + ");");
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
                get_i[0].setAttribute("onclick", "kurangi_anak_grup(this,'"+inisial+"'," + (jumlah_anakan - 1) + ");");
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
    object_button.setAttribute("onclick", "kurang_anak_grup(this,'"+inisial+"'," + (jumlah_anakan - 1) + ");");
    get_tr_active_before.style.borderBottom = "rgb(242,220,219) 2px solid";
}

function check_nom_all_row(){
    var table_anggaran_tahunan = document.getElementById("table-anggaran-tahunan");
    var get_tbody = table_anggaran_tahunan.getElementsByTagName("tbody");
    var get_all_tr = get_tbody[0].getElementsByTagName("tr");
    
    
    for(var i = 0; i < get_all_tr.length; i++){
        
        if(get_all_tr[i].getAttribute("class").substr(0,"anakan_group_".length) === "anakan_group_"){
            var get_input_ = get_all_tr[i].getElementsByTagName("input");

            var tw1_ = 0;
            var tw2_ = 0;
            var tw3_ = 0;
            var tw4_ = 0;
            var persen_tw1_ = 0;
            var persen_tw2_ = 0;
            var persen_tw3_ = 0;
            var persen_tw4_ = 0;
            var jumlah_tw = 0;
            var jumlah_tw_perbandingan = 0;

            for(var k = 0; k < get_input_.length; k++){
                if(get_input_[k].getAttribute("name").substr(0, "tw1_".length) === "tw1_"){
                    tw1_ = Number(get_input_[k].value);
                }
                if(get_input_[k].getAttribute("name").substr(0, "tw2_".length) === "tw2_"){
                    tw2_ = Number(get_input_[k].value);
                }
                if(get_input_[k].getAttribute("name").substr(0, "tw3_".length) === "tw3_"){
                    tw3_ = Number(get_input_[k].value);
                }
                if(get_input_[k].getAttribute("name").substr(0, "tw4_".length) === "tw4_"){
                    tw4_ = Number(get_input_[k].value);
                    jumlah_tw = tw1_ + tw2_ + tw3_ + tw4_;
                }
            }
            
            for(var k = 0; k < get_input_.length; k++){
                if(get_input_[k].getAttribute("name").substr(0, "subtotal_".length) === "subtotal_"){
                    jumlah_tw_perbandingan = Number(get_input_[k].value);
                }
            }
            
            for(var k = 0; k < get_input_.length; k++){
                if(get_input_[k].getAttribute("name").substr(0, "persen_tw1_".length) === "persen_tw1_"){
                    persen_tw1_ = ((tw1_ / jumlah_tw_perbandingan) * 100).toFixed(2);
                    // console.log(tw1_);
                    // console.log(persen_tw1_);
                    get_input_[k].value = isNaN(persen_tw1_) ? "0.00" : persen_tw1_;
                }
                if(get_input_[k].getAttribute("name").substr(0, "persen_tw2_".length) === "persen_tw2_"){
                    persen_tw2_ = ((tw2_ / jumlah_tw_perbandingan) * 100).toFixed(2);
                    get_input_[k].value = isNaN(persen_tw2_) ? "0.00" : persen_tw2_;
                }
                if(get_input_[k].getAttribute("name").substr(0, "persen_tw3_".length) === "persen_tw3_"){
                    persen_tw3_ = ((tw3_ / jumlah_tw_perbandingan) * 100).toFixed(2);
                    get_input_[k].value = isNaN(persen_tw3_) ? "0.00" : persen_tw3_;
                }
                if(get_input_[k].getAttribute("name").substr(0, "persen_tw4_".length) === "persen_tw4_"){
                    persen_tw4_ = ((tw4_ / jumlah_tw_perbandingan) * 100).toFixed(2);
                    get_input_[k].value = isNaN(persen_tw4_) ? "0.00" : persen_tw4_;
                }
            }
            
            var last_temp = [];
            var address_temp = 0;
            for(var k = 0; k < get_input_.length; k++){
                if(get_input_[k].getAttribute("name").substr(0, "tw1_".length) === "tw1_"){
                    if(jumlah_tw_perbandingan !== jumlah_tw){
                        get_input_[k].style.borderTop = "red 1px solid";
                        get_input_[k].style.borderRight = "red 1px solid";
                        get_input_[k].style.borderLeft = "red 1px solid";
                        last_temp[address_temp] = get_input_[k];
                        address_temp++;
                    }
                    if(jumlah_tw_perbandingan === jumlah_tw){
                        get_input_[k].style.border = "none";
                    }
                }
                if(get_input_[k].getAttribute("name").substr(0, "tw2_".length) === "tw2_"){
                    if(jumlah_tw_perbandingan !== jumlah_tw){
                        get_input_[k].style.borderTop = "red 1px solid";
                        get_input_[k].style.borderRight = "red 1px solid";
                        get_input_[k].style.borderLeft = "red 1px solid";
                        last_temp[address_temp] = get_input_[k];
                        address_temp++;
                    }
                    if(jumlah_tw_perbandingan === jumlah_tw){
                        get_input_[k].style.border = "none";
                    }
                }
                if(get_input_[k].getAttribute("name").substr(0, "tw3_".length) === "tw3_"){
                    if(jumlah_tw_perbandingan !== jumlah_tw){
                        get_input_[k].style.borderTop = "red 1px solid";
                        get_input_[k].style.borderRight = "red 1px solid";
                        get_input_[k].style.borderLeft = "red 1px solid";
                        last_temp[address_temp] = get_input_[k];
                        address_temp++;
                    }
                    if(jumlah_tw_perbandingan === jumlah_tw){
                        get_input_[k].style.border = "none";
                    }
                }
                if(get_input_[k].getAttribute("name").substr(0, "tw4_".length) === "tw4_"){
                    if(jumlah_tw_perbandingan !== jumlah_tw){
                        get_input_[k].style.borderTop = "red 1px solid";
                        get_input_[k].style.borderRight = "red 1px solid";
                        get_input_[k].style.borderLeft = "red 1px solid";
                        last_temp[address_temp] = get_input_[k];
                        address_temp++;
                    }
                    if(jumlah_tw_perbandingan === jumlah_tw){
                        get_input_[k].style.border = "none";
                    }
                }
            }
        } else {
            if(typeof last_temp === "object"){
                for(var j = 0; j < last_temp.length; j++){
                    last_temp[j].style.borderBottom = "red 1px solid";
                }
            }
        }
    }
    
}

function check_nom_baris_sebelumnya(object_tr){
    var get_input_ = object_tr.getElementsByTagName("input");
    
    var tw1_ = 0;
    var tw2_ = 0;
    var tw3_ = 0;
    var tw4_ = 0;
    var jumlah_tw = 0;
    var jumlah_tw_perbandingan = 0;
    
    
     for(var k = 0; k < get_input_.length; k++){
        if(get_input_[k].getAttribute("name").substr(0, "tw1_".length) === "tw1_"){
            tw1_ = Number(get_input_[k].value);
        }
        if(get_input_[k].getAttribute("name").substr(0, "tw2_".length) === "tw2_"){
            tw2_ = Number(get_input_[k].value);
        }
        if(get_input_[k].getAttribute("name").substr(0, "tw3_".length) === "tw3_"){
            tw3_ = Number(get_input_[k].value);
        }
        if(get_input_[k].getAttribute("name").substr(0, "tw4_".length) === "tw4_"){
            tw4_ = Number(get_input_[k].value);
            jumlah_tw = tw1_ + tw2_ + tw3_ + tw4_;
        }
    }
    for(var k = 0; k < get_input_.length; k++){
        if(get_input_[k].getAttribute("name").substr(0, "subtotal_".length) === "subtotal_"){
            jumlah_tw_perbandingan = Number(get_input_[k].value);
        }
    }
    
    for(var k = 0; k < get_input_.length; k++){
        if(get_input_[k].getAttribute("name").substr(0, "tw1_".length) === "tw1_"){
            if(jumlah_tw_perbandingan !== jumlah_tw){
                get_input_[k].style.borderBottom = "red 1px solid";
            }
        }
        if(get_input_[k].getAttribute("name").substr(0, "tw2_".length) === "tw2_"){
            if(jumlah_tw_perbandingan !== jumlah_tw){
                get_input_[k].style.borderBottom = "red 1px solid";
            }
        }
        if(get_input_[k].getAttribute("name").substr(0, "tw3_".length) === "tw3_"){
            if(jumlah_tw_perbandingan !== jumlah_tw){
                get_input_[k].style.borderBottom = "red 1px solid";
            }
        }
        if(get_input_[k].getAttribute("name").substr(0, "tw4_".length) === "tw4_"){
            if(jumlah_tw_perbandingan !== jumlah_tw){
                get_input_[k].style.borderBottom = "red 1px solid";
            }
        }
    }
}

function check_nom_baris_sebelumnya_border_bottom(object_tr){
    var get_input_ = object_tr.getElementsByTagName("input");
    
    var tw1_ = 0;
    var tw2_ = 0;
    var tw3_ = 0;
    var tw4_ = 0;
    var jumlah_tw = 0;
    var jumlah_tw_perbandingan = 0;
    
    
     for(var k = 0; k < get_input_.length; k++){
        if(get_input_[k].getAttribute("name").substr(0, "tw1_".length) === "tw1_"){
            tw1_ = Number(get_input_[k].value);
        }
        if(get_input_[k].getAttribute("name").substr(0, "tw2_".length) === "tw2_"){
            tw2_ = Number(get_input_[k].value);
        }
        if(get_input_[k].getAttribute("name").substr(0, "tw3_".length) === "tw3_"){
            tw3_ = Number(get_input_[k].value);
        }
        if(get_input_[k].getAttribute("name").substr(0, "tw4_".length) === "tw4_"){
            tw4_ = Number(get_input_[k].value);
            jumlah_tw = tw1_ + tw2_ + tw3_ + tw4_;
        }
    }
    for(var k = 0; k < get_input_.length; k++){
        if(get_input_[k].getAttribute("name").substr(0, "subtotal_".length) === "subtotal_"){
            jumlah_tw_perbandingan = Number(get_input_[k].value);
        }
    }
    
    for(var k = 0; k < get_input_.length; k++){
        if(get_input_[k].getAttribute("name").substr(0, "tw1_".length) === "tw1_"){
            if(jumlah_tw_perbandingan !== jumlah_tw){
                get_input_[k].style.border = "none";
                get_input_[k].style.borderTop = "red 1px solid";
                get_input_[k].style.borderRight = "red 1px solid";
                get_input_[k].style.borderLeft = "red 1px solid";
            }
        }
        if(get_input_[k].getAttribute("name").substr(0, "tw2_".length) === "tw2_"){
            if(jumlah_tw_perbandingan !== jumlah_tw){
                get_input_[k].style.border = "none";
                get_input_[k].style.borderTop = "red 1px solid";
                get_input_[k].style.borderRight = "red 1px solid";
                get_input_[k].style.borderLeft = "red 1px solid";
            }
        }
        if(get_input_[k].getAttribute("name").substr(0, "tw3_".length) === "tw3_"){
            if(jumlah_tw_perbandingan !== jumlah_tw){
                get_input_[k].style.border = "none";
                get_input_[k].style.borderTop = "red 1px solid";
                get_input_[k].style.borderRight = "red 1px solid";
                get_input_[k].style.borderLeft = "red 1px solid";
            }
        }
        if(get_input_[k].getAttribute("name").substr(0, "tw4_".length) === "tw4_"){
            if(jumlah_tw_perbandingan !== jumlah_tw){
                get_input_[k].style.border = "none";
                get_input_[k].style.borderTop = "red 1px solid";
                get_input_[k].style.borderRight = "red 1px solid";
                get_input_[k].style.borderLeft = "red 1px solid";
            }
        }
    }
}

function check_percent_nom_baris(object_input){
    
    var get_td = object_input.parentNode;
    var get_tr = get_td.parentNode;
    var get_class = get_tr.getAttribute("class");
    var get_address_split = get_class.split("_");
    var get_address = get_address_split[get_address_split.length - 1];
    
    var get_input_source_name = object_input.getAttribute("name");
    var get_input_source_tw = "0";
    var value_active_source = "";
    var jumlah_tw_perbandingan = 0;
    if(get_input_source_name.substr(0,"persen_tw".length) === "persen_tw"){
        get_input_source_tw = get_input_source_name.substr("persen_tw".length, 1);
        value_active_source = object_input.value;
        var get_td_ = object_input.parentNode;
        var get_tr_ = get_td_.parentNode;
        var get_input_ = get_tr_.getElementsByTagName("input");
        for(var k = 0; k < get_input_.length; k++){
            if(get_input_[k].getAttribute("name").substr(0, "subtotal_".length) === "subtotal_"){
                jumlah_tw_perbandingan = Number(get_input_[k].value);
            }
        }
        for(var k = 0; k < get_input_.length; k++){
            var split_name = get_input_[k].getAttribute("name").split("_");
            // console.log(split_name);
            if(split_name.length === 2){
                if(get_input_[k].getAttribute("name").substr(0,("tw"+get_input_source_tw+"_"+get_address).length) === "tw"+get_input_source_tw+"_"+get_address){
                    get_input_[k].value = (value_active_source / 100 * jumlah_tw_perbandingan).toFixed(2);
                    break;
                }
            }
            if(split_name.length === 3){
                if(get_input_[k].getAttribute("name").substr(0,("tw"+get_input_source_tw+"_"+split_name[1]+"_"+get_address).length) === "tw"+get_input_source_tw+"_"+split_name[1]+"_"+get_address){
                    get_input_[k].value = (value_active_source / 100 * jumlah_tw_perbandingan).toFixed(2);
                    break;
                }
            }
        }
    }
    
}

function check_nom_per_baris(object_input){
    var get_td = object_input.parentNode;
    var get_tr = get_td.parentNode;
    var get_class = get_tr.getAttribute("class");
    var get_address_split = get_class.split("_");
    var get_address = get_address_split[get_address_split.length - 1];
    var get_tbody = get_tr.parentNode;
    var get_all_tr = get_tbody.getElementsByTagName("tr");
    
    var tambah_anakan = 0;
    var temp_tr = {"undefined":true};
    for(var i = 0; i < get_all_tr.length; i++){
        if(get_all_tr[i].getAttribute("class") === "anakan_group_" + get_address){
            var get_input_ = get_all_tr[i].getElementsByTagName("input");

            var tw1_ = 0;
            var tw2_ = 0;
            var tw3_ = 0;
            var tw4_ = 0;
            var persen_tw1_ = 0;
            var persen_tw2_ = 0;
            var persen_tw3_ = 0;
            var persen_tw4_ = 0;
            var jumlah_tw = 0;
            var jumlah_tw_perbandingan = 0;
            var masuk_pengecekan = false;
            
            for(var k = 0; k < get_input_.length; k++){
                if(get_input_[k].getAttribute("name").substr(0, "subtotal_".length) === "subtotal_"){
                    jumlah_tw_perbandingan = Number(get_input_[k].value);
                }
            }
            
            for(var k = 0; k < get_input_.length; k++){
                if(get_input_[k].getAttribute("name").substr(0, "tw1_".length) === "tw1_"){
                    tw1_ = Number(get_input_[k].value);
                }
                if(get_input_[k].getAttribute("name").substr(0, "tw2_".length) === "tw2_"){
                    tw2_ = Number(get_input_[k].value);
                }
                if(get_input_[k].getAttribute("name").substr(0, "tw3_".length) === "tw3_"){
                    tw3_ = Number(get_input_[k].value);
                }
                if(get_input_[k].getAttribute("name").substr(0, "tw4_".length) === "tw4_"){
                    tw4_ = Number(get_input_[k].value);
                    jumlah_tw = tw1_ + tw2_ + tw3_ + tw4_;
                }
            }
            
            for(var k = 0; k < get_input_.length; k++){
                if(get_input_[k].getAttribute("name").substr(0, "persen_tw1_".length) === "persen_tw1_"){
                    persen_tw1_ = ((tw1_ / jumlah_tw_perbandingan) * 100).toFixed(2);
                    get_input_[k].value = isNaN(persen_tw1_) ? "0.00" : persen_tw1_;
                }
                if(get_input_[k].getAttribute("name").substr(0, "persen_tw2_".length) === "persen_tw2_"){
                    persen_tw2_ = ((tw2_ / jumlah_tw_perbandingan) * 100).toFixed(2);
                    get_input_[k].value = isNaN(persen_tw2_) ? "0.00" : persen_tw2_;
                }
                if(get_input_[k].getAttribute("name").substr(0, "persen_tw3_".length) === "persen_tw3_"){
                    persen_tw3_ = ((tw3_ / jumlah_tw_perbandingan) * 100).toFixed(2);
                    get_input_[k].value = isNaN(persen_tw3_) ? "0.00" : persen_tw3_;
                }
                if(get_input_[k].getAttribute("name").substr(0, "persen_tw4_".length) === "persen_tw4_"){
                    persen_tw4_ = ((tw4_ / jumlah_tw_perbandingan) * 100).toFixed(2);
                    get_input_[k].value = isNaN(persen_tw4_) ? "0.00" : persen_tw4_;
                }
            }
            
            var last_temp = [];
            var address_temp = 0;
            for(var k = 0; k < get_input_.length; k++){
                if(get_input_[k].getAttribute("name").substr(0, "tw1_".length) === "tw1_"){
                    if(jumlah_tw_perbandingan !== jumlah_tw){
                        get_input_[k].style.borderTop = "red 1px solid";
                        get_input_[k].style.borderRight = "red 1px solid";
                        get_input_[k].style.borderLeft = "red 1px solid";
                        last_temp[address_temp] = get_input_[k];
                        address_temp++;
                    }
                    if(jumlah_tw_perbandingan === jumlah_tw){
                        get_input_[k].style.border = "none";
                    }
                }
                if(get_input_[k].getAttribute("name").substr(0, "tw2_".length) === "tw2_"){
                    if(jumlah_tw_perbandingan !== jumlah_tw){
                        get_input_[k].style.borderTop = "red 1px solid";
                        get_input_[k].style.borderRight = "red 1px solid";
                        get_input_[k].style.borderLeft = "red 1px solid";
                        last_temp[address_temp] = get_input_[k];
                        address_temp++;
                    }
                    if(jumlah_tw_perbandingan === jumlah_tw){
                        get_input_[k].style.border = "none";
                    }
                }
                if(get_input_[k].getAttribute("name").substr(0, "tw3_".length) === "tw3_"){
                    if(jumlah_tw_perbandingan !== jumlah_tw){
                        get_input_[k].style.borderTop = "red 1px solid";
                        get_input_[k].style.borderRight = "red 1px solid";
                        get_input_[k].style.borderLeft = "red 1px solid";
                        last_temp[address_temp] = get_input_[k];
                        address_temp++;
                    }
                    if(jumlah_tw_perbandingan === jumlah_tw){
                        get_input_[k].style.border = "none";
                    }
                }
                if(get_input_[k].getAttribute("name").substr(0, "tw4_".length) === "tw4_"){
                    if(jumlah_tw_perbandingan !== jumlah_tw){
                        get_input_[k].style.borderTop = "red 1px solid";
                        get_input_[k].style.borderRight = "red 1px solid";
                        get_input_[k].style.borderLeft = "red 1px solid";
                        last_temp[address_temp] = get_input_[k];
                        address_temp++;
                    }
                    if(jumlah_tw_perbandingan === jumlah_tw){
                        get_input_[k].style.border = "none";
                        if(typeof temp_tr.undefined === "undefined"){
                            /* console.log(temp_tr); */
                            masuk_pengecekan = true;
                            check_nom_baris_sebelumnya(temp_tr);
                        }
                    }
                }
            }
            if(typeof temp_tr.undefined === "undefined" && !masuk_pengecekan){
                check_nom_baris_sebelumnya_border_bottom(temp_tr);
            }
            temp_tr = get_all_tr[i];
            tambah_anakan++;
        }
    }
    for(var j = 0; j < last_temp.length; j++){
        last_temp[j].style.borderBottom = "red 1px solid";
    }
}

function jumlahkan_nom_per_baris(object_input){
    var get_td = object_input.parentNode;
    var get_tr = get_td.parentNode;
    var get_input = get_tr.getElementsByTagName("input");
    var Q_ = 0;
    var F_ = 0;
    var tarif_ = 0;
    for(var k = 0; k < get_input.length; k++){
         if(get_input[k].getAttribute("name").substr(0, "Q_".length) === "Q_"){
             Q_ = Number(get_input[k].value);
         }
         if(get_input[k].getAttribute("name").substr(0, "F_".length) === "F_"){
             F_ = Number(get_input[k].value);
         }
         if(get_input[k].getAttribute("name").substr(0, "tarif_".length) === "tarif_"){
             tarif_ = Number(get_input[k].value);
         }
         if(get_input[k].getAttribute("name").substr(0, "subtotal_".length) === "subtotal_"){
             get_input[k].value = Q_ * F_ *tarif_;
         }
    }
}

function jumlahkan_nom(object_input){
    /* console.log(object_input); */
    var get_td = object_input.parentNode;
    var get_tr = get_td.parentNode;
    var get_tbody = get_tr.parentNode;
    var get_class = get_tr.getAttribute("class");
    var get_address_split = get_class.split("_");
    var get_address = get_address_split[get_address_split.length - 1];
    
    var get_all_tr = get_tbody.getElementsByTagName("tr");
    var subtotal_ = 0;
    var tw1_ = 0;
    var tw2_ = 0;
    var tw3_ = 0;
    var tw4_ = 0;
    var get_td_all = {};
    for(var i = 0; i < get_all_tr.length; i++){
        if(get_all_tr[i].getAttribute("class") === "anakan_group_" + get_address){
            get_td_all = get_all_tr[i].getElementsByTagName("td");
            for(var j = 0; j < get_td_all.length; j++){
                var get_input = get_td_all[j].getElementsByTagName("input");
                for(var k = 0; k < get_input.length; k++){
                    if(get_input[k].getAttribute("name").substr(0, "subtotal_".length) === "subtotal_"){
                        subtotal_ = subtotal_ + Number(get_input[k].value);
                    }
                    if(get_input[k].getAttribute("name").substr(0, "tw1_".length) === "tw1_"){
                        tw1_ = tw1_ + Number(get_input[k].value);
                    }
                    if(get_input[k].getAttribute("name").substr(0, "tw2_".length) === "tw2_"){
                        tw2_ = tw2_ + Number(get_input[k].value);
                    }
                    if(get_input[k].getAttribute("name").substr(0, "tw3_".length) === "tw3_"){
                        tw3_ = tw3_ + Number(get_input[k].value);
                    }
                    if(get_input[k].getAttribute("name").substr(0, "tw4_".length) === "tw4_"){
                        tw4_ = tw4_ + Number(get_input[k].value);
                    }
                }
            }
        }
        if(get_all_tr[i].getAttribute("class") === "jumlah_anakan_" + get_address){
            get_td_all = get_all_tr[i].getElementsByTagName("td");
            for(var j = 0; j < get_td_all.length; j++){
                if(get_td_all[j].getAttribute("info") === "total_rintotal"){
                    get_td_all[j].innerHTML = set_tiga_titik({"value":subtotal_.toString()});
                }
                if(get_td_all[j].getAttribute("info") === "total_rppt1nom"){
                    get_td_all[j].innerHTML = set_tiga_titik({"value":tw1_.toString()});
                }
                if(get_td_all[j].getAttribute("info") === "total_rppt2nom"){
                    get_td_all[j].innerHTML = set_tiga_titik({"value":tw2_.toString()});
                }
                if(get_td_all[j].getAttribute("info") === "total_rppt3nom"){
                    get_td_all[j].innerHTML = set_tiga_titik({"value":tw3_.toString()});
                }
                if(get_td_all[j].getAttribute("info") === "total_rppt4nom"){
                    get_td_all[j].innerHTML = set_tiga_titik({"value":tw4_.toString()});
                }
            }
        }
    }
}

function tambah_anak_grup(object_button, inisial, jumlah_anakan){
    // console.log("TAMBAH");
    if(typeof konfirmasi_hapus !== "undefined" && konfirmasi_hapus){
        var pesan_modal = document.getElementById("pesan_modal");
        pesan_modal.innerHTML = "Tombol disabled sedang dalam mode konfirmasi hapus.";
        $('#modal-success').modal('show');
        return false;
    }
    var get_td = object_button.parentNode;
    var get_tr = get_td.parentNode;
    var get_tbody = get_tr.parentNode;

    var get_i_tbody = get_tbody.getElementsByTagName("i");
    for(var i = 0; i < get_i_tbody.length; i++){
        if(get_i_tbody[i].getAttribute("urutan_grup") === "tombol_anakan_hapus" + inisial){
            get_i_tbody[i].setAttribute("onclick", "kurang_anak_grup(this,'"+inisial+"'," + (jumlah_anakan + 1) + ");");
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
                get_i[0].setAttribute("onclick", "kurangi_anak_grup(this,'"+inisial+"'," + (jumlah_anakan + 1) + ");");
            }
            if(count === jumlah_anakan){
                break;
            }
            count++;
        }
    }
    /* console.log(get_tr_active); */
    var clone_tr = get_tr_active.cloneNode(true);
    var get_td_clone = clone_tr.getElementsByTagName("td");
    for(var i = 0; i < get_td_clone.length; i++){
        if(get_td_clone[i].getAttribute("class") === "td_number" + inisial){
            get_td_clone[i].innerHTML = (jumlah_anakan + 1);
            break;
        }
    }
    var get_td_input_clone = clone_tr.getElementsByTagName("input");
    var temp_subtotal = {};
    for(var i = 0; i < get_td_input_clone.length; i++){
        if(get_td_input_clone[i].getAttribute("type") === "number" || get_td_input_clone[i].getAttribute("type") === "text"){
            if(get_td_input_clone[i].getAttribute("class") === "numberonly"){
                // console.log(get_td_input_clone[i]);
                get_td_input_clone[i].value = "0.00";
                if(get_td_input_clone[i].getAttribute("name").substr(0,1) === "F"){
                    get_td_input_clone[i].value = "0";
                }
                if(get_td_input_clone[i].getAttribute("name").substr(0,1) === "Q"){
                    get_td_input_clone[i].value = "0";
                }
                if(get_td_input_clone[i].getAttribute("name").substr(0,"subtotal_".length) === "subtotal_"){
                    temp_subtotal = get_td_input_clone[i];
                }
            }
            if(get_td_input_clone[i].getAttribute("class") === "textinput"){
                get_td_input_clone[i].value = "";
            }
        }
    }
    object_button.setAttribute("onclick", "tambah_anak_grup(this,'"+inisial+"'," + (jumlah_anakan + 1) + ");");
    get_tr_active.style.border = "";
    get_tbody.insertBefore(clone_tr, get_tr_active.nextSibling);
    re_trigger_numberonly_input();
    re_trigger_input_with_class('textinput');
}

function min_group(object_button, inisial, jumlah_group){
    if(typeof konfirmasi_hapus !== "undefined" && konfirmasi_hapus){
        var pesan_modal = document.getElementById("pesan_modal");
        pesan_modal.innerHTML = "Tombol disabled sedang dalam mode konfirmasi hapus.";
        $('#modal-success').modal('show');
        return false;
    }
    var get_td = object_button.parentNode;
    var get_tr = get_td.parentNode;
    var get_tbody = get_tr.parentNode;
    var get_all_tr = get_tbody.getElementsByTagName("tr");
    var all_tr = [];
    var address = 0;
    var jumlah_induk_group = 0;
    for(var i = 0; i < get_all_tr.length; i++){
        if(get_all_tr[i].getAttribute("class") === "induk_group" + inisial){
            all_tr[address] = get_all_tr[i];
            address++;
        }
        if(get_all_tr[i].getAttribute("class") === "anakan_group" + inisial){
            all_tr[address] = get_all_tr[i];
            address++;
        }
        if(get_all_tr[i].getAttribute("class") === "jumlah_anakan" + inisial){
            all_tr[address] = get_all_tr[i];
            address++;
        }
    }
    for(var i = 0; i < get_all_tr.length; i++){
        if(get_all_tr[i].getAttribute("class").substr(0,"induk_group_".length) === "induk_group_"){
            jumlah_induk_group++;
        }
    }
    if(jumlah_group > 0){
        if(jumlah_induk_group <= 1){
            var pesan_modal = document.getElementById("pesan_modal");
            pesan_modal.innerHTML = "Sorry only left 1 group and cannot do delete.";
            $('#modal-success').modal('show');
            return false;
        }
    }
    
    // console.log(all_tr);
    for(var i = 0; i < all_tr.length; i++){
        all_tr[i].parentNode.removeChild(all_tr[i]);
    }
    var arr_address = [];
    var add_address = 0;
    for(var i = 0; i < get_all_tr.length; i++){
        if(get_all_tr[i].getAttribute("class").substr(0,"induk_group_".length) === "induk_group_"){
            var get_tr_i = get_all_tr[i].getElementsByTagName("i");
            for(var j = 0; j < get_tr_i.length; j++){
                if(get_tr_i[j].getAttribute("class") === "fa fa-minus"){
                    var get_onclick = get_tr_i[j].getAttribute("onclick");
                    var split_comma = get_onclick.split(",");
                    var get_address = split_comma[1].trim();
                    arr_address[add_address] = get_address.replace(/'/g,"");
                    add_address++;
                }
            }
        }
    } 
    var concate = "";
    var comma = "";
    for(var i = 0; i < arr_address.length; i++){
        concate = concate + comma + arr_address[i];
        comma = ",";
    }
    var inisial_all = document.getElementById("inisial_all");
    inisial_all.value = concate;
}

function add_group(object_button, inisial, jumlah_group){
    if(typeof konfirmasi_hapus !== "undefined" && konfirmasi_hapus){
        var pesan_modal = document.getElementById("pesan_modal");
        pesan_modal.innerHTML = "Tombol disabled sedang dalam mode konfirmasi hapus.";
        $('#modal-success').modal('show');
        return false;
    }
    var get_td = object_button.parentNode;
    var get_tr = get_td.parentNode;
    var get_tbody = get_tr.parentNode;
    var get_all_tr = get_tbody.getElementsByTagName("tr");
    var tr_induk_group = false; 
    var tr_anakan_group = false;
    var tr_jumlah_anakan = false;
    var masuk_induk = 0;
    var masuk_anakan = 0;
    var masuk_jumlah = 0;
    for(var i = 0; i < get_all_tr.length; i++){
        if(!tr_induk_group && get_all_tr[i].getAttribute("class") === "induk_group" + inisial){
            tr_induk_group = get_all_tr[i];
            masuk_induk = 1;
        }
        if(!tr_anakan_group && get_all_tr[i].getAttribute("class") === "anakan_group" + inisial){
            tr_anakan_group = get_all_tr[i];
            masuk_anakan = 1;
        }
        if(!tr_jumlah_anakan && get_all_tr[i].getAttribute("class") === "jumlah_anakan" + inisial){
            tr_jumlah_anakan = get_all_tr[i];
            masuk_jumlah = 1;
        }
        if(masuk_induk && masuk_anakan && masuk_jumlah){
            break;
        }
    }
    var clone_tr_induk_group = tr_induk_group.cloneNode(true);
    var clone_tr_anakan_group = tr_anakan_group.cloneNode(true);
    var clone_tr_jumlah_anakan = tr_jumlah_anakan.cloneNode(true);
    
    clone_tr_induk_group.setAttribute("class", "induk_group_" + (jumlah_group + 1));
    var get_tr_induk_i = clone_tr_induk_group.getElementsByTagName("i");
    for(var i = 0; i < get_tr_induk_i.length; i++){
        if(get_tr_induk_i[i].getAttribute("class") === "fa fa-minus"){
            get_tr_induk_i[i].setAttribute("onclick", "min_group(this, '_"+(jumlah_group + 1)+"', "+(jumlah_group + 1)+");");
        }
        if(get_tr_induk_i[i].getAttribute("class") === "fa fa-plus"){
            get_tr_induk_i[i].setAttribute("onclick", "add_group(this, '_"+(jumlah_group + 1)+"', "+(jumlah_group + 1)+");");
        }
    }
    
    var get_tr_induk_input = clone_tr_induk_group.getElementsByTagName("input");
    for(var i = 0; i < get_tr_induk_input.length; i++){
        if(get_tr_induk_input[i].getAttribute("type") === "text"){
            get_tr_induk_input[i].value = "";
        }
    }
    
    clone_tr_anakan_group.setAttribute("class", "anakan_group_" + (jumlah_group + 1));
    clone_tr_anakan_group.setAttribute("style", "border-bottom: rgb(242,220,219) 2px solid;");
    var get_tr_anakan_input = clone_tr_anakan_group.getElementsByTagName("input");
    for(var i = 0; i < get_tr_anakan_input.length; i++){
        if(get_tr_anakan_input[i].getAttribute("type") === "number" || get_tr_anakan_input[i].getAttribute("type") === "text"){
            var get_name = get_tr_anakan_input[i].getAttribute("name");
            var active_jumlah_after = jumlah_group + 1;
            var get_name_substr = get_name.substr(0, get_name.length - inisial.length - 2);
            var name_new = get_name_substr + "_" + active_jumlah_after.toString() + "[]";
            get_tr_anakan_input[i].setAttribute("name", name_new);
            if(get_tr_anakan_input[i].getAttribute("type") === "number"){
                get_tr_anakan_input[i].value = "0.00";
            }
            if(get_tr_anakan_input[i].getAttribute("type") === "text"){
                get_tr_anakan_input[i].value = "";
            }
        }
    }
    
    var get_tr_anakan_i = clone_tr_anakan_group.getElementsByTagName("i");
    for(var i = 0; i < get_tr_anakan_i.length; i++){
        if(get_tr_anakan_i[i].getAttribute("class") === "fa fa-minus"){
            get_tr_anakan_i[i].setAttribute("onclick", "kurangi_anak_grup(this,'_"+(jumlah_group + 1)+"',1);");
        }
    }
    
    var get_tr_anakan_td = clone_tr_anakan_group.getElementsByTagName("td");
    for(var i = 0; i < get_tr_anakan_td.length; i++){
        if(get_tr_anakan_td[i].getAttribute("class") === "td_number" + inisial){
            get_tr_anakan_td[i].setAttribute("class", "td_number_" + (jumlah_group + 1));
        }
    }
    
    clone_tr_jumlah_anakan.setAttribute("class", "jumlah_anakan_" + (jumlah_group + 1));
    var get_tr_jumlah_i = clone_tr_jumlah_anakan.getElementsByTagName("i");
    for(var i = 0; i < get_tr_jumlah_i.length; i++){
        if(get_tr_jumlah_i[i].getAttribute("urutan_grup") === "tombol_anakan" + inisial){
            // console.log((jumlah_group + 1));
            get_tr_jumlah_i[i].setAttribute("urutan_grup", "tombol_anakan_" + (jumlah_group + 1));
            get_tr_jumlah_i[i].setAttribute("onclick", "tambah_anak_grup(this,'_"+(jumlah_group + 1)+"',1);");
        }
    }
    
    var get_tr_jumlah_td = clone_tr_jumlah_anakan.getElementsByTagName("td");
    for(var i = 0; i < get_tr_jumlah_td.length; i++){
        if(get_tr_jumlah_td[i].getAttribute("info") === "total_rintotal" || (get_tr_jumlah_td[i].getAttribute("info") !== null && get_tr_jumlah_td[i].getAttribute("info").substring(0,"total_rppt".length) === "total_rppt")){
            get_tr_jumlah_td[i].innerHTML = "";
        }
    }
    
    tr_jumlah_anakan.setAttribute("style", "border-bottom: rgb(220,230,241) 2px solid; box-shadow: inset 0 1px 0 rgb(242 220 219), inset 0 -1px 0 rgb(220 230 241);");
    
    get_tbody.appendChild(clone_tr_induk_group);
    get_tbody.appendChild(clone_tr_anakan_group);
    get_tbody.appendChild(clone_tr_jumlah_anakan);
    re_trigger_numberonly_input();
    re_trigger_input_with_class('textinput');
    
    var arr_address = [];
    var add_address = 0;
    for(var i = 0; i < get_all_tr.length; i++){
        if(get_all_tr[i].getAttribute("class").substr(0,"induk_group_".length) === "induk_group_"){
            var get_tr_i = get_all_tr[i].getElementsByTagName("i");
            for(var j = 0; j < get_tr_i.length; j++){
                if(get_tr_i[j].getAttribute("class") === "fa fa-minus"){
                    var get_onclick = get_tr_i[j].getAttribute("onclick");
                    var split_comma = get_onclick.split(",");
                    var get_address = split_comma[1].trim();
                    arr_address[add_address] = get_address.replace(/'/g,"");
                    add_address++;
                    get_tr_i[j].setAttribute("onclick", "min_group(this, "+get_address+", "+(jumlah_group + 1)+");");
                }
                if(get_tr_i[j].getAttribute("class") === "fa fa-plus"){
                    var get_onclick_ = get_tr_i[j].getAttribute("onclick");
                    var split_comma_ = get_onclick_.split(",");
                    var get_address_ = split_comma_[1].trim();
                    get_tr_i[j].setAttribute("onclick", "add_group(this, "+get_address_+", "+(jumlah_group + 1)+");");
                }
            }
        }
    }
    var concate = "";
    var comma = "";
    for(var i = 0; i < arr_address.length; i++){
        concate = concate + comma + arr_address[i];
        comma = ",";
    }
    var inisial_all = document.getElementById("inisial_all");
    inisial_all.value = concate;
}

function autocomplete(inp, arr) {
    if(document.getElementById(inp) && document.getElementById(inp).getAttribute("type") == "text"){
        var inp = document.getElementById(inp);
        var currentFocus;
        inp.addEventListener("input", function(e) {
            e;
            var a, b, i, val = this.value;
            closeAllLists();
            if (!val) { return false;}
            currentFocus = -1;
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            this.parentNode.appendChild(a);
            for (i = 0; i < arr.length; i++) {
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    b = document.createElement("DIV");
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    b.addEventListener("click", function(e) {
                        inp.value = this.getElementsByTagName("input")[0].value;
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });

        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                currentFocus++;
                addActive(x);
            } else if (e.keyCode == 38) { 
                currentFocus--;
                addActive(x);
            } else if (e.keyCode == 13) {
                e.preventDefault();
                 if (currentFocus > -1) {
                    if (x) x[currentFocus].click();
                }
            }
        });
        function addActive(x) {
            if (!x) return false;
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            x[currentFocus].classList.add("autocomplete-active");
        }
        function removeActive(x) {
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }
        function closeAllLists(elmnt) {
          var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
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

function removeLoading_regular(){
    if(document.getElementById("div_loading")){
        var div_loading = document.getElementById("div_loading");
        div_loading.parentNode.removeChild(div_loading);
    }
}

function detect_ma(value){
    if(value.length === 8){
        var jumlah_angka = 0;
        for(var i = 0; i < value.length; i++){
            if(!isNaN(parseFloat(value[i])) && isFinite(value[i])){
                jumlah_angka++;
            }
        }
        if(jumlah_angka === value.length){
            return true;
        }
    }
    return false;
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
                hasil_concate_display = hasil_concate_display + pemisah_display + (detect_ma(get_attr_data[Number(get_address[i])]) ? (get_attr_data[Number(get_address[i])].substr(0,3) + "." + get_attr_data[Number(get_address[i])].substr(3,3) + "." + get_attr_data[Number(get_address[i])].substring(6)) : get_attr_data[Number(get_address[i])]);
                pemisah_display = " # ";
            }
            
            removeLoading();
            setTimeout(function(){
                var get_id = input_active.getAttribute("id");
                var hidden_id = get_id + "_hidden";
                var hidden_active = document.getElementById(hidden_id);
                hidden_active.value = hasil_concate;
                /* console.log(hasil_concate); */
                input_active.value = hasil_concate_display;
                $('#'+id_dialog).modal('hide');
            },2000);
            
        };
    }
}

var data_json = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
window.addEventListener("load", function () {
    autocomplete("satuan_kerja", data_json);
    autocomplete("kegiatan_program_kerja", data_json);
    autocomplete("mata_anggaran", data_json);
    $( "#buka_dialog_rincian_kegiatan" ).click(function(){
        var satuan_kerja = document.getElementById("satuan_kerja");
        var satker_active = satuan_kerja.value
            .split("(").join("KURUNGBUKA")
            .split(")").join("KURUNGTUTUP")
            .split(" ").join("SEPASI");
        if(satker_active !== ""){
            set_loading();
            $.get("../../../index.php/add-anggaran/get-sp-search-pkt-based-satker/" + satker_active, function(data, status){
                if(status === "success"){
                    if(check_session(data)){
                        var kegiatan_program_kerja_rincian = document.getElementById("kegiatan_program_kerja_rincian");
                        var tbody_hasil_data = document.getElementById("tbody_hasil_data");
                        tbody_hasil_data.innerHTML = data;
                        $('#modal-rincian-kegiatan').modal('show');
                        set_tr_click_inside_tbody(tbody_hasil_data,kegiatan_program_kerja_rincian,'modal-rincian-kegiatan','3,4');
                        removeLoading_regular();
                    }
                }
            });
        } else {
            var pesan_modal = document.getElementById("pesan_modal");
            pesan_modal.innerHTML = "Choose Satker.";
            $('#modal-success').modal('show');
        }
    });
    $( "#buka_dialog_mata_anggaran" ).click(function(){
        set_loading();
        $.get("../../../index.php/add-anggaran/get-sp-search-mataanggaran", function(data, status){
            if(status === "success"){
                if(check_session(data)){
                    var mata_anggaran = document.getElementById("mata_anggaran");
                    var tbody_hasil_data_mata_anggaran = document.getElementById("tbody_hasil_data_mata_anggaran");
                    tbody_hasil_data_mata_anggaran.innerHTML = data;
                    $('#modal-mata-anggaran').modal('show');
                    set_tr_click_inside_tbody(tbody_hasil_data_mata_anggaran,mata_anggaran,'modal-mata-anggaran','2,3');
                    removeLoading_regular();
                }
            }
        });
    });
    $("#search_text_dialog_rincian_kegiatan").bind("keypress keyup keydown", function () {
        search_from_tbody(document.getElementById('tbody_hasil_data'), this, '3', document.getElementById('kegiatan_program_kerja_rincian'), 'modal-rincian-kegiatan', '3,4');
    });
    $("#search_text_dialog_mata_kegiatan").bind("keypress keyup keydown", function () {
        search_from_tbody(document.getElementById('tbody_hasil_data_mata_anggaran'), this, '2', document.getElementById('mata_anggaran'), 'modal-mata-anggaran', '2,3');
    });
});