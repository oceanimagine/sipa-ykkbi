<?php 
if(isset($data_search)){
    foreach($data_search as $data){ 
        if(strlen($data->sbpkode) > 2){
        ?>
        <tr>
            <td><?php echo $data->sbpkode; ?><div style="width: 0px; height: 0px; display: none;" attr_data='<?php echo json_encode(array($data->sbpkode, $data->sbpnourut, $data->sbpdesc)); ?>'></td>
            <td><?php echo $data->sbpnourut; ?></td>
            <td><?php echo $data->sbpdesc; ?></td>
        </tr>
        <?php     
        }
    } 
}