<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-introduction">
    <i class="fas fa-plus"></i><span style="margin-left: 5px">Add Introduction</span>
</button>

<div class="modal fade" id="modal-introduction">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Introduction</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-addIntroduction" method="POST" action="{{ route('dashboard-introduction-add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-1">
                        <label for="title">Judul Introduction</label>
                        <input type="text" name="juduldashboard" id="juduldashboard" class="form-control" required>
                    </div>

                    <label for="summernote">Keterangan Introduction</label>
                    <textarea class="summernote" name="keterangandashboard"></textarea>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-addIntroduction" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('file').addEventListener('change', function(e) {
        var fileName = document.getElementById('file').files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>