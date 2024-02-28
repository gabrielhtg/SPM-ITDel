


<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-success1">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Add Document</span>
</button>

<div class="modal fade" id="modal-success1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload File</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-register" enctype="multipart/form-data" method="POST" action="{{ route('uploadFile') }}">
                    @csrf

                    <div class="input-group">
                        <input type="text" name="name" placeholder="Title" class="form-control" required>
                    </div>

                    <div class="input-group mt-3">
                        <select name="status" class="form-control" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="berlaku">Berlaku</option>
                            <option value="tidak berlaku">Tidak Berlaku</option>
                        </select>
                    </div>

                    <div class="input-group mt-3">
                        <input type="text" name="nomor_dokumen" placeholder="Document Number" class="form-control" required>
                    </div>
                    <div class="input-group mt-3">
                    <input type="number" name="year" placeholder="Year" class="form-control" required min="1" >

                    </div>

                    <div class="input-group mt-3">
                        <select name="tipe_dokumen" class="form-control" required>
                            <option value="" disabled selected>Select Document Type</option>
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

                    <div class="input-group mt-3">
                        <select name="give_access_to[]" class="select2 form-control" multiple="multiple" data-placeholder="Give Access to" style="width: 100%;">
                            @foreach($roles as $e)
                                <option value="{{ $e->id }}">{{ $e->role }}</option>
                            @endforeach
                            <option value="{{ 0 }}">All</option>
                        </select>
                    </div>

                    <div class="input-group mt-3">
                        <label for="end_date">Valid Since:</label>
                    </div>
                    <div class="input-group">
                        <input type="date" id="expried_date" name="expried_date" class="form-control" required>
                    </div>

                    <div class="input-group mt-3">
                        <input type="file" name="file">
                    </div>


                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-register" class="btn btn-primary">Upload Document</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



