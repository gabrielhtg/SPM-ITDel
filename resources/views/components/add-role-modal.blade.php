<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-role">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Add Role</span>
</button>

<div class="modal fade" id="modal-role">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-add-role" action="{{route('addRole')}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama-role">Nama Role</label>
                        <input type="text" class="form-control" placeholder="Ketik disini" id="nama-role" name="nama_role"
                               required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="atasan-role">Atasan</label>
                        <select id="atasan-role" name="atasan_role" class="atasan-role-custom form-control"
                                style="width: 100%">
                            <option></option>
                            @foreach($roles as $e)
                                @if($e->role !== "Admin")
                                    <option value="{{ $e->id }}">{{ $e->role }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="accountable-to">Accountable To</label>
                        <select id="accountable-to" name="accountable_to[]" multiple="multiple"
                                class="accountable-to-custom form-control" style="width: 100%">
                            <option></option>
                            @foreach($roles as $e)
                                @if($e->role !== "Admin")
                                    <option value="{{ $e->id }}">{{ $e->role }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="responsible-to">Responsible To</label>
                        <select id="responsible-to" name="responsible_to[]" multiple="multiple"
                                class="responsible-to-custom form-control" style="width: 100%">
                            <option></option>
                            @foreach($roles as $e)
                                @if($e->role !== "Admin")
                                    <option value="{{ $e->id }}">{{ $e->role }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="informable-to">Inform To</label>
                        <select id="informable-to" name="informable_to[]" class="informable-to-custom form-control"
                                multiple="multiple" style="width: 100%">
                            <option></option>
                            @foreach($roles as $e)
                                @if($e->role !== "Admin")
                                    <option value="{{ $e->id }}">{{ $e->role }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="is_admin">Punya Akses Admin</label>
                        <select id="is_admin" name="is_admin" class="atasan-role-custom form-control"
                                style="width: 100%">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="wajib-melaporkan">Wajib Melaporkan</label>
                        <select id="wajib-melaporkan" name="wajib_melaporkan[]" class="laporkan-custom form-control"
                                multiple="multiple" style="width: 100%">
                            <option></option>
                            @foreach($tipe_dokumen as $e)
                                <option value="{{ $e->id }}">{{ $e->nama_laporan }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="form-add-role">Tambah</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
