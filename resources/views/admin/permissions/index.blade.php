<x-admin-master>
    @section('content')

        @if(session()->has('permission-deleted'))
            <div class="alert alert-danger">
                {{ session('permission-deleted') }}
            </div>
            @elseif(session()->has('permission-updated'))
            <div class="alert alert-primary">
                {{ session('permission-updated') }}
            </div>
        @endif
        <div class="row">

            <div class="col-sm-3 ">
                <form action="{{ route('permissions.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Permission</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror mb-1">

                        <div>
                            @error('name')
                            <span><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Create a Permission</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-9 ">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">Permissions List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td><a href="{{ route('permissions.edit',$permission->id) }}">{{ $permission->name }}</a></td>
                                        <td>{{ $permission->slug }}</td>
                                        <td>
                                            <div class="w-100 d-flex">
                                                <div class="w-50">
                                                    <form action="{{ route('permissions.destroy',$permission->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                                    <div class="w-50">
                                                        <a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-info">Edit</a>
                                                    </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @section('scripts')
            <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

            <!-- Page level custom scripts -->
            {{--       <script src="{{asset('js/demo/datatables-demo.js')}}"></script>--}}
        @endsection
    @endsection
</x-admin-master>
