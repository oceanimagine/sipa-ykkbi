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
                            <th style="white-space: nowrap;">Nama</th>
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
            <div class="modal-footer" style="height: 10vh; padding: 20px;">
                <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>