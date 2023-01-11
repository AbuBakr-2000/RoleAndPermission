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
                        <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ $user->username }}" name="username" >
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
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>

    @endsection
</x-admin-master>
