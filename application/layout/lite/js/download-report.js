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

function create_iframe(url,id_iframe,success){
    var iframe = document.createElement("iframe");
    iframe.style.width = "0px";
    iframe.style.height = "0px";
    iframe.style.display = "none";
    iframe.setAttribute("src", url);
    iframe.setAttribute("id", id_iframe);
    document.body.appendChild(iframe);
    var timer = setInterval(function () {
        var iframe_helper = document.querySelector("#" + id_iframe);
        var iframeDoc = iframe_helper.contentDocument || iframe_helper.contentWindow.document;
        if (iframeDoc.readyState == 'complete' || iframeDoc.readyState == 'interactive') {
            success(iframeDoc);
            clearInterval(timer);
            return;
        }
    }, 4000);
}

function removeFrame(id_iframe){
    var iframe_helper = document.querySelector("#" + id_iframe);
    iframe_helper.parentNode.removeChild(iframe_helper);
}

function setIframe(param){
    var id_iframe = 'iframe_report';
    create_iframe("../../../index.php/report/" + param, id_iframe, function(){
        removeLoading();
        setTimeout(function(){
            removeFrame(id_iframe);
        }, 1000);
    });
}

function setIframeOS(param){
    var id_iframe = 'iframe_cek_os';
    create_iframe("../../../index.php/check_os", id_iframe, function(doc){
        if(doc.getElementById("osnya")){
            var osnya = doc.getElementById("osnya");
            if(osnya.innerHTML === "Windows"){
                removeLoading("Windows is not Supported.");
            }
            else if(osnya.innerHTML === "Linux"){
                console.log("linux");
                setIframeView(param);
            }
            setTimeout(function(){
                removeFrame(id_iframe);
            }, 1000);
        }
    });
}

function setIframeView(param){
    var id_iframe = 'iframe_view';
    removeLoading(
        "DONE.",
        "Now Convert to View Scope Please Wait...."
    );
    create_iframe("../../../index.php/report/" + param, id_iframe, function(doc){
        if(doc.getElementById("filename")){
            var filename = doc.getElementById("filename").innerHTML;
            setTimeout(function(){
                setIframePrepareView(filename);
                setTimeout(function(){
                    removeFrame(id_iframe);
                }, 1000);
            }, 1000);
        }
        
    });
}

function setIframePrepareView(filename){
    var id_iframe = 'iframe_view_prepare';
    create_iframe("../../../index.php/check_os/is_linux/" + filename, id_iframe, function(doc){
        check_only_result(id_iframe,filename);
    });
}

function check_only_result(id_iframe,filename){
    var iframe_helper = document.querySelector("#" + id_iframe);
    var doc = iframe_helper.contentDocument || iframe_helper.contentWindow.document;
    if(doc.getElementById("result")){
        var result = doc.getElementById("result");
        if(result.innerHTML === "SUCCESS"){
            removeLoading();
            var name_only = filename.substr(0, filename.length - ".xlsx".length);
            window.open("../../../index.php/check_os/get_html_view_temporary/" + name_only + ".html/" + filename, '_blank');
            setTimeout(function(){
                removeFrame(id_iframe);
            }, 1000);
        }
    } else {
        setTimeout(function(){
            console.log("Check Again.");
            removeLoading(
                "STILL PROCESS",
                "PLEASE WAIT"
            );
            check_only_result(id_iframe, filename);
        }, 2000);
    }
}

window.addEventListener("load",function(){
    if(document.getElementById("preview_laporan_anggaran_berdasarkan_program_kerja")){
        var preview_laporan_anggaran_berdasarkan_program_kerja = document.getElementById("preview_laporan_anggaran_berdasarkan_program_kerja");
        preview_laporan_anggaran_berdasarkan_program_kerja.onclick = function(){
            set_loading();
            setIframeOS("sbp_view");
        };
    }
    if(document.getElementById("preview_laporan_anggaran_berdasarkan_mata_anggaran")){
        var preview_laporan_anggaran_berdasarkan_mata_anggaran = document.getElementById("preview_laporan_anggaran_berdasarkan_mata_anggaran");
        preview_laporan_anggaran_berdasarkan_mata_anggaran.onclick = function(){
            set_loading();
            setIframeOS("ma_view");
        };
    }
    if(document.getElementById("download_laporan_anggaran_berdasarkan_program_kerja")){
        var download_laporan_anggaran_berdasarkan_program_kerja = document.getElementById("download_laporan_anggaran_berdasarkan_program_kerja");
        download_laporan_anggaran_berdasarkan_program_kerja.onclick = function(){
            set_loading();
            setIframe("sbp");
        };
    }
    if(document.getElementById("download_laporan_anggaran_berdasarkan_mata_anggaran")){
        var download_laporan_anggaran_berdasarkan_mata_anggaran = document.getElementById("download_laporan_anggaran_berdasarkan_mata_anggaran");
        download_laporan_anggaran_berdasarkan_mata_anggaran.onclick = function(){
            set_loading();
            setIframe("ma");
        };
    }
});