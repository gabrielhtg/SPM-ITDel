@php use App\Services\AllServices; @endphp
<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-list-register-pending">
    <span>Request Laporan</span>
    @if(($banyakData != 0))
        <span class="badge badge-primary" style="margin-left: 5px">{{ $banyakData }}</span>
    @endif
</button>

<!-- Modal -->
<div class="modal fade" id="modal-list-register-pending" tabindex="-1" aria-labelledby="modal-list-register-pendingLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Daftar Tindakan yang Tertunda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Dokumen</th>   
                            <th>Jenis Laporan</th>
                            <th>Pengirim</th>
                            <th>Revisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporan as $lap)
                        @if(($lap->status === 'Menunggu') && (app(AllServices::class)->isAccountableToRoleLaporan(auth()->user()->role, app(AllServices::class)->getUserRoleById($lap->created_by)))))
                        <tr>
                            <td>
                                <div class="user-panel d-flex">
                                    <div class="info">
                                        <span class="d-block">{{ $lap->nama_laporan }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ \App\Services\AllServices::JenislaporanName($lap->id_tipelaporan) }}
                            </td>
                            <td>
                                <div class="user-panel d-flex">
                                    <div class="info">
                                        <?php
                                            $user = \App\Models\User::find($lap->created_by);
                                            $name = $user->name;
                                            $role = \App\Services\AllServices::convertRole($user->role);
                                            
                                            // Menggunakan substring untuk memotong nama menjadi bagian-bagian yang lebih pendek
                                            while(strlen($name) > 30) {
                                                echo "<span>" . substr($name, 0, 30) . "</span><br>";
                                                $name = substr($name, 30);
                                            }
                                            echo "<span>$name</span>";
                                            
                                            // Menampilkan peran (role) dengan badge
                                            echo "<span class='badge badge-success' style='margin-left: 5px'>$role</span>";
                                        ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-panel d-flex">
                                    <div class="d-flex align-items-center">
                                        @php
                                        if($lap->revisi == 1) {
                                            $allServices = new \App\Services\AllServices();
                                            $namaLaporan = $allServices->getNamaLaporanById($lap->cek_revisi);
                                            echo $namaLaporan;
                                        }
                                        else if($lap->revisi == 0){
                                            echo "Tidak";
                                        }
                                        @endphp
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex" style="gap: 5px">
                                    <!-- Form for approving -->
                                    <a href="{{ $lap->directory ? asset($lap->directory) : '#' }}" target="_blank" class="btn btn-success">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <form action="{{ route('laporan.approve', ['id' => $lap->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success" >
                                            <i class="fas fa-check" style="font-size: 14px;"></i>
                                        </button>
                                    </form>

                                    <!-- Button to trigger comment modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#commentModal{{ $lap->id }}">
                                        <i class="fas fa-times" style="font-size: 14px;"></i>
                                    </button>

                                    <!-- Comment Modal -->
                                    <div class="modal fade" id="commentModal{{ $lap->id }}" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Konfirmasi Penolakan</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('laporan.reject', ['id' => $lap->id]) }}" method="POST" id="rejectForm{{ $lap->id }}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="commentContent{{ $lap->id }}">Isi Komentar</label>
                                                            <textarea class="form-control" id="commentContent{{ $lap->id }}" name="komentar" rows="3" placeholder="Tulis komentar Anda di sini..." required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="document-file{{ $lap->id }}">Tambahkan File</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" name="file" class="custom-file-input" id="document-file{{ $lap->id }}" onchange="displayFileName{{ $lap->id }}()" >
                                                                    <label class="custom-file-label" for="document-file{{ $lap->id }}" id="file-label{{ $lap->id }}">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary" >Kirim</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <script>
                                        function displayFileName{{ $lap->id }}() {
                                            // Mendapatkan input file
                                            var input = document.getElementById('document-file{{ $lap->id }}');
                                            // Mendapatkan label
                                            var label = document.getElementById('file-label{{ $lap->id }}');
                                            // Mendapatkan nama file yang dipilih
                                            var fileName = input.files[0].name;
                                            // Menampilkan nama file dalam label
                                            label.innerHTML = fileName;
                                        }
                                    </script>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Penolakan -->
<div class="modal fade" id="rejectConfirmationModal" tabindex="-1" aria-labelledby="rejectConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-black">
                <h5 class="modal-title" id="rejectConfirmationModalLabel">Konfirmasi Penolakan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menolak laporan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-danger" onclick="submitRejectForm()">Ya</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitRejectForm() {
        var id = $('#rejectConfirmationModal').data('lap-id');
        $('#rejectForm' + id).submit();
    }
</script>

