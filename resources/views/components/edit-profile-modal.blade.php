<button type="button" class="btn btn-primary" style="width: 180px" data-toggle="modal" data-target="#modal-success1">
    <span style="margin-left: 5px"><b>Edit Profile</b></span>
</button>

<div class="modal fade" id="modal-success1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-register" method="POST" action="{{ route('edit-profile') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="username" id="name" class="form-control" placeholder="Username" value="{{ auth()->user()->username }}" required autofocus autocomplete="name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mt-3">
                        <input type="text" name="name" class="form-control" placeholder="Full name" value="{{ auth()->user()->name }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mt-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ auth()->user()->email }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mt-3">
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ auth()->user()->phone }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mt-3">
                        <select name="roles[]" class="select2 form-control" multiple="multiple" data-placeholder="Role" style="width: 100%;" required>
                            @php
                                $array = explode(";", auth()->user()->role);
                                $i = 0;
                            @endphp

                            @foreach($roles as $e)
                                @if(in_array($e->id, $array))
                                    <option value="{{ $e->id }}" selected>{{ $e->role }}</option>
                                @else
                                    <option value="{{ $e->id }}">{{ $e->role }}</option>
                                @endif
                            @endforeach
                            <option value="{{ 0 }}">Public</option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-register" class="btn btn-primary"><i class="far fa-save mr-1"></i> Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
