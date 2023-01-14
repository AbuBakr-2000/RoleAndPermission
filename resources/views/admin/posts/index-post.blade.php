<x-admin-master>
    @section('content')


        @if(\Illuminate\Support\Facades\Session::has('post-deleted'))

            <div class="alert alert-danger">{{ \Illuminate\Support\Facades\Session::get('post-deleted') }}</div>

        @elseif(\Illuminate\Support\Facades\Session::has('post-created'))

            <div class="alert alert-primary">{{ \Illuminate\Support\Facades\Session::get('post-created') }}</div>

        @elseif(\Illuminate\Support\Facades\Session::has('post-updated'))

            <div class="alert alert-info">{{ \Illuminate\Support\Facades\Session::get('post-updated') }}</div>

        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Posts List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Body</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td><a href="{{ route('user.show',$post->user->id) }}">{{ $post->user->name }}</a></td>
                                <td><a href="{{ route('postsAdmin.edit',$post->id) }}">{{ $post->title }}</a></td>
                                <td>
                                    <img width="100px" src="{{asset('storage/' .$post->post_image)}}">
                                </td>
                                <td>{{ Str::limit($post->body,'50','...') }}</td>
                                <td>{{ $post->created_at->diffForHumans() }}</td>
                                <td>{{ $post->updated_at->diffForHumans() }}</td>
                                <td>
                                    @can('delete',$post)
                                        <form method="post" action="{{route('postsAdmin.destroy', $post->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Body</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="mx-auto">

                {{ $posts->links() }}
            </div>
        </div>

    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
{{--        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>--}}
    @endsection
</x-admin-master>
