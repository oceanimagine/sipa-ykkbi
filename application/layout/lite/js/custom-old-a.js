tinymce.init({
    selector: 'textarea#article_build',
    plugins: 'print preview importcss tinydrive searchreplace autolink autosave save directionality visualblocks visualchars fullscreen link media template codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons',
    // tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
    // tinydrive_dropbox_app_key: 'YOUR_DROPBOX_APP_KEY',
    // tinydrive_google_drive_key: 'YOUR_GOOGLE_DRIVE_KEY',
    // tinydrive_google_drive_client_id: 'YOUR_GOOGLE_DRIVE_CLIENT_ID',
    mobile: {
        plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker textpattern noneditable help formatpainter pageembed charmap mentions quickbars linkchecker emoticons advtable'
    },
    menu: {
        tc: {
            title: 'Comments',
            items: 'addcomment showcomments deleteallconversations'
        }
    },
    menubar: 'file edit view insert format tools table tc help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    link_list: [
        {title: 'My page 1', value: 'https://www.tiny.cloud'},
        {title: 'My page 2', value: 'http://www.moxiecode.com'}
    ],
    image_list: [
        {title: 'My page 1', value: 'https://www.tiny.cloud'},
        {title: 'My page 2', value: 'http://www.moxiecode.com'}
    ],
    image_class_list: [
        {title: 'None', value: ''},
        {title: 'Some class', value: 'class-name'}
    ],
    importcss_append: true,
    templates: [
        {title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'},
        {title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...'},
        {title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'}
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    spellchecker_ignore_list: ['Ephox', 'Moxiecode'],
    tinycomments_mode: 'embedded',
    content_style: '.mymention{ color: gray; }',
    contextmenu: 'link image imagetools table configurepermanentpen',
    a11y_advanced_options: true,
    skin: 'oxide',
    content_css: 'default',
    mentions_selector: '.mymention',
    mentions_item_type: 'profile'
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