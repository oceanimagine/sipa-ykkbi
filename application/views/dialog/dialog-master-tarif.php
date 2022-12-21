<script type="text/javascript">
window.masukkan_deskripsi = false;
window.addEventListener("load", function(){
    var param_deskripsi = document.getElementById("param_deskripsi");
    param_deskripsi.onclick = function(){
        if(this.checked){
            window.masukkan_deskripsi = true;
        } else {
            window.masukkan_deskripsi = false;
        }
    };
});
</script>
<div class="modal fade" id="modal-master-tarif" style="z-index: 9999;">
    <div class="modal-dialog" style="width: 60%; margin: 9vh auto; height: 100%;">
        <div class="modal-content">
            <div class="modal-header" style="height: 8vh;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Daftar Tarif</h4>
            </div>
            <div class="modal-body" style="height: 60vh; overflow: auto; padding: 0px; margin: 0px;">

                <table id="table-data" class="table table-bordered table-hover">
                    <thead style="background-color: white;">
                        <tr>
                            <th style="white-space: nowrap;">Kode</th>
                            <th style="white-space: nowrap;">Satker</th>
                            <th style="white-space: nowrap;">ID Tarif</th>
                            <th style="white-space: nowrap;">Jenis Tarif</th>
                            <th style="white-space: nowrap;">Nominal</th>
                            <th style="white-space: nowrap;">Deskripsi</th>
                        </tr>
                        <tr>
                            <th style="white-space: nowrap;padding-top: 0px; padding-bottom:0px;" colspan="6">
                                <input type="text" style="width: 100%;border: 0px;outline: none;height: 32px;" placeholder="Cari ...." id="search_text_dialog_master_tarif">
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody_hasil_data_master_tarif" style="white-space: pre-wrap;">
                        <tr>
                            <td colspan="6">No Data.</td>
                        </tr>
                    </tbody>
                </table>  
            </div>
            <div class="modal-footer" style="height: 10vh; padding: 20px; overflow-y: hidden; overflow-x: auto;">
                <div class="row">
                    <div class="col-xs-9" style="text-align: right; padding: 6px 12px;">
                        <div class="row">
                            <div class="col-xs-1" style="height: 20px;padding-right: 0px;padding-left:0px;width: 28px;">
                                <input type="checkbox" style="width: 14px; height: 14px;" id='param_deskripsi'>
                            </div>
                            <div class="col-xs-10" style="height: 20px;padding-left:10px;overflow: hidden;">
                                <div style="height: 100%; display: table;">
                                    <span style="height: 100%;display: table-cell; vertical-align: middle; white-space: nowrap;" onclick="this.parentNode.parentNode.parentNode.getElementsByTagName('input')[0].checked ? this.parentNode.parentNode.parentNode.getElementsByTagName('input')[0].checked = false : this.parentNode.parentNode.parentNode.getElementsByTagName('input')[0].checked = true; this.parentNode.parentNode.parentNode.getElementsByTagName('input')[0].checked ? window.masukkan_deskripsi = true : window.masukkan_deskripsi = false;">Masukkan deskripsi sebagai nama rincian mata anggaran</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
                    </div>      
                </div>
            </div>
        </div>
    </div>
</div>