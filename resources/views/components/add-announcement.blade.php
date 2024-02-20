<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-announcement">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Add Announcement</span>
</button>

<div class="modal fade" id="modal-announcement">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Announcement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-addAnnouncement" method="POST" action="{{ route('announcement.add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="title" id="title" class="form-control" placeholder="Judul" required autofocus autocomplete="title">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-heading"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-group mt-3">
                        <textarea name="content" id="content" cols="10" rows="4" class="form-control" placeholder="Konten" required autofocus autocomplete="content"></textarea>
                        <div class="input-group-append">
                            <div class="input-group-text"> 
                                <span class="fas fa-newspaper"></span>
                            </div>
                        </div>
                    </div>
                
                    <div class="input-group mt-3">
                        <div class="custom-file">
                            <input name="file" id="file" type="file" class="custom-file-input">
                            <label class="custom-file-label" for="file">Pilih file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Unggah</span>
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