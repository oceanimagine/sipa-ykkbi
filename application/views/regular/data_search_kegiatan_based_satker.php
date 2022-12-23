<?php 
if(isset($data_search)){
    foreach($data_search as $data){ 
        ?>
        <tr info="kegiatan">
            <td style="white-space: nowrap;"><?php echo $data->sbpkode; ?><div style="width: 0px; height: 0px; display: none;" attr_data='<?php echo json_encode(array($data->pktkode, $data->kode, $data->sbpkode, $data->pktkrk, $data->pktnourut, $data->pktnama, $data->pktoutput)); ?>'></div></td>
            <td><?php echo $data->pktkode; ?></td>
            <td><?php echo $data->pktnama; ?></td>
            <td><?php echo $data->pktoutput; ?></td>
        </tr>
        <?php     
    } 
    if(sizeof($data_search) == 0){
        ?>
        <tr info="kegiatan">
            <td colspan="4">No Data Please Select SBP.</td>
        </tr> 
        <?php
    }
} else {
    ?>
    <tr info="kegiatan">
        <td colspan="4">No Data Please Select SBP.</td>
    </tr> 
    <?php
}