function activate_select(){
    window.id_element = "id_lang";
    var get_all_select = document.getElementsByTagName("select");
    for(var i = 0; i < get_all_select.length; i++){
        if(get_all_select[i].getAttribute('id') === window.id_element){
            set_change_(function(){
                var set_lang = document.getElementById("set_lang");
                var lang_id = document.getElementById("lang_id");
                lang_id.value = this.value;
                set_lang.submit();
            }, get_all_select[i]);
        }
    }
}

function set_change(func_args){
    var id_lang = document.getElementById(window.id_element);
    id_lang.onchange = func_args;
}

function set_change_(func_args, object_select){
    object_select.onchange = func_args;
}

function initialize_languague(){
    window.id_element = "id_lang";
    if(initialize_select()){
        initialize_iframe();
        initialize_input_file();
        initialize_focus();
    }
}

function initialize_select(){
    if(document.getElementById(window.id_element)){
        set_change(function(){
            document.location = "../../../index.php/front/set_lang/" + this.value;
        });
        return true;
    } else {
        return false;
    }
}

function initialize_iframe(){
    var ints = setInterval(function(){
        if(iframe_found()){
            clearInterval(ints);
        }
    }, 500);
}

function initialize_input_file(){
    var input_element = document.getElementsByTagName("input");
    input_file_search(input_element);
}

function initialize_focus(){
    window.onfocus = function() {
        set_reload();
    };
}

function iframe_found(){
    var iframe_element = document.getElementsByTagName("iframe");
    if(iframe_element.length > 0){
        iframe_inits(iframe_element);
        return true;
    }
    return false;
}

function iframe_inits(iframe_element){
    for(var i = 0; i < iframe_element.length; i++){
        var iframeDoc = iframe_element[i].contentDocument || iframe_element[i].contentWindow.document;
        var body = iframeDoc.getElementsByTagName("body");
        body[0].onfocus = function(){
            window.iframe_active = 1;
        };
    }
}

function input_file_search(input_element){
    for(var i = 0; i < input_element.length; i++){
        input_file_get(input_element[i]);
    }
}

function input_file_get(input_element){
    if(input_element.getAttribute("type") === "file"){
        input_element.onclick = function(){
            window.element_active = 1;
        };
    }
}

function set_reload(){
    if(check_reload()){
        location.reload();
    }
}

function check_reload(){
    var allow = 1;
    if(typeof window.iframe_active !== "undefined"){
        if(window.iframe_active){
            window.iframe_active = 0;
            allow = 0;
        }
    }
    if(typeof window.element_active !== "undefined"){
        if(window.element_active){
            window.element_active = 0;
            allow = 0;
        }
    }
    return allow;
}

function check_all_input(all_id){
    for(var i = 0; i < all_id.length; i++){
        disabled_input((document.getElementById(window.id_element) ? all_id[i] : "UNKNOWN"));
    }
}

function disabled_input(id_active){
    if(id_active.substr(0,5) === "photo"){
        check_input_file();
    } else {
        check_input_other(id_active);
    }
}

function check_input_other(id_active){
    if(document.getElementById(id_active)){
        var element = document.getElementById(id_active);
        var hiddens = document.createElement("input");
        var parents = element.parentNode;
        hiddens.setAttribute("type", "hidden");
        hiddens.setAttribute("value", element.value);
        hiddens.setAttribute("name", element.getAttribute("name"));
        parents.appendChild(hiddens);
        element.setAttribute("disabled", "disabled");
    }
}

function check_input_file(){
    var get_input = document.getElementsByTagName("input");
    for(var i = 0; i < get_input.length; i++){
        get_input_file(get_input[i]);
    }
}

function get_input_file(_input){
    if(_input.getAttribute("type") === "file" && _input.getAttribute("id").substr(0,5) === "photo"){
        _input.setAttribute("disabled", "disabled");
    }
}