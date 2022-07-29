<?php 
if(isset($data_search)){
    foreach($data_search as $data){ 
        ?>
        <tr>
            <td><?php echo $data->nama_satker; ?></td>
            <td><?php echo $data->pktkode_k; ?></td>
            <td><?php echo $data->nama_kegiatan; ?></td>
            <td><?php echo $data->pktkode_rk; ?></td>
            <td><?php echo $data->nama_rinciankegiatan; ?></td>
        </tr>
        <?php     
    } 
}