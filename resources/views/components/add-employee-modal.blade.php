<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success1">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Tambahkan Employee</span>
</button>

<div class="modal fade" id="modal-success1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Employee</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-register" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <div class="input-group">
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" placeholder="Alamat Email" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <div class="input-group">
                                <input type="text" name="phone" class="form-control" placeholder="Nomor Telepon" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <div class="input-group">
                                <input type="password" name="password_confirmation" class="form-control"
                                       placeholder="Ketik Ulang Kata Sandi" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        </div>
                    </div>

                    <div class="row mt-3 bg-white">
                        <div class="col">
                            <div class="input-group w-100">
                                <select name="role" class="form-control select2" style="width: 100%" required>
                                    <option></option>
                                    @foreach($roles as $e)
                                        @if($e->status)
                                            <option value="{{ $e->id }}">{{ $e->role }}</option>
                                        @endif
                                    @endforeach
                                </select>
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
