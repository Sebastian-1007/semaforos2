<div class="pagination">
    @if ($paginator->onFirstPage())
        <span class="page-btn" disabled><i class="fas fa-angle-left"></i></span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="page-btn"><i class="fas fa-angle-left"></i></a>
    @endif

    @foreach ($elements as $element)
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
        <a href="{{ $paginator->nextPageUrl() }}" class="page-btn"><i class="fas fa-angle-right"></i></a>
    @else
        <span class="page-btn" disabled><i class="fas fa-angle-right"></i></span>
    @endif
</div>