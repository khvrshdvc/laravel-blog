@if ($paginator->hasPages())
<nav class="pagination-nav">

    @if ($paginator->onFirstPage())
        <span class="page-btn disabled">&larr; Oldingi</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="page-btn">&larr; Oldingi</a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="page-dots">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="page-btn active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="page-btn">Keyingi &rarr;</a>
    @else
        <span class="page-btn disabled">Keyingi &rarr;</span>
    @endif

</nav>
@endif