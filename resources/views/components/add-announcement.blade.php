<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-announcement">
    <i class="fas fa-share-alt"></i> <span style="margin-left: 5px">Add User via Link</span>
</button>

<div class="modal fade" id="modal-announcement">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Announcement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-addAnnouncement" method="POST" action="{{ route('announcement.add') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- input title --}}
                    <div class="form-group mt-1">
                        <label for="title">Judul Pengumuman</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    {{-- input konten --}}
                    <label for="summernote">Keterangan Pengumuman</label>
                    <textarea id="summernote" name="content"></textarea>

                    {{-- input file --}}
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file">
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-addAnnouncement" class="btn btn-primary">Add Announcement</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    document.getElementById('file').addEventListener('change', function(e) {
        var fileName = document.getElementById('file').files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>