<div class="modal fade" id="modal-project" style="z-index: 9999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">PROJECT LIST</h4>
            </div>
            <div class="modal-body">
                <ul style="list-style: none; padding: 0px; margin: 0px;">
                <?php foreach($data_project as $data){ ?>
                    <li style="cursor: pointer;"><a href="../../../index.php/globals/layoutcall/goto_project/<?php echo $data->kode; ?>" style="text-decoration: none; color: black;"><i class="fa fa-book" style="margin-right: 15px; margin-left: 15px;"></i><span><?php echo $data->kode; ?></span></a></li>
                <?php } ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>