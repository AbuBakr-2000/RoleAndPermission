<x-admin-master>
    @section('content')

        <h1>Create a Post</h1>

        <form action="{{ route('postsAdmin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="">File</label>
                <input type="file" name="post_image" class="form-control-file">
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea class="form-control" name="body" rows="10" cols="30" placeholder="Body of the Post"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    @endsection
</x-admin-master>
