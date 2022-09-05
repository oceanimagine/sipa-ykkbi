<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Module Mata Anggaran Individual Benchmarks Form</title>
        <style type="text/css">
            html, body {
                font-family: consolas, monospace;
                cursor: default;
                width: 100%;
                height: 100%;
                margin: 0px;
                padding: 0px;
            }
            pre {
                font-family: consolas, monospace;
            }
        </style>
	<script type="text/javascript">
            /* Put JS Here */ 
            function move_url(link){
                document.location = "../../../index.php/" + link;
            }
            
	</script>
</head>
<body>
    <?php $CI =& get_instance(); ?>
    <?php 
    
    $disabled = "";
    if(!isset($rekmanama)){
        if($CI->allow_create == "0"){
            $disabled = " disabled=''";
        }
    }
    if(isset($rekmanama)){
        if($CI->allow_update == "0"){
            $disabled = " disabled=''";
        }
    }
    
    ?>
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div class="box-body">
            
            <div class="form-group">
                <label for="kode_project" class="col-lg-2 control-label">Kode Project</label>
                <div class="col-lg-10">
                    <input type="text" id="kode_project" class="form-control" name="kode_project" placeholder="Kode Project" value="{replace_project_modal}" disabled>
                    <input type="hidden" name="kode" value="{replace_project_modal}" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="rekmakode" class="col-lg-2 control-label">Rekma Kode</label>
                <div class="col-lg-10">
                    <input <?php echo $disabled; ?> required type="number" id="rekmakode" class="form-control numberonly-no-comma" name="rekmakode" placeholder="Rekma Kode" value="<?php echo isset($rekmakode) ? $rekmakode : "0"; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="rekmanama" class="col-lg-2 control-label">Rekma Nama</label>
                <div class="col-lg-10">
                    <input <?php echo $disabled; ?> required type="text" id="rekmanama" class="form-control" name="rekmanama" placeholder="Rekma Nama" value="<?php echo isset($rekmanama) ? $rekmanama : ""; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="rekmainduk" class="col-lg-2 control-label">Rekma Induk</label>
                <div class="col-lg-10">
                    <select <?php echo $disabled; ?> name="rekmainduk" id="rekmainduk" class="form-control">
                        <option value="">PILIH Rekma Induk</option>
                        <?php foreach($data_tblmastermainduk as $data){ ?>
                        <option value="<?php echo $data->rekmainduk; ?>"<?php echo isset($rekmainduk) && $rekmainduk == $data->rekmainduk ? " selected='selected'" : ""; ?>><?php echo "(" . $data->rekmainduk . ") " . $data->rekmainduknama; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="benchmarkang" class="col-lg-2 control-label">Benchmark Angka</label>
                <div class="col-lg-10">
                    <input <?php echo $disabled; ?> required type="number" id="benchmarkang" class="form-control numberonly" name="benchmarkang" placeholder="Benchmark Angka" value="<?php echo isset($benchmarkang) ? $benchmarkang : "0.00"; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="benchmarkprog" class="col-lg-2 control-label">Benchmark Program</label>
                <div class="col-lg-10">
                    <input <?php echo $disabled; ?> required type="number" id="benchmarkprog" class="form-control numberonly" name="benchmarkprog" placeholder="Benchmark Program" value="<?php echo isset($benchmarkprog) ? $benchmarkprog : "0.00"; ?>">
                </div>
            </div>
            
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 40px;">
                    <button <?php echo $disabled; ?> style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_mata_anggaran_individual_bencharks" value="Input mata anggaran individual benchmarks">Input Mata Anggaran Individual Benchmarks</button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('mata-anggaran-individual-benchmarks');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>