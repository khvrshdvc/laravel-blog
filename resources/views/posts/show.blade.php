<x-layout title="Post">
    <div class="hero-post-image">
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
        <div class="hero-post-overlay">
            <div class="post-meta">
                <span>{{ $post->created_at->diffForHumans() }} </span>
                <span class="tag">{{ $post->type_body }}</span>
            </div>
            <h1>{{ $post->title }}</h1>
        </div>
    </div>

    <main>
        <article class="hero-post-body">
            <a href="{{ route('posts.index') }}" class="back-link">&larr; cd ../posts</a>
            @auth
                <div class="post-actions">
                    @canany(['update', 'delet'], $post) 
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn-edit">
                        Tahrirlash
                    </a>
                    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST"
                        onsubmit="return confirm('Postni o\'chirishga ishonchingiz komilmi?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">O'chirish</button>
                    </form>
                </div>
                @endcanany
            @endauth

            <div class="post-content">
                <p>{{ $post->body }}</p>
            </div>
            <div class="post-footer">
            </div>
        </article>
    </main>
    <section class="comments-section">

        <div class="section-label">// Izohlar ({{ $post->comments()->count() }})</div>
        @auth

            @foreach ($post->comments as $comment)
                <div class="comments-list">
                    <div class="comment-card">
                        <div class="comment-avatar">{{ strtoupper(substr($comment->user->name, 0, 1)) }}</div>
                        <div class="comment-body">
                            <div class="comment-head">
                                <span class="comment-author">{{ $comment->user->name }}</span>
                                <span class="comment-date">{{ $comment->created_at->format('M d') }}</span>
                            </div>
                            <p class="comment-text">
                                {{ $comment->body }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

            <form action="{{ route('comments.store') }}" method="POST" class="comment-form">
                @csrf

                <div class="form-group">
                    <label for="comment_body">Izoh</label>

                    <textarea id="comment_body" name="body" placeholder="Fikringizni yozing..." required></textarea>
                </div>
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <button type="submit" value="yuborish" class="btn btn-post">
                    Izoh qoldirish
                </button>
            </form>
            <div class="post-footer">
                <a href="{{ route('posts.index') }}" class="btn-outline">Barcha postlarga qaytish</a>
            </div>
        @else
            <div class="comment-login-box">
                <div class="comment-login-icon"> &gt;_ </div>
                <div class="comment-login-content">
                    <h3>Izoh qoldirmoqchimisiz?</h3>
                    <p> Izoh yozish uchun avval hisobingizga kirishingiz kerak. </p>
                    <div class="comment-login-actions"> <a href="{{ route('login') }}" class="btn btn-post"> Kirish </a>
                        <a href="{{ route('register') }}" class="btn-outline"> Ro'yxatdan o'tish </a>
                    </div>
                </div>
            </div>

        @endauth

    </section>
</x-layout>
