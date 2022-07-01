function detect_address_left(object_input){
    setTimeout(function(){
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
            if(get_input_[i].getAttribute("type") === "number"){
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
            if(get_input_[i].getAttribute("type") === "number"){
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
                get_i[0].setAttribute("onclick", "kurangi_anak_grup(this,'"+inisial+"'," + (jumlah_anakan - 1) + ");");
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

function tambah_anak_grup(object_button, inisial, jumlah_anakan){
    // console.log("TAMBAH");
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
    console.log(get_tr_active);
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
    object_button.setAttribute("onclick", "tambah_anak_grup(this,'"+inisial+"'," + (jumlah_anakan + 1) + ");");
    get_tr_active.style.border = "";
    get_tbody.insertBefore(clone_tr, get_tr_active.nextSibling);
    re_trigger_numberonly_input();
}

function min_group(object_button, inisial, jumlah_group){
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
    
    clone_tr_anakan_group.setAttribute("class", "anakan_group_" + (jumlah_group + 1));
    clone_tr_anakan_group.setAttribute("style", "border-bottom: rgb(242,220,219) 2px solid;");
    var get_tr_anakan_input = clone_tr_anakan_group.getElementsByTagName("input");
    for(var i = 0; i < get_tr_anakan_input.length; i++){
        if(get_tr_anakan_input[i].getAttribute("type") === "number"){
            var get_name = get_tr_anakan_input[i].getAttribute("name");
            var active_jumlah_after = jumlah_group + 1;
            var get_name_substr = get_name.substr(0, get_name.length - inisial.length - 2);
            var name_new = get_name_substr + "_" + active_jumlah_after.toString() + "[]";
            get_tr_anakan_input[i].setAttribute("name", name_new);
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
    
    tr_jumlah_anakan.setAttribute("style", "border-bottom: rgb(220,230,241) 2px solid; box-shadow: inset 0 1px 0 rgb(242 220 219), inset 0 -1px 0 rgb(220 230 241);");
    
    get_tbody.appendChild(clone_tr_induk_group);
    get_tbody.appendChild(clone_tr_anakan_group);
    get_tbody.appendChild(clone_tr_jumlah_anakan);
    re_trigger_numberonly_input();
    
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