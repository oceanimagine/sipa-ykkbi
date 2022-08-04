<?php 
if(isset($data_search)){
    foreach($data_search as $data){ 
        ?>
        <tr>
            <td><?php echo $data->rekmakode; ?><div style="width: 0px; height: 0px; display: none;" attr_data='<?php echo json_encode(array($data->kode, $data->remagroup, $data->rekmakode, $data->nama_rekening)); ?>'></td>
            <td><?php echo $data->nama_rekening; ?></td>
        </tr>
        <?php     
    } 
}