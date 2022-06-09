<?php

function get_no_tiket(){
    global $class_name;
    global $id_user;
    $db = get_instance()->db->conn_id;
    $table_name = $class_name;
    $increment = 1;
    $query_max = mysqli_query($db, "select notiket from " . $table_name . " where pelapor_nip = '".$id_user."' order by notiket desc");
    if(mysqli_num_rows($query_max) > 0){
        $hasil_max = mysqli_fetch_array($query_max);
        $substring = substr($hasil_max['notiket'], -6);
        $substring_int = (int) $substring;
        $increment = $substring_int + 1;
        $nomor_tiket = "HD" . date("YmdHis") . samakan($id_user, "00000000") . samakan($increment, "00000000");
    } else {
        $nomor_tiket = "HD" . date("YmdHis") . samakan($id_user, "00000000") . samakan($increment, "00000000");
    }
    return $nomor_tiket;
}