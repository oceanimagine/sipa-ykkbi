<?php 
if(isset($data_search)){
    foreach($data_search as $data){ 
        ?>
        <tr>
            <td style="white-space: nowrap;"><?php echo $data->sbpkode; ?><div style="width: 0px; height: 0px; display: none;" attr_data='<?php echo json_encode(array($data->kode, $data->sbpkode, $data->sbpnourut, $data->sbpdesc, $data->sbporderview)); ?>'></div></td>
            <td><?php echo $data->sbpnourut; ?></td>
            <td><?php echo $data->sbpdesc; ?></td>
        </tr>
        <?php     
    } 
}