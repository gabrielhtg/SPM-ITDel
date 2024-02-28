<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-list-invited-user">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Add From Excel File</span>
</button>

<div class="modal fade" id="modal-list-invited-user">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">List Invited User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <span> If you still don't have the template, download it <a
                        href="{{ asset('src/template/allowed_user_template.xlsx') }}">here</a>.</span>

                <p class="mt-3">Upload the email list below</p>
                <div class="input-group">
                    <div class="custom-file">
                        <form id="form-upload" action="{{ route('uploadListAllowedUser') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="file-excel" required>
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </form>
                    </div>
                    <div class="input-group-append">
                        <button type="submit" form="form-upload" class="input-group-text">Upload</button>
                    </div>

                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
