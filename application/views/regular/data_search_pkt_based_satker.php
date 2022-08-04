<?php 
if(isset($data_search)){
    foreach($data_search as $data){ 
        ?>
        <tr>
            <td style="white-space: nowrap;"><?php echo $data->nama_satker; ?><div style="width: 0px; height: 0px; display: none;" attr_data='<?php echo json_encode(array($data->nama_satker, $data->pktkode_k, $data->nama_kegiatan, $data->pktkode_rk, $data->nama_rinciankegiatan, $data->sbpkode)); ?>'></div></td>
            <td><?php echo $data->pktkode_rk; ?></td>
            <td><?php echo $data->nama_rinciankegiatan; ?></td>
        </tr>
        <?php     
    } 
}