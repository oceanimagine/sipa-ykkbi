<?php 
include_once __DIR__ . "/../../../../../../../../../config/connect-list.php";
include_once __DIR__ . "/../../../../../../../../../config/connect.php";
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Dialog List</title>
        <style type="text/css">
            html, body {
                font-family: consolas, monospace;
                width: 100%;
                height: 100%;
                padding: 0px;
                margin: 0px;
                cursor: default;
            }
            /* width */
            ::-webkit-scrollbar {
              width: 8px;
              height: 2px;
            }
            /* Track */
            ::-webkit-scrollbar-track {
              box-shadow: inset 0 0 5px #3b3c8c; 
              border-radius: 0px;
            }
            /* Handle */
            ::-webkit-scrollbar-thumb {
              background: #3b3c8c; 
              border-radius: 0px;
            }
            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
              background: #3b3c8c; 
            }

            /* Firefox Scrollbar */
            html, body {
                scrollbar-color: #3b3c8c grey;
                scrollbar-width: thin;
            }

            div {
                scrollbar-width: thin;
                scrollbar-color: #3b3c8c grey;
            }
        </style>
        <script type="text/javascript">
        function hapus_gambar(nama_file, info_full_url){
            if(confirm("Are You Sure ?")){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.status === 200 && this.readyState === 4){
                        if(this.responseText === "DONE PROCESS."){
                            alert("Done");
                            var w = get_win();
                            var get_div = w.document.getElementsByTagName("div");
                            for(var i = 0; i < get_div.length; i++){
                                if(get_div[i].getAttribute("class") === "mce-tinymce mce-container mce-panel"){
                                    var get_iframe = get_div[i].getElementsByTagName("iframe");
                                    var get_images = get_iframe[0].contentWindow.document.getElementsByTagName("img");
                                    for(var j = 0; j < get_images.length; j++){
                                        if(get_images[j].getAttribute("src") === info_full_url){
                                            get_images[j].parentNode.removeChild(get_images[j]);
                                            j--;
                                        }
                                    }
                                }
                            }
                            location.reload();
                        }
                    }
                };
                var nama_file_send = encodeURI(nama_file);
                xmlhttp.open("GET", "ci/index.php?delete/" + nama_file_send);
                xmlhttp.send(null);
            }
        }
        
        function put_image(filename){
            var w = get_win();
            var tinymce = w.tinymce;
            tinymce.EditorManager.activeEditor.insertContent('<img src="' + filename +'" style="width: 400px;">');
        }
        
        function get_win(){
            return (!window.frameElement && window.dialogArguments) || opener || parent || top;
        }
        
        </script>
    </head>
    <body>
    <?php 
    
    $data_image = scandir(__DIR__ . "/images/");
    echo "
        <div style='width: 100%; height: 15%; overflow-x: hidden; overflow-y: scroll;'>
            
            <table border='0' cellspacing='0' cellpadding='0' style='width: 100%; table-layout: fixed;'>
                <thead>
                <tr>
                <th style='width: 50%; height: 5%; border-right: #c5c5c5 1px solid; border-bottom: #c5c5c5 1px solid;'>Images</th>
                <th style='width: 50%; height: 5%; border-bottom: #c5c5c5 1px solid;'>Action</th>
                </tr>
                </thead>
            </table>
            
            </div>
        <div style='width: 100%; height: 85%; overflow-x: hidden; overflow-y: scroll;'>
        
        <table border='0' cellspacing='0' cellpadding='0' style='width: 100%; height: 100%; table-layout: fixed;'>
            <tbody>";
    if(sizeof($data_image) == 2){
        echo "
            <tr>
                <td style='width: 50%; height: 100%; border-right: #c5c5c5 1px solid; text-align: center; padding-bottom: 4px; padding-top: 4px;'>No Images.</td>
                <td style='width: 50%; height: 100%; text-align: center;'><a href='dialog-v4.htm' style='text-decoration: none;'>Back</a></td>
            </tr>";
    }
    for($i = 2; $i < sizeof($data_image); $i++){
        echo "
            <tr>
                <td style='width: 50%; height: 100%; border-bottom: #c5c5c5 1px solid; border-right: #c5c5c5 1px solid; text-align: center; padding-bottom: 4px; padding-top: 4px;'><img onclick=\"put_image('".$GLOBALS['tinymce_base']."/".$data_image[$i]."');\" src='images/".$data_image[$i]."' style='width: 80%; cursor: pointer;' /></td>
                <td style='width: 50%; height: 100%; border-bottom: #c5c5c5 1px solid; text-align: center;'><a href=\"javascript: hapus_gambar('".$data_image[$i]."', '".$GLOBALS['tinymce_base']."/".$data_image[$i]."');\" style='text-decoration: none;'>Delete</a></td>
            </tr>";
        if(!isset($data_image[$i + 1])){
        echo "
            <tr>
                <td colspan='2' style='width: 50%; height: 100%; text-align: center;'><a href='dialog-v4.htm' style='text-decoration: none;'>Back</a></td>
            </tr>";
        }
    }
    echo "
            </tbody>
        </table>
        </div>
    ";
    
    ?>
    </body>
</html>