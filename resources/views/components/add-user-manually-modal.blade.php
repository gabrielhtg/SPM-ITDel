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
                            <option value="3">Ketua SPPM</option>
                            <option value="4">Anggota SPPM</option>
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
