<x-layout title="Blog">
    <section class="page-header">
        <div class="prompt">ls ./posts</div>
        <h1>Barcha postlar</h1>
        <p>PHP, Laravel va backend haqidagi barcha yozuvlarim shu yerda to'plangan.</p>

        <div class="page-stats">
            <div class="page-stat">
                <span class="page-stat-num">{{ $totalPosts }}</span>
                <span class="page-stat-label">post</span>
            </div>
            <div class="page-stat">
                <span class="page-stat-num">{{ $totalTopics }}</span>
                <span class="page-stat-label">mavzu</span>
            </div>
            <div class="page-stat">
                <span class="page-stat-num">{{ $startYear }}</span>
                <span class="page-stat-label">boshlangan yil</span>
            </div>
        </div>

        <div class="filter-chips">
            <a href="{{ route('posts.index') }}" class="chip {{ !request('tag') ? 'chip-active' : '' }}">Barchasi</a>
            @foreach ($topics as $topic)
                <a href="{{ route('posts.index', ['tag' => $topic]) }}"
                    class="chip {{ request('tag') == $topic ? 'chip-active' : '' }}">
                    {{ $topic }}
                </a>
            @endforeach
        </div>
    </section>

    @foreach ($posts as $post)
        <article class="post-card">
            <div class="post-body">
                <div class="post-meta">
                    <span>{{ $post->created_at->format('d.m.Y') }}</span>
                    <span class="tag">{{ $post->type_body }}</span>
                </div>
                <h2><a href="post.html"></a>{{ $post->title }}</h2>
                <p>{{ $post->short_body }}</p>
                <a href="{{ route('posts.show', $post->id) }}" class="read-more">o'qish →</a>
            </div>
            <span class="post-id">#{{ $post->id }}</span>
            <img src="{{ asset('storage/' . $post->image) }}" alt="..." class="thumb-square">
        </article>
    @endforeach
    <div class="pagination-wrap">
        {{ $posts->links('vendor.pagination.custom') }}
    </div>

</x-layout>
