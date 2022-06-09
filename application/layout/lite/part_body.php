<section class="content">
    <?php if($this->contain_custom_config){ ?>
        {replace_body}
    <?php } else { ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info" style="border-top:  #adadad 2px solid; border-right: #adadad 2px solid;border-left: #adadad 2px solid;border-bottom: #adadad 2px solid;">
                <div class="box-header with-border">
                    <h3 class="box-title">Module {title}</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="overflow-x: auto;">
                    {replace_body}
                </div>
            </div> 
        </div>
    </div>
    <?php } ?>
</section>