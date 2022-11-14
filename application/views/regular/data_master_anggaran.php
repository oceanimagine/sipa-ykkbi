<?php 
if(isset($data_search)){
    foreach($data_search as $data){ 
        ?>
        <tr>
            <td style="white-space: nowrap;"><?php echo $data->kode; ?><div style="width: 0px; height: 0px; display: none;" attr_data='<?php echo json_encode(array($data->kode, $data->satkerid, $data->tarifid, $data->tarifnama, $data->tarifnom, $data->tarifdesc)); ?>'></div></td>
            <td><?php echo $data->satkernama; ?></td>
            <td style="text-align: right;"><?php echo $data->tarifid; ?></td>
            <td><?php echo $data->tarifnama; ?></td>
            <td style="text-align: right;"><?php echo $data->tarifnom; ?></td>
            <td><?php echo $data->tarifdesc; ?></td>
        </tr>
        <?php     
    } 
}