<?php 
if(isset($data_search)){
    foreach($data_search as $data){ 
        ?>
        <tr>
            <td><?php echo $data->ikukode; ?><div style="width: 0px; height: 0px; display: none;" attr_data='<?php echo json_encode(array($data->ikukode, $data->ikunama, $data->ikurincian)); ?>'></td>
            <td><?php echo $data->ikunama; ?></td>
            <td><?php echo $data->ikurincian; ?></td>
        </tr>
        <?php     
    } 
}