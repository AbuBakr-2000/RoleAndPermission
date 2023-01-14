<x-admin-master>
    @section('content')
        <h4>Edit Role: {{$role->name}} </h4>
        <div class="row">

            <div class="col-sm-4 ">
                <form action="{{ route('roles.update',$role->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Role</label>
                        <input type="text" name="name" value="{{ $role->name }}"
                               class="form-control @error('name') is-invalid @enderror mb-1">

                        <div>
                            @error('name')
                            <span><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Update a Role</button>
                    </div>
                </form>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12">

                @if($permissions->isNotEmpty())

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">Permissions List</h4>
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
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td>
                                                <input
                                                    type="checkbox"
                                                    @foreach($role->permissions as $role_permission)
                                                        @if($role_permission->slug == $permission->slug)
                                                            checked
                                                    @endif
                                                    @endforeach>
                                            </td>
                                            <td>{{ $permission->id }}</td>
                                            <td>
                                                <a href="{{ route('permissions.edit',$permission->id) }}">{{ $permission->name }}</a>
                                            </td>
                                            <td>{{ $permission->slug }}</td>
                                            <td>
                                                <form action="{{ route('attach-role-permission',$role->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="role_permission" value="{{ $permission->id }}">
                                                    <button type="submit" class="btn btn-primary"
                                                     @if($role->permissions->contains($permission))
                                                            disabled
                                                        @endif
                                                    >Attach</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('detach-role-permission',$role->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="role_permission" value="{{ $permission->id }}">
                                                    <button type="submit" class="btn btn-danger"
                                                     @if(!$role->permissions->contains($permission))
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

                @endif

            </div>
        </div>

    @endsection

</x-admin-master>
