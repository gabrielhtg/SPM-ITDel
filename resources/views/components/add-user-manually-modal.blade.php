<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-success1">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Add User Manually</span>
</button>

<div class="modal fade" id="modal-success1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-register" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Full name" required autofocus autocomplete="name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('name') }}</span>

                    <div class="input-group mt-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required autocomplete="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope" style="font-size: 14px"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('email') }}</span>

                    <div class="input-group mt-3">
                        <input type="password"
                               class="form-control"
                               name="password"
                               id="password"
                               placeholder="Password" required autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('password') }}</span>

                    <div class="input-group mt-3">
                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="Retype password" required autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>

                    <div class="input-group mt-3">
                        <select class="form-control" name="role" id="role" required>
                            <option value="">-- Select Role --</option>
                            <option value="1">Rektor</option>
                            <option value="2">Wakil Rektor</option>
                            <option value="3">Dekan</option>
                            <option value="4">Ketua KJM</option>
                            <option value="5">Anggota GJM</option>
                            <option value="6">Member of BAA Fakultas</option>
                            <option value="7">Ketua Program Studi</option>
                            <option value="8">Ketua GKM</option>
                            <option value="9">Anggota GKM</option>
                            <option value="10">Direktur Pendidikan</option>
                            <option value="11">Member of BAA Institut</option>
                            <option value="12">Member of Lembaga Kemahasiswaan</option>
                            <option value="13">Member of Pusat Pembinaan Keasramaan</option>
                            <option value="14">Member of SDI</option>
                            <option value="15">Member of Divisi Infrastruktur</option>
                            <option value="16">Member of Keamanan dan QA</option>
                            <option value="17">Member of PPKHA</option>
                            <option value="18">Member of UPT PP ESTEM</option>
                            <option value="19">Member of UPT SAM</option>
                            <option value="20">Member of UPT Perpustakaan</option>
                            <option value="21">Member of UPT Bahasa</option>
                            <option value="22">Wakil Rektor 2</option>
                            <option value="23">Member of Pusat Perencanaan</option>
                            <option value="24">Member of PMM</option>
                            <option value="25">Member of Logistik</option>
                            <option value="26">Member of Keuangan</option>
                            <option value="27">Member of Biro Administrasi Umum</option>
                            <option value="28">Member of UPT Kantin</option>
                            <option value="29">Wakil Rektor 3</option>
                            <option value="30">Member of Kerjasama dan Humas</option>
                            <option value="31">Member of Kantor Urusan Internasional</option>
                            <option value="32">Member of Pusat Inovasi dan Kewirausahaan</option>
                            <option value="33">Member of KHDTK</option>
                            <option value="34">Ketua SPM</option>
                            <option value="35">Staf SPM</option>
                            <option value="36">Ketua SPI</option>
                            <option value="37">Staf SPI</option>
                            <option value="38">Ketua LPPM</option>
                            <option value="39">Staf LPPM</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-user-tag" style="font-size: 12px"></i>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-register" class="btn btn-primary">Add User</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
