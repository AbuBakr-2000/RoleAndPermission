<x-admin-master>
    @section('content')

        <h1>Post by: {{ $postsAdmin->user->name }}</h1>

        <form action="{{ route('postsAdmin.update', $postsAdmin->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" value="{{ $postsAdmin->title }}" name="title" class="form-control">
            </div>
            <div class="form-group">
                <div> <img height="100px" src="{{ asset('storage/'.$postsAdmin->post_image) }}"></div>
                <label for="">File</label>
                <input type="file" name="post_image" class="form-control-file">
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea class="form-control" name="body" rows="10" cols="30" placeholder="Body of the Post">{{ $postsAdmin->body }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update a Post</button>
        </form>
    @endsection
</x-admin-master>
