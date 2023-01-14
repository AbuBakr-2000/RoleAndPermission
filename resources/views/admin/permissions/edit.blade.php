<x-admin-master>
    @section('content')
        <h4>Edit Permission: {{$permission->name}} </h4>
        <div class="row">

            <div class="col-sm-4 ">
                <form action="{{ route('permissions.update',$permission->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Permission</label>
                        <input type="text" name="name" value="{{ $permission->name }}"
                               class="form-control @error('name') is-invalid @enderror mb-1">

                        <div>
                            @error('name')
                            <span><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Update a Permission</button>
                    </div>
                </form>
            </div>
            <hr>
        </div>

    @endsection

</x-admin-master>
