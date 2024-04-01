<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-list-invited-user">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Tambahkan dari file Excel</span>
</button>

<div class="modal fade" id="modal-list-invited-user">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Daftar Pengguna yang Diizinkan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <span> Jika Anda masih belum memiliki templatenya, unduh di <a
                        href="{{ asset('src/template/allowed_user_template.xlsx') }}">sini</a>.</span>

                <p class="mt-3">Unggah daftar email di bawah ini</p>
                <div class="input-group">
                    <div class="custom-file">
                        <form id="form-upload" action="{{ route('uploadListAllowedUser') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="file-excel" required>
                            <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                        </form>
                    </div>
                    <div class="input-group-append">
                        <button type="submit" form="form-upload" class="input-group-text">Unggah</button>
                    </div>

                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
