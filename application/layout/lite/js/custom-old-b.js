var tinymce = typeof tinymce !== "undefined" ? tinymce : {};
var disabled_textarea = typeof disabled_textarea !== "undefined" ? disabled_textarea : {};
tinymce.init({
    selector: "textarea.texteditor",
    
    // ===========================================
    // INCLUDE THE PLUGIN
    // ===========================================

    plugins: [
        "advlist autolink lists link charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste jbimages"
    ],

    // ===========================================
    // PUT PLUGIN'S BUTTON on the toolbar
    // ===========================================

    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",

    // ===========================================
    // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
    // ===========================================

    relative_urls: false,
    setup: function (ed) {
        ed.on('init', function(args) {
            if(typeof disabled_textarea !== "undefined" && typeof disabled_textarea[args.target.id] !== "undefined" && disabled_textarea[args.target.id]){
                ed.setMode("readonly");
            }
        });
    }
});

var mulai_label = typeof mulai_label === "undefined" ? 1 : mulai_label;
var mulai_tag = typeof mulai_tag === "undefined" ? 1 : mulai_tag;
function remove_input(container_label_, name, variable_name, increment){
    if(document.getElementById(container_label_)){
        window[variable_name]--;
        var container_label = document.getElementById(container_label_);
        var div_label_ = document.getElementById("div_" + name + "_" + increment);
        div_label_.parentNode.removeChild(div_label_);
        var get_input = container_label.getElementsByTagName("input");
        var get_div = container_label.getElementsByTagName("div");
        var get_button = container_label.getElementsByTagName("button");
        for(var i = 1; i < get_input.length; i++){
            get_input[i].setAttribute("id", name + "_" + (i + 1));
            get_input[i].setAttribute("name", name + "_" + (i + 1));
            get_input[i].setAttribute("placeholder", name + " ke " + (i + 1));
        }
        for(var i = 1; i < get_div.length; i++){
            get_div[i].setAttribute("id", "div_" + name + "_" + (i + 1));
        }
        for(var i = 0; i < get_button.length; i++){
            get_button[i].setAttribute("onclick", `remove_input('` + container_label_ + `', '` + name + `', '` + variable_name + `', ` + (i + 2) + `);`);
        }
    }
}

var temporary_tr = [];
var adress_temporary_tr = 0;
var input_search_temporary = {"value" : ""};

function case_search(param_a, param_b){
    var address = 0;
    while(param_a[address]){
        if(param_a.substr(address, param_b.length) === param_b){
            return true;
        }
        address++;
    }
    return false;
}

function put_bold(tr_object, param_a, param_b){
    var get_td = tr_object.getElementsByTagName("td");
    for(var i = 0; i < get_td.length; i++){
        
    }
}

function search_from_tbody(tbody_object, input_object, colspan_number, input_active, id_dialog, address_display){
    var get_tr = tbody_object.getElementsByTagName("tr");
    var tampung_tr = [];
    var address_tr = 0;
    var value_search = input_object.value;
    input_search_temporary = input_object;
    if(temporary_tr.length  === 0){
        for(var i = 0; i < get_tr.length; i++){
            temporary_tr[adress_temporary_tr] = get_tr[i].cloneNode(true);
            adress_temporary_tr++;
        }
    }
    
    for(var i = 0; i < temporary_tr.length; i++){
        var get_td = temporary_tr[i].getElementsByTagName("td");
        for(var j = 0; j < get_td.length; j++){/*
            if(get_td[j].innerHTML.substr(0, value_search.length).toLowerCase() === value_search.toLowerCase()){*/
            if(case_search(get_td[j].innerText.toLowerCase(), value_search.toLowerCase())){
                tampung_tr[address_tr] = temporary_tr[i].cloneNode(true);
                address_tr++;
                break;
            }
        }
    }
    var data_ketemu = false;
    tbody_object.innerHTML = "";
    for(var i = 0; i < tampung_tr.length; i++){
        data_ketemu = true;
        tbody_object.appendChild(tampung_tr[i]);
    }
    if(!data_ketemu){
        tbody_object.innerHTML = `
            <tr>
                <td colspan="`+colspan_number+`">No Found.</td>
            </tr>
        `;
    }
    
    if(value_search === ""){
        tbody_object.innerHTML = "";
        for(var i = 0; i < temporary_tr.length; i++){
            tbody_object.appendChild(temporary_tr[i]);
        }
    }
    if(data_ketemu){
        set_tr_click_inside_tbody(tbody_object,input_active,id_dialog,address_display);
    }
}

function check_session(HTMLTAG){
    var split_login = HTMLTAG.split("<div class=\"login-box\">");
    if(split_login.length > 1){
        document.location = "../../../index.php/login";
        return false;
    }
    return true;
}

function tambah_input(container_label_, name, variable_name){
    if(document.getElementById(container_label_)){
        window[variable_name]++;
        var container_label = document.getElementById(container_label_);
        var div__ = document.createElement("div");
        div__.setAttribute("id","div_" + name + "_" + window[variable_name]);
        div__.style.marginTop = "8px";
        div__.innerHTML = `
            <table style="width: 100%;">
                <tr>
                    <td style="width: 95%;">
                        <input type="text" id="` + name + `_` + mulai_label + `" class="form-control" name="` + name + `_` + window[variable_name] + `" placeholder="` + name + ` ke ` + window[variable_name] + `">
                    </td>
                    <td style="width: 5%;">
                        <button style="width: 100%; border-radius: 0px;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" onclick="remove_input('` + container_label_ + `', '` + name + `', '` + variable_name + `', ` + window[variable_name] + `);"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </table>
        `;
        container_label.appendChild(div__);
    }
}

function resize_wrapper(){
    if(document.getElementById("div_box_info")){
        document.body.style.overflow = "hidden";
        if(typeof left_side_no_collapse === "undefined"){
            document.body.classList.add("sidebar-collapse");
        }
        setTimeout(function(){
            /* console.log(window.getComputedStyle(document.querySelector("#wrapper_div")).minHeight); */
            document.getElementById("div_box_info").style.height = window.getComputedStyle(document.querySelector("#wrapper_div")).minHeight;
        }, 100);
    }
}

var google = typeof google !== "undefined" ? google : {};
var FileReader = typeof FileReader !== "undefined" ? FileReader : {};
function readURL(input) {
    if (typeof input === "object" && typeof input.files !== "undefined" && input.files && input.files[0] && typeof FileReader !== "undefined") {
        var reader = new FileReader();
        if(typeof reader.onload !== "undefined"){
            reader.onload = function(e) {
                var tampil_gambar = document.getElementById('tampil_gambar');
                var gambar_photo = tampil_gambar.getElementsByTagName("img")[0];
                if(e.target.result.substr(0,10) === "data:image"){
                    gambar_photo.src = e.target.result;
                    gambar_photo.style.display = "";
                    gambar_photo.style.width = "250px";
                    tampil_gambar.style.display = "";
                } else {
                    gambar_photo.src = "";
                    gambar_photo.style.display = "none";
                    gambar_photo.style.marginTop = "";
                    gambar_photo.style.width = "";
                    tampil_gambar.style.display = "none";
                }
                base_image_64 = "";
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            alert("Something Wrong With File Reader.");
        }
    } else {
        alert("Something Wrong With File Reader.");
    }
}

function re_trigger_numberonly_input(){
    /* https://stackoverflow.com/questions/38797697/remove-keydown-event-from-jquery-element-not-working */
    /* remove keydown event jquery */
    /* https://stackoverflow.com/questions/21401175/keycode-for-tab-is-not-working */
    /* https://www.youtube.com/shorts/ve0of_k4ln0 */
    /* https://www.youtube.com/shorts/EY8YcdjfEtc */
    /* https://www.youtube.com/shorts/FOwOzfN6G5o */
    /* javascript tab keycode not working */
    $(".numberonly").off('keydown');
    $('.numberonly').keydown(function (e) {
        var charCode = (e.which) ? e.which : event.keyCode; 
        /* console.log(charCode); */
        if(((e.shiftKey && charCode === 37) || (e.shiftKey && charCode === 39)) && typeof detect_address_right === "function"){
            e.preventDefault();
            if(charCode === 39){
                detect_address_right(this);
            }
            if(charCode === 37){
                detect_address_left(this);
            }
        }
        if((charCode === 38 || charCode === 40) && typeof detect_address_up === "function"){
            e.preventDefault();
            if(charCode === 38){
                detect_address_up(this);
            }
            if(charCode === 40){
                detect_address_down(this);
            }
        }
        if(charCode === 9 && typeof detect_address_input === "function"){
            detect_address_input(this);
        }
        if(charCode === 27 && typeof detect_address_input_delete === "function"){
            detect_address_input_delete(this);
        }
    });
    $(".numberonly").off('keypress');
    $('.numberonly').keypress(function (e) {    
        var charCode = (e.which) ? e.which : event.keyCode;  
        if(String.fromCharCode(charCode) === "."){
            if(this.value !== ""){
                return true;     
            }
        }
        if(String.fromCharCode(charCode).match(/[^0-9]/g))   { 
            return false;                        
        }
    });   
    
    $(".numberonly").off('keyup');
    $('.numberonly').keyup(function(){});
    
    $(".numberonly").off('focus');
    $('.numberonly').focus(function () {
        unset_comma_view_all(this.parentNode.parentNode.parentNode.parentNode.getAttribute("id"));
        unset_tiga_titik_all_per_input(this);
        this.value = this.value.split(".").length > 1 && this.value.split(".")[1] !== "00" ? this.value : (this.value.split(".").length > 1 && this.value.split(".")[1] === "00" ? (this.value.substr(0,this.value.length - 3) === "0" ? "" : this.value.substr(0,this.value.length - 3)) : this.value);
        this.setAttribute("type", "text");
        this.setSelectionRange(0, this.value.length);
        this.setAttribute("type", "number");
    });
    $(".numberonly").off('blur');
    $('.numberonly').blur(function () {  
        // console.log("MASUK BLUR");
        unset_comma_view_all_all(this.parentNode.parentNode.parentNode.parentNode.getAttribute("id"));
        unset_tiga_titik_all();
        check_percent_nom_baris(this);
        jumlahkan_nom_per_baris(this);
        jumlahkan_nom(this);
        check_nom_per_baris(this);
        set_tiga_titik_all();
        var get_nama = this.getAttribute("name");
        if(get_nama.substr(0,1) === "Q" || get_nama.substr(0,1) === "F"){
            this.value = this.value.split(".").length > 1 && this.value.split(".")[1] !== "" ? this.value : (this.value !== "" ? this.value + "" : ((this.value === "" ? "0" : this.value) + ""));
        } else {
            this.value = this.value.split(".").length > 1 && this.value.split(".")[1] !== "" ? this.value : (this.value !== "" ? this.value + ".00" : ((this.value === "" ? "0" : this.value) + ".00"));
        }
        set_comma_view_all_all("");
    });
}

function re_trigger_input_with_class(classname){
    /* https://stackoverflow.com/questions/38797697/remove-keydown-event-from-jquery-element-not-working */
    /* remove keydown event jquery */
    /* https://stackoverflow.com/questions/21401175/keycode-for-tab-is-not-working */
    /* https://www.youtube.com/shorts/ve0of_k4ln0 */
    /* https://www.youtube.com/shorts/EY8YcdjfEtc */
    /* https://www.youtube.com/shorts/FOwOzfN6G5o */
    /* javascript tab keycode not working */
    $("." + classname).off('keydown');
    $('.' + classname).keydown(function (e) {
        var charCode = (e.which) ? e.which : event.keyCode; 
        /* console.log(charCode); */
        if(((e.shiftKey && charCode === 37) || (e.shiftKey && charCode === 39)) && typeof detect_address_right === "function"){
            e.preventDefault();
            if(charCode === 39){
                detect_address_right(this);
            }
            if(charCode === 37){
                detect_address_left(this);
            }
        }
        if((charCode === 38 || charCode === 40) && typeof detect_address_up === "function"){
            e.preventDefault();
            if(charCode === 38){
                detect_address_up(this);
            }
            if(charCode === 40){
                detect_address_down(this);
            }
        }
        if(charCode === 9 && typeof detect_address_input === "function"){
            detect_address_input(this);
        }
        if(charCode === 27 && typeof detect_address_input_delete === "function"){
            detect_address_input_delete(this);
        }
    });
}

function set_tiga_titik(object_input){
    var nilai = object_input.value;
    var hasil = typeof nilai !== "undefined" ? nilai : "";
    if(typeof nilai !== "undefined"){
        hasil = "";
        var jumlah_string = nilai.length;
        while(true){
            if(jumlah_string > 3){
                jumlah_string = jumlah_string - 3;
                hasil = "," + nilai.substr(jumlah_string, 3) + hasil;
            } else {
                hasil = nilai.substr(0, jumlah_string) + hasil;
                break;
            }
        }
    }
    return hasil;
}


function unset_tiga_titik_all_per_input(object_input){
    if(object_input.getAttribute("class") === "numberonly"){
        var nilai = object_input.value;
        object_input.setAttribute("type", "number");
        object_input.value = nilai.split(",").join("");
    }
}

function set_tiga_titik_all_per_input(object_input){
    if(object_input.getAttribute("class") === "numberonly"){
        var nilai = object_input.value;
        var split_nilai = nilai.split(".", nilai);
        var result_titik = set_tiga_titik({"value":split_nilai[0]});
        object_input.setAttribute("type", "text");
        object_input.value = result_titik + (split_nilai.length > 1 ? "." + split_nilai[1] : "");
    }
}

function unset_tiga_titik_all(){
    if(document.getElementById("table-anggaran-tahunan")){
        // unset_comma_view_all("table-anggaran-tahunan");
        var table_anggaran_tahunan = document.getElementById("table-anggaran-tahunan");
        var get_tbody = table_anggaran_tahunan.getElementsByTagName("tbody");
        var get_tr = get_tbody[0].getElementsByTagName("tr");
        for(var i = 0; i < get_tr.length; i++){
            if(get_tr[i].getAttribute("class").substr(0,"anakan_group_".length) === "anakan_group_"){
                var get_input_anakan = get_tr[i].getElementsByTagName("input");
                for(var j = 1; j < get_input_anakan.length; j++){
                    if(get_input_anakan[j].getAttribute("class") === "numberonly"){
                        var nilai = get_input_anakan[j].value;
                        get_input_anakan[j].setAttribute("type", "number");
                        get_input_anakan[j].value = nilai.split(",").join("");
                    }
                }
            }
        }
        unset_tiga_titik_all_extend();
    }
}

function set_comma_view_all(id_table){
    var table_anggaran_tahunan = document.getElementById(id_table);
    var get_tbody = table_anggaran_tahunan.getElementsByTagName("tbody");
    var get_tr = get_tbody[0].getElementsByTagName("tr");
    for(var i = 0; i < get_tr.length; i++){
        if(get_tr[i].getAttribute("class").substr(0,"anakan_group_".length) === "anakan_group_"){
            var get_input_anakan = get_tr[i].getElementsByTagName("input");
            for(var j = 1; j < get_input_anakan.length; j++){
                if(get_input_anakan[j].getAttribute("class") === "numberonly"){
                    if(get_input_anakan[j].value !== ""){
                        get_input_anakan[j].value = get_input_anakan[j].value.split(',').join('a').split('.').join(',').split('a').join('.');
                    }
                }
            }
        }
    }
}

function unset_comma_view_all(id_table){
    var table_anggaran_tahunan = document.getElementById(id_table);
    var get_tbody = table_anggaran_tahunan.getElementsByTagName("tbody");
    var get_tr = get_tbody[0].getElementsByTagName("tr");
    for(var i = 0; i < get_tr.length; i++){
        if(get_tr[i].getAttribute("class").substr(0,"anakan_group_".length) === "anakan_group_"){
            var get_input_anakan = get_tr[i].getElementsByTagName("input");
            for(var j = 1; j < get_input_anakan.length; j++){
                if(get_input_anakan[j].getAttribute("class") === "numberonly"){
                    if(get_input_anakan[j].value !== ""){
                        get_input_anakan[j].value = get_input_anakan[j].value.split('.').join('a').split(',').join('.').split('a').join(',');
                    }
                }
            }
        }
    }
}


function unset_comma_view_all_all(id_table){
    if(id_table !== "table-anggaran-tahunan"){
        var table_anggaran_tahunan = document.getElementById("table-anggaran-tahunan");
        var get_tbody = table_anggaran_tahunan.getElementsByTagName("tbody");
        var get_tr = get_tbody[0].getElementsByTagName("tr");
        for(var i = 0; i < get_tr.length; i++){
            if(get_tr[i].getAttribute("class").substr(0,"anakan_group_".length) === "anakan_group_"){
                var get_input_anakan = get_tr[i].getElementsByTagName("input");
                for(var j = 1; j < get_input_anakan.length; j++){
                    if(get_input_anakan[j].getAttribute("class") === "numberonly"){
                        get_input_anakan[j].value = get_input_anakan[j].value.split('.').join('a').split(',').join('.').split('a').join(',');
                    }
                }
            }
        }
    }
    unset_comma_view_all_all_extend(id_table);
}

function unset_comma_view_all_all_extend(id_table){
    for(var k = 2; k <= 100; k++){
        var alphabet = convert_number_alphabet(k);
        // console.log(alphabet);
        if(id_table !== "table-anggaran-tahunan"+alphabet){
            if(document.getElementById("table-anggaran-tahunan"+alphabet)){
                // console.log(alphabet);
                var table_anggaran_tahunan = document.getElementById("table-anggaran-tahunan"+alphabet);
                var get_tbody = table_anggaran_tahunan.getElementsByTagName("tbody");
                var get_tr = get_tbody[0].getElementsByTagName("tr");
                for(var i = 0; i < get_tr.length; i++){
                    if(get_tr[i].getAttribute("class").substr(0,"anakan_group_".length) === "anakan_group_"){
                        var get_input_anakan = get_tr[i].getElementsByTagName("input");
                        for(var j = 1; j < get_input_anakan.length; j++){
                            if(get_input_anakan[j].getAttribute("class") === "numberonly"){
                                get_input_anakan[j].value = get_input_anakan[j].value.split('.').join('a').split(',').join('.').split('a').join(',');
                            }
                        }
                    }
                }
            }
        }
    }
}

function set_comma_view_all_all(id_table){
    if(id_table !== "table-anggaran-tahunan"){
        var table_anggaran_tahunan = document.getElementById("table-anggaran-tahunan");
        var get_tbody = table_anggaran_tahunan.getElementsByTagName("tbody");
        var get_tr = get_tbody[0].getElementsByTagName("tr");
        for(var i = 0; i < get_tr.length; i++){
            if(get_tr[i].getAttribute("class").substr(0,"anakan_group_".length) === "anakan_group_"){
                var get_input_anakan = get_tr[i].getElementsByTagName("input");
                for(var j = 1; j < get_input_anakan.length; j++){
                    if(get_input_anakan[j].getAttribute("class") === "numberonly"){
                        if(get_input_anakan[j].value !== ""){
                            get_input_anakan[j].value = get_input_anakan[j].value.split(',').join('a').split('.').join(',').split('a').join('.');
                        }
                    }
                }
            }
        }
    }
    set_comma_view_all_all_extend(id_table);
}

function set_comma_view_all_all_extend(id_table){
    for(var k = 2; k <= 100; k++){
        var alphabet = convert_number_alphabet(k);
        // console.log(alphabet);
        if(id_table !== "table-anggaran-tahunan"+alphabet){
            if(document.getElementById("table-anggaran-tahunan"+alphabet)){
                // console.log(alphabet);
                var table_anggaran_tahunan = document.getElementById("table-anggaran-tahunan"+alphabet);
                var get_tbody = table_anggaran_tahunan.getElementsByTagName("tbody");
                var get_tr = get_tbody[0].getElementsByTagName("tr");
                for(var i = 0; i < get_tr.length; i++){
                    if(get_tr[i].getAttribute("class").substr(0,"anakan_group_".length) === "anakan_group_"){
                        var get_input_anakan = get_tr[i].getElementsByTagName("input");
                        for(var j = 1; j < get_input_anakan.length; j++){
                            if(get_input_anakan[j].getAttribute("class") === "numberonly"){
                                if(get_input_anakan[j].value !== ""){
                                    get_input_anakan[j].value = get_input_anakan[j].value.split(',').join('a').split('.').join(',').split('a').join('.');
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function set_tiga_titik_all(){
    var table_anggaran_tahunan = document.getElementById("table-anggaran-tahunan");
    var get_tbody = table_anggaran_tahunan.getElementsByTagName("tbody");
    var get_tr = get_tbody[0].getElementsByTagName("tr");
    for(var i = 0; i < get_tr.length; i++){
        if(get_tr[i].getAttribute("class").substr(0,"anakan_group_".length) === "anakan_group_"){
            var get_input_anakan = get_tr[i].getElementsByTagName("input");
            for(var j = 1; j < get_input_anakan.length; j++){
                if(get_input_anakan[j].getAttribute("class") === "numberonly"){
                    var nilai = get_input_anakan[j].value;
                    var split_nilai = nilai.split(".");
                    var result_titik = set_tiga_titik({"value":split_nilai[0]});
                    get_input_anakan[j].setAttribute("type", "text");
                    get_input_anakan[j].value = result_titik + (split_nilai.length > 1 ? "." + split_nilai[1] : "");
                }
            }
        }
    }
    set_tiga_titik_all_extend();
}

function set_tiga_titik_all_extend(){
    for(var k = 2; k <= 100; k++){
        var alphabet = convert_number_alphabet(k);
        // console.log(alphabet);
        if(document.getElementById("table-anggaran-tahunan"+alphabet)){
            // console.log(alphabet);
            var table_anggaran_tahunan = document.getElementById("table-anggaran-tahunan"+alphabet);
            var get_tbody = table_anggaran_tahunan.getElementsByTagName("tbody");
            var get_tr = get_tbody[0].getElementsByTagName("tr");
            for(var i = 0; i < get_tr.length; i++){
                if(get_tr[i].getAttribute("class").substr(0,"anakan_group_".length) === "anakan_group_"){
                    var get_input_anakan = get_tr[i].getElementsByTagName("input");
                    for(var j = 1; j < get_input_anakan.length; j++){
                        if(get_input_anakan[j].getAttribute("class") === "numberonly"){
                            if(get_input_anakan[j].getAttribute("name").substr(0,"tarif_".length) === "tarif_"){
                                // console.log(get_input_anakan[j].getAttribute("name") + " = " + get_input_anakan[j].value);
                            }
                            var nilai = get_input_anakan[j].value;
                            var split_nilai = nilai.split(".");
                            var result_titik = set_tiga_titik({"value":split_nilai[0]});
                            get_input_anakan[j].setAttribute("type", "text");
                            get_input_anakan[j].value = result_titik + (split_nilai.length > 1 ? "." + split_nilai[1] : "");
                        }
                    }
                }
            }
        }
    }
}

function unset_tiga_titik_all_extend(){
    for(var k = 2; k <= 100; k++){
        var alphabet = convert_number_alphabet(k);
        if(document.getElementById("table-anggaran-tahunan"+alphabet)){
            // unset_comma_view_all("table-anggaran-tahunan"+alphabet);
            var table_anggaran_tahunan = document.getElementById("table-anggaran-tahunan"+alphabet);
            var get_tbody = table_anggaran_tahunan.getElementsByTagName("tbody");
            var get_tr = get_tbody[0].getElementsByTagName("tr");
            for(var i = 0; i < get_tr.length; i++){
                if(get_tr[i].getAttribute("class").substr(0,"anakan_group_".length) === "anakan_group_"){
                    var get_input_anakan = get_tr[i].getElementsByTagName("input");
                    for(var j = 1; j < get_input_anakan.length; j++){
                        if(get_input_anakan[j].getAttribute("class") === "numberonly"){
                            
                            var nilai = get_input_anakan[j].value;
                            get_input_anakan[j].setAttribute("type", "number");
                            get_input_anakan[j].value = nilai.split(",").join("");
                        }
                    }
                }
            }
        }
    }
}

$(function () {
    $(".select2").select2();
    if(document.getElementById("campaign")){
        $("#campaign").select2("enable",false);
    }
    if(document.getElementById("paket0")){
        $("#paket0").select2("enable",false);
    }
    if(document.getElementById("produk")){
        $("#produk").select2("enable",false);
    }
    
    $( ".tanggal_pilih" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $('.jam').timepicker({
        timeFormat: 'HH:mm:ss'
    });
    
    if(document.getElementById("satuan_kerja")){
        var satuan_kerja = document.getElementById("satuan_kerja");
        satuan_kerja.onchange = function(){
            var kegiatan_program_kerja_rincian = document.getElementById("kegiatan_program_kerja_rincian");
            kegiatan_program_kerja_rincian.value = "";
            var kegiatan_program_kerja_rincian_hidden = document.getElementById("kegiatan_program_kerja_rincian_hidden");
            kegiatan_program_kerja_rincian_hidden.value = "";
            
            /* 
            var mata_anggaran = document.getElementById("mata_anggaran");
            mata_anggaran.value = "";
            var mata_anggaran_hidden = document.getElementById("mata_anggaran_hidden");
            mata_anggaran_hidden.value = ""; */
        };
    }
    
    if(document.getElementById("form-anggaran-tahunan")){
        var form_anggaran_tahunan = document.getElementById("form-anggaran-tahunan");
        /* console.log(form_anggaran_tahunan); */
        form_anggaran_tahunan.onsubmit = function(e){
            e.preventDefault();
            var update_insert = false;
            var tombol_submit = {};
            if(document.getElementById("update_anggaran")){
                tombol_submit = document.getElementById("update_anggaran");
                update_insert = true;
            }
            if(document.getElementById("add_anggaran")){
                tombol_submit = document.getElementById("add_anggaran");
                update_insert = true;
            }
            if(document.getElementById("hapus_anggaran")){
                tombol_submit = document.getElementById("hapus_anggaran");
                var pesan_modal = document.getElementById("isi-pesan-modal-default");
                pesan_modal.innerHTML = "Apakah anda benar benar yakin ?";
                $('#modal-default').modal('show');
                var button_confirm = document.getElementById("button-confirm");
                button_confirm.setAttribute("onclick", "document.getElementById(\"form-anggaran-tahunan\").submit()");
                tombol_submit.setAttribute("disabled", "");
                $("#modal-default").on("hidden.bs.modal", function () {
                    tombol_submit.removeAttribute("disabled");
                });
            }
            
            if(update_insert){
                tombol_submit.setAttribute("disabled", "");
                var kegiatan_program_kerja_rincian = document.getElementById("kegiatan_program_kerja_rincian");
                var kegiatan_program_kerja_rincian_hidden = document.getElementById("kegiatan_program_kerja_rincian_hidden");

                var mata_anggaran = document.getElementById("mata_anggaran");
                var mata_anggaran_hidden = document.getElementById("mata_anggaran_hidden");
                
                var table_anggaran_tahunan = document.getElementById("table-anggaran-tahunan");
                var get_tbody = table_anggaran_tahunan.getElementsByTagName("tbody");
                var get_tr = get_tbody[0].getElementsByTagName("tr");
                var kesamman_group = [];
                var check_kosong_anak = 0;
                var check_kosong_anak_number = 0;
                var check_kosong_group = 0;
                var lewat_kesamaan_group = 0;
                var lewat_check_kosong = 0;
                var lewat_check_number_kosong = 0;
                var pesan_modal = {};
                for(var i = 0; i < get_tr.length; i++){
                    if(get_tr[i].getAttribute("class").substr(0,"induk_group_".length) === "induk_group_"){
                        var get_input_group = get_tr[i].getElementsByTagName("input");
                        if(get_input_group[0].value === ""){
                            check_kosong_group = 1;
                        }
                        if(typeof kesamman_group[get_input_group[0].value] === "undefined"){
                            kesamman_group[get_input_group[0].value] = 0;
                        } else {
                            kesamman_group[get_input_group[0].value]++;
                        }
                    }
                    if(get_tr[i].getAttribute("class").substr(0,"anakan_group_".length) === "anakan_group_"){
                        var get_input_anakan = get_tr[i].getElementsByTagName("input");
                        if(get_input_anakan[0].value === ""){
                            check_kosong_anak = 1;
                        }
                        for(var j = 1; j < get_input_anakan.length; j++){
                            if(get_input_anakan[j].getAttribute("class") === "numberonly"){
                                if(get_input_anakan[j].value === ""){
                                    check_kosong_anak_number = 1;
                                }
                            }
                        }
                    }
                }
                
                if(check_kosong_anak_number){
                    lewat_check_number_kosong = 1;
                    pesan_modal = document.getElementById("pesan_modal");
                    pesan_modal.innerHTML = "Tidak boleh ada angka nol atau kosong.";
                    $('#modal-success').modal('show');
                    tombol_submit.removeAttribute("disabled");
                }
                
                if(!lewat_check_number_kosong){
                    for(var key in kesamman_group){
                        if(kesamman_group[key] > 0){
                            lewat_kesamaan_group = 1;
                            pesan_modal = document.getElementById("pesan_modal");
                            pesan_modal.innerHTML = "Nama Group tidak boleh sama.";
                            $('#modal-success').modal('show');
                            tombol_submit.removeAttribute("disabled");
                            break;
                        }
                    }
                }
                
                if(!lewat_check_number_kosong && !lewat_kesamaan_group && (check_kosong_group || check_kosong_anak)){
                    lewat_check_kosong = 1;
                    pesan_modal = document.getElementById("pesan_modal");
                    pesan_modal.innerHTML = "Nama Group dan Nama Rincian tidak boleh kosong.";
                    $('#modal-success').modal('show');
                    tombol_submit.removeAttribute("disabled");
                }
                
                if(!lewat_check_number_kosong && !lewat_kesamaan_group && !lewat_check_kosong){
                    if(kegiatan_program_kerja_rincian.value === "" || kegiatan_program_kerja_rincian_hidden.value === "" || mata_anggaran.value === "" || mata_anggaran_hidden.value === ""){
                        pesan_modal = document.getElementById("pesan_modal");
                        pesan_modal.innerHTML = "Rincian dan Mata Anggaran tidak boleh kosong.";
                        $('#modal-success').modal('show');
                        tombol_submit.removeAttribute("disabled");
                    } else {
                        unset_comma_view_all_all("");
                        unset_tiga_titik_all();
                        this.submit();
                    }
                }
            }
        };
    }
    /* https://stackoverflow.com/questions/17461682/calling-a-function-on-bootstrap-modal-open */
    /* https://stackoverflow.com/questions/45077494/get-data-attribute-of-a-bootstrap-modal-link */
    var masuk_video = false;
    $( "#modal-youtube" ).on('show.bs.modal', function(e){
        var id_video=$(e.relatedTarget).attr('id_video');
        $.post(
            "../../../index.php/checker",
            {"url" : "https://www.youtube.com/embed/" + id_video},
            function(data){
                console.log(data);
                var youtube_video = document.getElementById("youtube_video");
                youtube_video.setAttribute("src", data);
                youtube_video.onload = function(){
                    console.log("masuk dari onload frame.");
                    this.style.visibility = "visible";
                };
            }
        );
        masuk_video = true;
    });
    $(window).on('hidden.bs.modal', function() { 
        if(masuk_video){
            $('#modal-youtube').modal('hide');
            var youtube_video = document.getElementById("youtube_video");
            youtube_video.setAttribute("src", "#");
        }
        masuk_video = false;
        // console.log("Modal Hidden.");
        temporary_tr = [];
        adress_temporary_tr = 0;
        input_search_temporary.value = "";
    });
    var iframe_all = document.getElementsByTagName("iframe");
    for(var i = 0; i < iframe_all.length; i++){
        var get_src = iframe_all[i].getAttribute("src");
        if(get_src !== "" && get_src !== "#"){
            checker(get_src, iframe_all, i);
        }
    }
    $( "#button-project" ).click(function(){
        $('#modal-project').modal('show');
    }); 
    
    // https://www.c-sharpcorner.com/blogs/only-allowed-number-in-textbox-using-jquery
    // https://stackoverflow.com/questions/6178332/force-decimal-point-instead-of-comma-in-html5-number-input-client-side
    // https://stackoverflow.com/questions/9799505/allow-only-numbers-and-dot-in-script
    // https://www.outsystems.com/forums/discussion/53459/prevent-keyboard-arrow-key-up-and-down-using-javascript/
    // https://stackoverflow.com/questions/21177489/selectionstart-selectionend-on-input-type-number-no-longer-allowed-in-chrome
    
    $('.numberonly').keydown(function (e) {
        
        var charCode = (e.which) ? e.which : event.keyCode;
        
        /* console.log(charCode); */
        if(((e.shiftKey && charCode === 37) || (e.shiftKey && charCode === 39)) && typeof detect_address_right === "function"){
            e.preventDefault();
            if(charCode === 39){
                detect_address_right(this);
            }
            if(charCode === 37){
                detect_address_left(this);
            }
        }
    
        if((charCode === 38 || charCode === 40) && typeof detect_address_up === "function"){
            e.preventDefault();
            if(charCode === 38){
                detect_address_up(this);
            }
            if(charCode === 40){
                detect_address_down(this);
            }
        }
        if(charCode === 9 && typeof detect_address_input === "function"){
            // console.log("MASUK FUNGSI KEYDOWN TAB."); 
            // console.log(this.getAttribute("name"));
            detect_address_input(this);
        }
        if(charCode === 27 && typeof detect_address_input_delete === "function"){
            detect_address_input_delete(this);
        }
    });
    $('.numberonly').keypress(function (e) {    
        var charCode = (e.which) ? e.which : event.keyCode;  
        if(String.fromCharCode(charCode) === "."){
            if(this.value !== ""){
                return true;     
            }
        }
        if(String.fromCharCode(charCode).match(/[^0-9]/g))   { 
            return false;                        
        }
    });   
    $('.numberonly').keyup(function () {});
    $('.numberonly').focus(function () {
        if(typeof check_percent_nom_baris !== "undefined"){
            unset_comma_view_all(this.parentNode.parentNode.parentNode.parentNode.getAttribute("id"));
        }
        unset_tiga_titik_all_per_input(this);
        this.value = this.value.split(".").length > 1 && this.value.split(".")[1] !== "00" ? this.value : (this.value.split(".").length > 1 && this.value.split(".")[1] === "00" ? (this.value.substr(0,this.value.length - 3) === "0" ? "" : this.value.substr(0,this.value.length - 3)) : this.value);
        this.setAttribute("type", "text");
        this.setSelectionRange(0, this.value.length);
        this.setAttribute("type", "number");
    });
    $('.numberonly').blur(function () {
        if(typeof check_percent_nom_baris !== "undefined"){
            unset_comma_view_all_all(this.parentNode.parentNode.parentNode.parentNode.getAttribute("id"));
        }
        unset_tiga_titik_all();
        if(typeof check_percent_nom_baris !== "undefined"){
            check_percent_nom_baris(this);
            jumlahkan_nom_per_baris(this);
            jumlahkan_nom(this);
            check_nom_per_baris(this);
            set_tiga_titik_all();
            
        } 
        
        
        var get_nama = this.getAttribute("name");
        if(get_nama.substr(0,1) === "Q" || get_nama.substr(0,1) === "F"){
            this.value = this.value.split(".").length > 1 && this.value.split(".")[1] !== "" ? this.value : (this.value !== "" ? this.value + "" : ((this.value === "" ? "0" : this.value) + ""));
        } else {
            this.value = this.value.split(".").length > 1 && this.value.split(".")[1] !== "" ? this.value : (this.value !== "" ? this.value + ".00" : ((this.value === "" ? "0" : this.value) + ".00"));
        }
        if(typeof check_percent_nom_baris !== "undefined"){
            set_comma_view_all_all("");
        }
    });
    
    re_trigger_input_with_class('textinput');
    $('.numberonly-no-comma').keypress(function (e) {    
        var charCode = (e.which) ? e.which : event.keyCode;  
        if(String.fromCharCode(charCode).match(/[^0-9]/g))   { 
            return false;                        
        }
    });
    $('.numberonly-no-comma').blur(function () {    
        this.value = (this.value === "" ? "0" : this.value);
    });
    
    if(document.getElementById("table-anggaran-tahunan")){
        if(kondisi_page === "edit"){
            check_nom_all_row();
            set_tiga_titik_all();
            set_comma_view_all("table-anggaran-tahunan");
            if(kumpulan_alphabet !== ""){
                var split_alphabet = kumpulan_alphabet.split(",");
                for(var i = 0; i < split_alphabet.length; i++){
                    set_comma_view_all("table-anggaran-tahunan" + split_alphabet[i].toString());
                }
            }
        }
    }
    $("#tarifid").change(function(){
        // https://stackoverflow.com/questions/1643227/get-selected-text-from-a-drop-down-list-select-box-using-jquery
        $("#tarifnama").val($("#tarifid option:selected").text());
    });
    
    $(".multiple").select2();
    resize_wrapper();
    
});

$(window).resize(function(){
    /* console.log("COBA"); */
    resize_wrapper();
});

function do_increment(param, type){
    var huruf_angka = [];
    var angka_huruf = [];
    if(type === "alp"){
        huruf_angka = {
            "A" :  0,
            "B" :  1,
            "C" :  2,
            "D" :  3,
            "E" :  4,
            "F" :  5,
            "G" :  6,
            "H" :  7,
            "I" :  8,
            "J" :  9,
            "K" : 10,
            "L" : 11,
            "M" : 12,
            "N" : 13,
            "O" : 14,
            "P" : 15,
            "Q" : 16,
            "R" : 17,
            "S" : 18,
            "T" : 19,
            "U" : 20,
            "V" : 21,
            "W" : 22,
            "X" : 23,
            "Y" : 24,
            "Z" : 25
        };
        angka_huruf = {
            0  : "A",
            1  : "B",
            2  : "C",
            3  : "D",
            4  : "E",
            5  : "F",
            6  : "G",
            7  : "H",
            8  : "I",
            9  : "J",
            10 : "K",
            11 : "L",
            12 : "M",
            13 : "N",
            14 : "O",
            15 : "P",
            16 : "Q",
            17 : "R",
            18 : "S",
            19 : "T",
            20 : "U",
            21 : "V",
            22 : "W",
            23 : "X",
            24 : "Y",
            25 : "Z"
        };
    }
    if(type === "hex"){
        huruf_angka = {
            "0" :  0,
            "1" :  1,
            "2" :  2,
            "3" :  3,
            "4" :  4,
            "5" :  5,
            "6" :  6,
            "7" :  7,
            "8" :  8,
            "9" :  9,
            "A" : 10,
            "B" : 11,
            "C" : 12,
            "D" : 13,
            "E" : 14,
            "F" : 15
        };
        angka_huruf = {
            0  : "0",
            1  : "1",
            2  : "2",
            3  : "3",
            4  : "4",
            5  : "5",
            6  : "6",
            7  : "7",
            8  : "8",
            9  : "9",
            10 : "A",
            11 : "B",
            12 : "C",
            13 : "D",
            14 : "E",
            15 : "F"
        };
    }
    if(type === "dec"){
        huruf_angka = {
            "0" :  0,
            "1" :  1,
            "2" :  2,
            "3" :  3,
            "4" :  4,
            "5" :  5,
            "6" :  6,
            "7" :  7,
            "8" :  8,
            "9" :  9
        };
        angka_huruf = {
            0  : "0",
            1  : "1",
            2  : "2",
            3  : "3",
            4  : "4",
            5  : "5",
            6  : "6",
            7  : "7",
            8  : "8",
            9  : "9"
        };
    }
    if(type === "oct"){
        huruf_angka = {
            "0" :  0,
            "1" :  1,
            "2" :  2,
            "3" :  3,
            "4" :  4,
            "5" :  5,
            "6" :  6,
            "7" :  7
        };
        angka_huruf = {
            0  : "0",
            1  : "1",
            2  : "2",
            3  : "3",
            4  : "4",
            5  : "5",
            6  : "6",
            7  : "7"
        };
    }
    if(type === "bin"){
        huruf_angka = {
            "0" :  0,
            "1" :  1
        };
        angka_huruf = {
            0  : "0",
            1  : "1"
        };
    }
    var lasts = "";
    var awal = "";
    for(var key in huruf_angka){
        if(awal === ""){
            awal = key;
        }
        lasts = key;
    }
    var param_string = param.toString();
    var count_last = 0;
    var result_reserve = "";
    var result = "";
    var after_f = 0;
    for(var i = param_string.length - 1; i >= 0; i--){
        if(!after_f){
            if(param_string[i] === lasts){
                result_reserve = result_reserve + awal;
                count_last++;
            } else {
                var angka = huruf_angka[param_string[i]] + 1;
                var huruf = angka_huruf[angka];
                result_reserve = result_reserve + huruf;
                after_f = 1;
            }
        } else {
            result_reserve = result_reserve + param_string[i];
        }
    }
    if(count_last === param_string.length){
        result = awal === "0" ? ("1" + result_reserve) : (awal + result_reserve);
    } else {
        for(var i = result_reserve.length - 1; i >= 0; i--){
            result = result + result_reserve[i];
        }
    }
    return result;
}

function convert_number_alphabet(param){
    var angka = "A";
    for(var i = 1; i < param; i++){
        angka = do_increment(angka, "alp");
    }
    return angka;
}

function checker(get_src, iframe_all, urutan){
    $.post(
        "../../../index.php/checker",
        {"url" : get_src},
        function(data){
            console.log(data);
            iframe_all[urutan].setAttribute("src", data);
            iframe_all[urutan].onload = function(){
                console.log("masuk dari fungsi checker.");
                this.style.visibility = "visible";
            };
        }
    );
}

function remove_parent(){
    var tempat_menu = document.getElementById("tempat_menu");
    var get_radio = tempat_menu.getElementsByTagName("input");
    for(var i = 0; i < get_radio.length; i++){
        if(get_radio[i].getAttribute("type") === "radio"){
            get_radio[i].checked = false;
        }
    }
}

var next_inisial = typeof next_inisial_global !== "undefined" ? next_inisial_global : 2;
function tambah_table(){
    if(typeof konfirmasi_hapus !== "undefined" && konfirmasi_hapus){
        var pesan_modal = document.getElementById("pesan_modal");
        pesan_modal.innerHTML = "Tombol disabled sedang dalam mode konfirmasi hapus.";
        $('#modal-success').modal('show');
        return false;
    }
    // console.log("Tambah Table");
    var kumpulan_alphabet = document.getElementById("kumpulan_alphabet");
    var tempat_utama_table = document.getElementById("tempat_utama_table");
    var footer_utama_table = document.getElementById("footer_utama_table");
    var value_alphabet = kumpulan_alphabet.value;
    if(value_alphabet === ""){
        kumpulan_alphabet.value = convert_number_alphabet(next_inisial);
    } else {
        kumpulan_alphabet.value = kumpulan_alphabet.value + "," + convert_number_alphabet(next_inisial);
    }
    var create_input = document.createElement("input");
    create_input.setAttribute("type","hidden");
    create_input.setAttribute("name","inisial_all_" + convert_number_alphabet(next_inisial));
    create_input.setAttribute("id","inisial_all_" + convert_number_alphabet(next_inisial));
    create_input.value = "_1";
    var tempat_inisial_hidden = document.getElementById("tempat_inisial_hidden");
    tempat_inisial_hidden.appendChild(create_input);
    var div = document.createElement("div");
    div.setAttribute("style", "border: #f1f1f1 1px solid; box-shadow: 0 0 20px rgb(0 0 0 / 15%); padding: 12px 15px; /* margin-bottom: 15px; */ margin-top: 15px; min-width: 1300px;");
    
    /*
    <i class="fa fa-minus" onclick="kurangi_table('`+next_inisial+`',this);" style="cursor: pointer;"></i>&nbsp;&nbsp;Remove Table */
    div.innerHTML = `
        
        <div class="form-group" style="margin-bottom: 0px;">
            <div class="col-xs-12" style="padding-left: 0px;">
                <div class="form-group" id="form_group_a" style="margin-bottom: 0px;">
                    <label for="mata_anggaran`+convert_number_alphabet(next_inisial)+`" class="col-xs-2 control-label" style="padding-left: 0px;"><i class="fa fa-minus" onclick="kurangi_table('`+next_inisial+`',this);" style="cursor: pointer;"></i>&nbsp;&nbsp;Mata Anggaran</label>
                    <div class="col-xs-9 autocomplete" style='padding-left: 30px;'>
                        <input required="" type="text" id="mata_anggaran`+convert_number_alphabet(next_inisial)+`" class="form-control tambah-margin-bawah" name="mata_anggaran`+convert_number_alphabet(next_inisial)+`" placeholder="Mata Anggaran" value="" title="" autocomplete="off" disabled="">
                        <input required="" type="hidden" id="mata_anggaran`+convert_number_alphabet(next_inisial)+`_hidden" name="mata_anggaran`+convert_number_alphabet(next_inisial)+`_hidden" value="">
                        <input required="" type="hidden" name="inisial_all`+convert_number_alphabet(next_inisial)+`" id="inisial_all`+convert_number_alphabet(next_inisial)+`" value="">
                    </div>
                    <div class="col-xs-1" style="padding:0px;">
                        <button id="buka_dialog_mata_anggaran`+convert_number_alphabet(next_inisial)+`" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    `;
    var next_inisial_ = convert_number_alphabet(next_inisial);
    var duplikasi_table_raw = document.getElementById("duplikasi_table_raw");
    var get_table = duplikasi_table_raw.getElementsByTagName("table")[0];
    var table_clone = get_table.cloneNode(true);
    var old_id = table_clone.getAttribute("id");
    var new_id = old_id.split("{newname}").join(next_inisial_);
    table_clone.setAttribute("id", new_id);
    // table_clone.style.marginTop = "15px";
    var get_input_element_inside_table = table_clone.getElementsByTagName("input");
    for(var i = 0; i < get_input_element_inside_table.length; i++){
        var old_name = get_input_element_inside_table[i].getAttribute("name");
        var new_name = old_name.split("{newname}").join(next_inisial_);
        get_input_element_inside_table[i].setAttribute("name",new_name);
    }
    tempat_utama_table.insertBefore(div, footer_utama_table);
    tempat_utama_table.insertBefore(table_clone, footer_utama_table);
    
    var buka_dialog_mata_anggaran = document.getElementById("buka_dialog_mata_anggaran" + convert_number_alphabet(next_inisial));
    buka_dialog_mata_anggaran.next_inisial = convert_number_alphabet(next_inisial);
    $( "#buka_dialog_mata_anggaran" + convert_number_alphabet(next_inisial) ).click(function(){
        set_loading();
        var tombol = this;
        $.get("../../../index.php/add-anggaran/get-sp-search-mataanggaran", function(data, status){
            if(status === "success"){
                if(check_session(data)){
                    var mata_anggaran = document.getElementById("mata_anggaran" + tombol.next_inisial);
                    // console.log(mata_anggaran);
                    var tbody_hasil_data_mata_anggaran = document.getElementById("tbody_hasil_data_mata_anggaran");
                    tbody_hasil_data_mata_anggaran.innerHTML = data;
                    $('#modal-mata-anggaran').modal('show');
                    set_tr_click_inside_tbody(tbody_hasil_data_mata_anggaran,mata_anggaran,'modal-mata-anggaran','2,3', tombol.next_inisial);
                    removeLoading_regular();
                }
            }
        });
    });
    
    // re_trigger_input_with_class('textinput');
    re_trigger_numberonly_input();
    re_trigger_input_with_class('textinput');
    next_inisial++;
}

function kurangi_table(inisial, object_i){
    if(typeof konfirmasi_hapus !== "undefined" && konfirmasi_hapus){
        var pesan_modal = document.getElementById("pesan_modal");
        pesan_modal.innerHTML = "Tombol disabled sedang dalam mode konfirmasi hapus.";
        $('#modal-success').modal('show');
        return false;
    }
    var inisial_ = convert_number_alphabet(inisial);
    var kumpulan_alphabet = document.getElementById("kumpulan_alphabet");
    var value_alphabet = kumpulan_alphabet.value;
    var split_value_alphabet = value_alphabet.split(",");
    var new_value = "";
    var comma = "";
    for(var i = 0; i < split_value_alphabet.length; i++){
        if(split_value_alphabet[i] !== inisial_){
            new_value = new_value + comma + split_value_alphabet[i];
            comma = ",";
        }
    }
    if(document.getElementById("inisial_all_" + inisial_)){
        var inisial_all_ = document.getElementById("inisial_all_" + inisial_);
        inisial_all_.parentNode.removeChild(inisial_all_);
    }
    kumpulan_alphabet.value = new_value;
    var parent_i = object_i.parentNode.parentNode.parentNode.parentNode.parentNode;
    parent_i.parentNode.removeChild(parent_i);
    var table_anggaran = document.getElementById("table-anggaran-tahunan" + convert_number_alphabet(inisial));
    table_anggaran.parentNode.removeChild(table_anggaran);
    // console.log("DELETE TABEL");
    // console.log(convert_number_alphabet(inisial));
    // console.log(choosen_ma[convert_number_alphabet(inisial)]);
    delete choosen_ma[convert_number_alphabet(inisial)];
    // console.log(choosen_ma[convert_number_alphabet(inisial)]);
}