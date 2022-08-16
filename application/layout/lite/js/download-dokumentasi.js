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

function setWindowPreview(){
    setTimeout(function(){
        removeLoading();
        setTimeout(function(){
            window.open("../../../upload/SIPA-DOKUMENTASI.pdf", '_blank');
        }, 1000);
    }, 1000);
}

function setDownload(){
    if (!window.ActiveXObject) {
        var save = document.createElement('a');
        save.href = "../../../upload/SIPA-DOKUMENTASI.pdf";
        save.target = '_blank';
        save.download = 'DOKUMENTASI.pdf' || 'unknown';

        var evt = new MouseEvent('click', {
            'view': window,
            'bubbles': true,
            'cancelable': false
        });
        save.dispatchEvent(evt);

        (window.URL || window.webkitURL).revokeObjectURL(save.href);
        setTimeout(function(){
            removeLoading();
        }, 1000);
    }
}

window.addEventListener("load",function(){
    if(document.getElementById("preview_dokumentasi_aplikasi_sipa")){
        var preview_dokumentasi_aplikasi_sipa = document.getElementById("preview_dokumentasi_aplikasi_sipa");
        preview_dokumentasi_aplikasi_sipa.onclick = function(){
            set_loading();
            setWindowPreview();
        };
    }
    if(document.getElementById("download_dokumentasi_aplikasi_sipa")){
        var download_dokumentasi_aplikasi_sipa = document.getElementById("download_dokumentasi_aplikasi_sipa");
        download_dokumentasi_aplikasi_sipa.onclick = function(){
            set_loading();
            setDownload();
        };
    }
});