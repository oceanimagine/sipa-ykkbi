/* ---------------------------------------------------------------------------*/
/* < Ajax Library > */

var base_url = "http://localhost:81/dm_server/promo/";

function doajax(method,url_request,send_value,json_response,success_function,error_function,object_loading,html_before){
    if(typeof object_loading !== "object"){
        set_loading();
    } else {
        var before = "";
        if(typeof html_before === "undefined"){
            before = "<br />";
        }
        object_loading.innerHTML = before + "Loading..";
    }
    var sendvalue = (method === "POST") ? "&" + set_param(send_value) + "&" : null;
    var urlrequest = (sendvalue === null) ? base_url + url_request + "?" + set_param(send_value) : base_url + url_request;
    if (window.XMLHttpRequest) {
        var variabel = new XMLHttpRequest();
    } else {
        var variabel = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var second_wait = 15;
    var interval_check = setInterval(function(){
        second_wait--;
        console.log(second_wait);
        if(second_wait === 0){
            hide_loading();
            if(typeof error_function === "function"){
                error_function("15 second time out !!!!");
            }
            clearInterval(interval_check);
        }
    },1000);
    variabel.onreadystatechange = function () {
        if (variabel.readyState === 4 && variabel.status === 200) {
            if(typeof success_function === "function"){
                if(json_response){
                    variabel.responseType = "json";
                    var result = variabel.response;
                    success_function(result);
                } else {
                    var result = variabel.responseText;
                    success_function(result);
                }
                hide_loading();
                clearInterval(interval_check);
            }
        }
        if (variabel.readyState === 4 && variabel.status === 500) {
            if(typeof error_function === "function"){
                error_function(variabel.status);
            }
            hide_loading();
        }
    };
    /* http://ptpca.blogspot.co.id/2009/01/daftar-e-book-online.html */
    /* https://fantekniskom.wordpress.com/download/ */
    /* http://agmedicare.co.id/getdata.php?pst=610021287&fam=0&prd=001 */
    /* http://stackoverflow.com/questions/20433655/no-access-control-allow-origin-header-is-present-on-the-requested-resource-or */
    /* http://john.sh/blog/2011/6/30/cross-domain-ajax-expressjs-and-access-control-allow-origin.html */
    /* http://stackoverflow.com/questions/20035101/no-access-control-allow-origin-header-is-present-on-the-requested-resource */
    /* variabel.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); */
    variabel.open(method, urlrequest, true);
    variabel.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    variabel.send(sendvalue);
}

function set_loading(){
    var div_loading = document.createElement("div");
    var span_loading = document.createElement("span");
    div_loading.setAttribute("id","div_loading");
    div_loading.style.position = "fixed";
    div_loading.style.top = "0px";
    div_loading.style.left = "0px";
    div_loading.style.width = "100%";
    div_loading.style.height = "100%";
    div_loading.style.textAlign = "center";
    div_loading.style.verticalAlign = "middle";
    div_loading.style.display = "table";
    div_loading.style.backgroundColor = "rgba(0, 0, 0, 0.8)";
    span_loading.style.verticalAlign = "middle";
    span_loading.style.display = "table-cell";
    span_loading.style.color = "#FFFFFF";
    span_loading.innerHTML = "Loading..";
    div_loading.appendChild(span_loading);
    document.body.appendChild(div_loading);
}

function hide_loading(){
    if(document.getElementById("div_loading")){
        var div_loading = document.getElementById("div_loading");
        div_loading.parentNode.removeChild(div_loading);
    }
}


function set_param(param){
    if(typeof param === "object"){
        var result = "";
        var separator = "";
        for(var key in param){
            result = result + separator + key + "=" + param[key];
            separator = "&";
        }
        return result;
    }
}

/* < End Line of Ajax Library > */
/* ---------------------------------------------------------------------------*/
/* ---------------------------------------------------------------------------*/
/* < Dialog Iframe > */

function remove_dialog_iframe(){
    if(document.getElementById("div_popup")){
        var div_popup = document.getElementById("div_popup");
        div_popup.parentNode.removeChild(div_popup);
    }
}

function set_dialog_iframe(iframe_url){
    var div_loading = document.createElement("div");
    var span_loading = document.createElement("span");
    div_loading.setAttribute("id","div_popup");
    div_loading.setAttribute("onclick","remove_dialog_iframe();");
    div_loading.style.position = "fixed";
    div_loading.style.zIndex = "9999";
    div_loading.style.top = "0px";
    div_loading.style.left = "0px";
    div_loading.style.width = "100%";
    div_loading.style.height = "100%";
    div_loading.style.textAlign = "center";
    div_loading.style.verticalAlign = "middle";
    div_loading.style.display = "table";
    div_loading.style.backgroundColor = "rgba(0, 0, 0, 0.8)";
    span_loading.style.verticalAlign = "middle";
    span_loading.style.display = "table-cell";
    span_loading.style.color = "#FFFFFF";
    span_loading.innerHTML = "<div style='width: 100%; height: 450px;' align='center'><iframe style='width: 60%; height: 100%; background-color: white;' src='" + base_url + iframe_url + "' framespacing='0' framepadding='0' frameborder='0' scrolling='yes'></iframe></div>";
    div_loading.appendChild(span_loading);
    document.body.appendChild(div_loading);
}

/* < End Line of Dialog Iframe > */

/* ---------------------------------------------------------------------------*/
/* 
doajax(
    "POST",
    "ajax/session_idperiode.php",
    {
        idPeriode : idPeriode,
        tanggal1 : tanggal1,
        tanggal2 : tanggal2,
        removeSession : "idCampaign"
    },
    false,
    function(result){
        console.log(result);
        window.open(base_url + 'campaign.php', 'campaign_add_tab');
    }
); */