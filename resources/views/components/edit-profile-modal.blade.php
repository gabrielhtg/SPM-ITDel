<button type="button" class="btn btn-primary" style="width: 180px" data-toggle="modal" data-target="#modal-success1">
    <span style="margin-left: 5px"><b>Edit Profile</b></span>
</button>

<div class="modal fade" id="modal-success1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-register" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Username" required autofocus autocomplete="name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mt-3">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Full name" value="{{ auth()->user()->name }}" required autofocus autocomplete="name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('edit') }}</span>

{{--                    <div class="input-group mt-3">--}}
{{--                        <input type="email" name="email" class="form-control" placeholder="Email" required autocomplete="username">--}}
{{--                        <div class="input-group-append">--}}
{{--                            <div class="input-group-text">--}}
{{--                                <span class="fas fa-envelope" style="font-size: 14px"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <span class="text-danger">{{ $errors->first('email') }}</span>--}}

{{--                    <div class="input-group mt-3">--}}
{{--                        <input type="password"--}}
{{--                               class="form-control"--}}
{{--                               name="password"--}}
{{--                               id="password"--}}
{{--                               placeholder="Password" required autocomplete="new-password">--}}
{{--                        <div class="input-group-append">--}}
{{--                            <div class="input-group-text">--}}
{{--                                <span class="fas fa-lock"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <span class="text-danger">{{ $errors->first('password') }}</span>--}}

{{--                    <div class="input-group mt-3">--}}
{{--                        <input type="password"--}}
{{--                               id="password_confirmation"--}}
{{--                               name="password_confirmation"--}}
{{--                               class="form-control"--}}
{{--                               placeholder="Retype password" required autocomplete="new-password">--}}
{{--                        <div class="input-group-append">--}}
{{--                            <div class="input-group-text">--}}
{{--                                <span class="fas fa-lock"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>--}}


                    <div class="input-group mt-3">
                        <select name="give_access_to[]" class="select2 form-control" multiple="multiple" data-placeholder="Role" style="width: 100%;">
                            @foreach($roles as $e)
                                <option value="{{ $e->id }}">{{ $e->role }}</option>
                            @endforeach
                            <option value="{{ 0 }}">All</option>
                        </select>
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
