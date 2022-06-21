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
    $('.numberonly').keypress(function (e) {    
        var charCode = (e.which) ? e.which : event.keyCode;  
        if(String.fromCharCode(charCode).match(/[^0-9]/g))   { 
            return false;                        
        }
    });   
    $('.numberonly').focus(function () {
        this.value = this.value.substr(0,this.value.length - 3);
    });
    $('.numberonly').blur(function () {    
        this.value = (this.value === "" ? "0" : this.value) + ".00";
    });
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