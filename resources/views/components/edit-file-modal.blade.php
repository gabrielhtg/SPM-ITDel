    <!-- Modal Edit Document -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit-document-{{ $e->id }}" data-document-id="{{ $e->id }}"><i class="fas fa-edit"></i></button>
<div class="modal fade" id="modal-edit-document-{{ $e->id }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit-document-{{ $e->id }}" enctype="multipart/form-data" method="POST" action="{{ route('updateDocument', ['id' => $e->id]) }}">
                    @csrf
                    @method('POST')

                    <div class="input-group">
                        <input type="text" name="name" placeholder="Title" class="form-control" required value=" {{ $e->name}}">
                    </div>

                    <div class="input-group mt-3">
                        <select name="status" class="form-control" required>
                            <option value="" disabled>Select Status</option>
                            <option value="Berlaku" {{ $e->status === 'berlaku' ? 'selected' : '' }}>Berlaku</option>
                            <option value="Tidak Berlaku" {{ $e->status === 'tidak berlaku' ? 'selected' : '' }}>Tidak Berlaku</option>
                        </select>
                    </div>


                    <div class="input-group mt-3">
                        <input type="text" name="nomor_dokumen" placeholder="Document Number" class="form-control" required  value="{{$e->nomor_dokumen}}">
                    </div>
                    <div class="input-group mt-3">
                    <input type="number" name="year" placeholder="Year" class="form-control" required min="1" value="{{ $e->year }}">

                    </div>

                    <div class="input-group mt-3">
                        <select name="tipe_dokumen" class="form-control" required>
                            <option value="{{$e->tipe_dokumen}}" selected>{{ $e->tipe_dokumen }}</option>
                            <option value="Peraturan Pemerintah">Peraturan Pemerintah</option>
                            <option value="Statuta IT Del">Statuta IT Del</option>
                            <option value="Rencana Induk Pengembangan IT Del">Rencana Induk Pengembangan IT Del</option>
                            <option value="Rencana Strategis IT Del">Rencana Strategis IT Del</option>
                            <option value="Rencana Operasional IT Del">Rencana Operasional IT Del</option>
                            <option value="Kebijakan Rektor IT Del">Kebijakan Rektor IT Del</option>
                            <option value="Kebijakan SPMI">Kebijakan SPMI</option>
                            <option value="Standar SPMI">Standar SPMI</option>
                            <option value="Manual SPMI">Manual SPMI</option>
                            <option value="Formulir SPMI">Formulir SPMI</option>
                            <option value="SOP">SOP</option>
                            <option value="Instruksi Kerja">Instruksi Kerja</option>
                            <option value="Artefak AMI">Artefak AMI</option>
                            <option value="Laporan RTM">Laporan RTM</option>
                            <option value="Laporan Evaluasi Kepuasan">Laporan Evaluasi Kepuasan</option>
                            <option value="Laporan Berkala">Laporan Berkala</option>
                            <option value="Rencana Strategis Fakultas">Rencana Strategis Fakultas</option>
                            <option value="Rencana Operasional Fakultas">Rencana Operasional Fakultas</option>
                            <option value="Kebijakan Dekan">Kebijakan Dekan</option>
                            <option value="Dokumen Lainnya">Dokumen Lainnya</option>
                        </select>
                    </div>

                    @php
    $selectedRoles = [];
    foreach($accessor as $acc) {
        if($acc == 0) {
            $selectedRoles[] = '0'; // '0' digunakan untuk nilai "All"
        } else {
            $selectedRoles[] = \App\Models\RoleModel::find($acc)->id;
        }
    }
@endphp

<div class="input-group mt-3">
    <select name="give_access_to[]" class="select2 form-control" multiple="multiple" data-placeholder="Give Access to" style="width: 100%;">
        @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ in_array($role->id, $selectedRoles) ? 'selected' : '' }}>{{ $role->role }}</option>
        @endforeach
        <option value="0" {{ in_array('0', $selectedRoles) ? 'selected' : '' }}>All</option>
    </select>
</div>

                    <div class="input-group mt-3">
                        <label for="expried_date">Valid Since:</label>
                    </div>
                    <div class="input-group">
                        <input type="date" id="expried_date" name="expried_date" class="form-control" required value="{{ $e->expried_date }}">
                    </div>
                    <div class="input-group mt-3">
                        <input type="file" name="file" value="{{ $e->filename }}">
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-edit-document-{{ $e->id }}" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
