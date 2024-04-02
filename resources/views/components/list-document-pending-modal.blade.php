<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-list-register-pending">
    <span>Request Laporan</span>
</button>

<div class="modal fade" id="modal-list-register-pending">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Daftar Tindakan yang Tertunda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Dokumen</th>
                            <th>Periode</th>
                            <th>Tipe Laporan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="user-panel d-flex">
                                    <div class="info">
                                        <span class="d-block"> Miko </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-panel d-flex">
                                    <div class="info">
                                        <span class="d-block">Periode</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                Laporan Kerja
                            </td>
                            <td>
                                Waiting
                            </td>
                            <td>
                                <div class="d-flex" style="gap: 5px">
                                    <button type="button" class="btn btn-success"><i class="fas fa-check" style="font-size: 14px"></i></button>
                                    <button type="button" class="btn btn-success"><i class="far fa-eye" style="font-size: 14px"></i></button>
                                    <button type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">Tidak ada permintaan tindakan yang tertunda.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
