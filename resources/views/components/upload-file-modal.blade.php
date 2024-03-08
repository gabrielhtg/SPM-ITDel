
            {{-- @php dd($jenis_dokumen);@endphp --}}
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-success1">
                <i class="fas fa-plus"></i> <span style="margin-left: 5px">Add Document</span>
            </button>

            <div class="modal fade" id="modal-success1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Upload Document</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-upload" enctype="multipart/form-data" method="POST" action="{{ route('uploadFile') }}">
                                @csrf

                                <div class="form-group">
                                    <label>Title:</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Status:</label>
                                    <select name="status" class="form-control" required>
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="Berlaku">Berlaku</option>
                                        <option value="Tidak Berlaku">Tidak Berlaku</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Document Number:</label>
                                    <input type="text" name="nomor_dokumen" class="form-control" required>
                                </div>
                                <label for="summernote">Description</label>
                                <textarea class="summernote" name="deskripsi"></textarea>
                                
                                <div class="form-group">
                                    <label>Menggantikan Dokumen:</label>
                                    <select name="menggantikan_dokumen[]" class="select2 form-control" multiple="multiple" data-placeholder="Search Document Type" style="width: 100%;">
                                        @foreach($documents as $type)
                                            @if($type->created_by == auth()->user()->id)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>                        
                                

                                <div class="form-group">
                                    <label>Year:</label>
                                    <input type="number" name="year" class="form-control" required min="1">
                                </div>

                                <div class="form-group">
                                    <label>Document Type:</label>
                                    <select id="tipe_dokumen"  name="tipe_dokumen" class="select2 form-control" multiple="multiple" data-placeholder="Search Document Type" style="width: 100%;">
                                        @foreach($jenis_dokumen as $type)
                                            <option value="{{ $type->jenis_dokumen }}">{{ $type->jenis_dokumen }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                
                                
                                

                                <div class="form-group">
                                    <label>Give Access to:</label>
                                    <select name="give_access_to[]" class="select2 form-control" multiple="multiple" data-placeholder="Give Access to" style="width: 100%;">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                        @endforeach
                                        <option value="0">All</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Can See By:</label>
                                    <select name="can_see_by" class="form-control" required>
                                        <option value="" disabled selected>Select Visibility</option>
                                        <option value="Public">Public</option>
                                        <option value="Private">Private</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Start Date:</label>
                                    <input type="datetime-local" name="start_date" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>End Date:</label>
                                    <input type="datetime-local" name="end_date" class="form-control" required>
                                </div>
                                
                                
                                
                                
                                

                                <div class="form-group">
                                    <label>Status:</label>
                                    <select name="keterangan_status" class="form-control" required>
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                

                                <div class="form-group">
                                    <label>File:</label>
                                    <input type="file" name="file" class="form-control-file" >
                                </div>
                                <div class="form-group">
                                    <label>Link Document:</label>
                                    <input type="text" name="link" class="form-control">
                                </div>
                                

                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" form="form-upload" class="btn btn-primary">Upload Document</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <script>
                flatpickr('input[name="start_date"]', {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                });
            
                flatpickr('input[name="end_date"]', {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                });
            </script>
            
            
            
            
            