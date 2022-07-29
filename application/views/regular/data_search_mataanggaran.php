<?php 
if(isset($data_search)){
    foreach($data_search as $data){ 
        ?>
        <tr>
            <td><?php echo $data->kode; ?></td>
            <td><?php echo $data->remagroup; ?></td>
            <td><?php echo $data->rekmakode; ?></td>
            <td><?php echo $data->nama_rekening; ?></td>
        </tr>
        <?php     
    } 
}