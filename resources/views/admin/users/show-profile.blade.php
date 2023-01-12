<x-admin-master>
    @section('content')

        <h3>User Profile for: {{ $user->name }}</h3>

        <hr>

        @if(\Illuminate\Support\Facades\Session::has('profile-updated'))

            <div class="alert alert-primary">{{ \Illuminate\Support\Facades\Session::get('profile-updated') }}</div>
        @endif
        <div class="row">
            <div class="col-sm-6">
                <form action="{{ route('user.update',$user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="d-flex justify-content-center align-content-center mb-4">
                        <div class="form-group">
                            <img width="200px" class="img-profile rounded-circle"
                                 src="{{ asset('storage/' .$user->avatar) }}">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="form-group">
                            <input type="file" name="avatar" class="form-control-file">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                               value="{{ $user->username }}" name="username">
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" value="{{ $user->name }}" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password Confirm</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <button type="submit" class="mb-4 btn btn-primary">Update Profile</button>
                </form>
            </div>

            @if(auth()->user()->userHasRole('admin'))
                <hr>
                <div class="col-sm-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">Roles List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-check"></i></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>
                                                <input
                                                    type="checkbox"
                                                    @foreach($user->roles as $user_role)
                                                        @if($user_role->slug == $role->slug)
                                                            checked
                                                    @endif
                                                    @endforeach>
                                            </td>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->slug }}</td>
                                            <td>
                                                <form action="{{ route('attach-role-user',$user->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="user_role" value="{{ $role->id }}">
                                                    <button
                                                        class="btn btn-primary"
                                                        @if($user->roles->contains($role))
                                                            disabled
                                                        @endif
                                                        >Attach
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('detach-role-user',$user->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="user_role" value="{{ $role->id }}">
                                                    <button class="btn btn-danger"
                                                    @if(!$user->roles->contains($role))
                                                            disabled
                                                        @endif
                                                        >Detach</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th><i class="fa fa-check"></i></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        </div>

    @endsection
    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        {{--       <script src="{{asset('js/demo/datatables-demo.js')}}"></script>--}}
    @endsection
</x-admin-master>
