
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
                        @php
                        
                        @endphp
                        @foreach($laporan as $lap)
                        @if(($lap->status ==='Menunggu')&&(app(AllServices::class)->isAccountableToRoleLaporan(auth()->user()->role,app(AllServices::class)->getUserRoleById($lap->created_by))) )
                        <tr>
                            <td>
                                <div class="user-panel d-flex">
                                    <div class="info">
                                        <span class="d-block"> {{$lap->nama_laporan}} </span>
                                      
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                {{ \App\Services\AllServices::JenislaporanName($lap->id_tipelaporan) }}
                            </td>
                            <td>
                                <div class="user-panel d-flex">
                                    <div class="info">
                                    <span> {{ \App\Models\User::find($lap->created_by)->name }} <span
                                            class="badge badge-success"
                                            style="margin-left: 5px">{{ \App\Services\AllServices::convertRole(\App\Models\User::find($lap->created_by)->role) }}</span></span>

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

                                    @include('components.komentar')
                                    
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

