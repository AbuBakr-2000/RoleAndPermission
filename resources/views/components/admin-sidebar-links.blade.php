<li class="nav-item">
    <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
       aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Posts</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('postsAdmin.create') }}">Create a Post</a>
            <a class="collapse-item" href="{{ route('postsAdmin.index') }}">View all Posts</a>
        </div>
    </div>
</li>

@if(auth()->user()->userHasRole('Admin'))

<li class="nav-item">
    <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true"
       aria-controls="collapseTwo">
        <i class="fas fa-fw fa-users"></i>
        <span>Users</span>
    </a>
    <div id="collapseUsers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('users.create') }}">Create a User</a>
            <a class="collapse-item" href="{{ route('users.index') }}">View all Users</a>
        </div>
    </div>
</li>
@endif
