<x-home-master>

    @section('content')

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="my-4">Page Heading
                <small>Secondary Text</small>
            </h1>

            @foreach($posts as $post)
                <div class="card mb-4">
                    <img class="card-img-top" src="{{asset('storage/' .$post->post_image)}}" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <p class="card-text">{{ Str::limit($post->body,'100','...') }}</p>
                        <a href="{{ route('posts.show',$post->id) }}" class="btn btn-primary">Read More
                            &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        {{ $post->created_at->diffForHumans() }}
                        <a href="#">{{ $post->user->name }}</a>
                    </div>
                </div>
            @endforeach
            <!-- Blog Post -->

            <!-- Pagination -->
            <ul class="pagination justify-content-center mb-4">
                <li class="page-item">
                    <a class="page-link" href="#">&larr; Older</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

    @endsection

</x-home-master>

