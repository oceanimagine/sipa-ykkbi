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

function check_session(HTMLTAG){
    var split_login = HTMLTAG.split("<div class=\"login-box\">");
    if(split_login.length > 1){
        document.location = "../../../index.php/login";
        return false;
    }
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
        document.body.classList.add("sidebar-collapse");
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
    $(".numberonly").off('focus');
    $('.numberonly').focus(function () {
        jumlahkan_nom_per_baris(this);
        jumlahkan_nom(this);
        this.value = this.value.split(".").length > 1 && this.value.split(".")[1] !== "00" ? this.value : (this.value.split(".").length > 1 && this.value.split(".")[1] === "00" ? (this.value.substr(0,this.value.length - 3) === "0" ? "" : this.value.substr(0,this.value.length - 3)) : this.value);
        this.setAttribute("type", "text");
        this.setSelectionRange(0, this.value.length);
        this.setAttribute("type", "number");
    });
    $(".numberonly").off('blur');
    $('.numberonly').blur(function () {  
        jumlahkan_nom_per_baris(this);
        jumlahkan_nom(this);
        var get_nama = this.getAttribute("name");
        if(get_nama.substr(0,1) === "Q" || get_nama.substr(0,1) === "F"){
            this.value = this.value.split(".").length > 1 && this.value.split(".")[1] !== "" ? this.value : (this.value !== "" ? this.value + "" : ((this.value === "" ? "0" : this.value) + ""));
        } else {
            this.value = this.value.split(".").length > 1 && this.value.split(".")[1] !== "" ? this.value : (this.value !== "" ? this.value + ".00" : ((this.value === "" ? "0" : this.value) + ".00"));
        }
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
            
            var mata_anggaran = document.getElementById("mata_anggaran");
            mata_anggaran.value = "";
            var mata_anggaran_hidden = document.getElementById("mata_anggaran_hidden");
            mata_anggaran_hidden.value = "";
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

                if(kegiatan_program_kerja_rincian.value === "" || kegiatan_program_kerja_rincian_hidden.value === "" || mata_anggaran.value === "" || mata_anggaran_hidden.value === ""){
                    var pesan_modal = document.getElementById("pesan_modal");
                    pesan_modal.innerHTML = "Rincian dan Mata Anggaran tidak boleh kosong.";
                    $('#modal-success').modal('show');
                    tombol_submit.removeAttribute("disabled");
                } else {
                    this.submit();
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
            /* console.log("MASUK FUNGSI KEYDOWN TAB."); */
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
    $('.numberonly').focus(function () {
        jumlahkan_nom_per_baris(this);
        jumlahkan_nom(this);
        this.value = this.value.split(".").length > 1 && this.value.split(".")[1] !== "00" ? this.value : (this.value.split(".").length > 1 && this.value.split(".")[1] === "00" ? (this.value.substr(0,this.value.length - 3) === "0" ? "" : this.value.substr(0,this.value.length - 3)) : this.value);
        this.setAttribute("type", "text");
        this.setSelectionRange(0, this.value.length);
        this.setAttribute("type", "number");
    });
    $('.numberonly').blur(function () {
        jumlahkan_nom_per_baris(this);
        jumlahkan_nom(this);
        var get_nama = this.getAttribute("name");
        if(get_nama.substr(0,1) === "Q" || get_nama.substr(0,1) === "F"){
            this.value = this.value.split(".").length > 1 && this.value.split(".")[1] !== "" ? this.value : (this.value !== "" ? this.value + "" : ((this.value === "" ? "0" : this.value) + ""));
        } else {
            this.value = this.value.split(".").length > 1 && this.value.split(".")[1] !== "" ? this.value : (this.value !== "" ? this.value + ".00" : ((this.value === "" ? "0" : this.value) + ".00"));
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
    $("#tarifid").change(function(){
        // https://stackoverflow.com/questions/1643227/get-selected-text-from-a-drop-down-list-select-box-using-jquery
        $("#tarifnama").val($("#tarifid option:selected").text());
    });
    resize_wrapper();
});

$(window).resize(function(){
    /* console.log("COBA"); */
    resize_wrapper();
});

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