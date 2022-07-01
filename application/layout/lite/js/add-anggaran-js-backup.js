function detect_address_left(object_input){
    var get_td = object_input.parentNode;
    var get_tr = get_td.parentNode;
    var get_name = object_input.getAttribute("name");
    
    var get_input_ = get_tr.getElementsByTagName("input");
    var get_focus = 0;
    for(var i = 0; i < get_input_.length; i++){
        if(get_input_[i].getAttribute("type") === "number"){
            if(get_input_[i].getAttribute("name") === get_name){
                break;
            }
            get_input_[i].focus();
            get_focus = 1;
        }
    }
    if(!get_focus){
        for(var i = 0; i < get_input_.length; i++){
            if(get_input_[i].getAttribute("type") === "number"){
                get_input_[i].focus();
            }
        }
    }
}

function detect_address_right(object_input){
    var get_td = object_input.parentNode;
    var get_tr = get_td.parentNode;
    var get_name = object_input.getAttribute("name");
    
    var get_input_ = get_tr.getElementsByTagName("input");
    var after = 0;
    var get_focus = 0;
    for(var i = 0; i < get_input_.length; i++){
        if(get_input_[i].getAttribute("type") === "number"){
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
            if(get_input_[i].getAttribute("type") === "number"){
                get_input_[i].focus();
                break;
            }
        }
    }
}

function detect_address_down(object_input){
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
        if(get_input_[i].getAttribute("type") === "number"){
            if(get_input_[i].getAttribute("name") === get_name){
                get_input_[i].focus();
                break;
            }
        }
    }
    get_tr.removeAttribute("active_down");
}

function detect_address_up(object_input){
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
        if(get_input_[i].getAttribute("type") === "number"){
            if(get_input_[i].getAttribute("name") === get_name){
                get_input_[i].focus();
                break;
            }
        }
    }
    get_tr.removeAttribute("active_up");
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
    for(var i = 0; i < get_input_.length; i++){
        if(get_input_[i].getAttribute("type") === "number"){
            if(get_input_[i].getAttribute("name") === get_name){
                get_input_[i].focus();
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