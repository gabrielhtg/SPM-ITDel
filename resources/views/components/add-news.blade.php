<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-news">
    <i class="fas fa-plus"></i><span style="margin-left: 5px">Add News</span>
</button>

<div class="modal fade" id="modal-news">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New News</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-addNews" method="POST" action="{{ route('newsadd') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- input title --}}
                    <div class="form-group mt-1">
                        <label for="title">Judul Berita</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    {{-- input konten --}}
                    <label for="description">Keterangan Berita</label>
                    <textarea class="summernote" name="description" required></textarea>

                    {{-- input gambar latar belakang --}}
                    <div class="form-group">
                        <label for="exampleInputFile">Gambar Berita</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="bgimage" name="bgimage" required>
                                <label class="custom-file-label" for="bgimage">Choose file</label>
                            </div>
                        </div>
                    </div>

                    {{-- input time --}}
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="datetime-local" name="start_date" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal Berakhir</label>
                        <input type="datetime-local" name="end_date" class="form-control" placeholder="Pilih tanggal dan waktu">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-addNews" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    document.getElementById('bgimage').addEventListener('change', function(e) {
        var fileName = document.getElementById('bgimage').files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>