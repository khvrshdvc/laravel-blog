<nav class="bar container">
    <a href="/" class="brand">trying<span class="cursor"></span></a>

    <div class="nav-links">
        <a href="/" class="active">Main</a>
        <a href="{{ route('posts.index') }}">Blog</a>
        <a href="{{ route('contact') }}">Contact</a>

        @auth
            <a href="{{ route('posts.create') }}">Post Create</a>

            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">Log Out</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="login-btn">Login</a>
        @endauth
    </div>

    @auth
        <div class="admin-user">
            <span>{{ auth()->user()->name }}</span>
            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>
    @endauth
</nav>
