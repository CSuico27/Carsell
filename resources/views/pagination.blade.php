<?php
    /** @var $paginator \Illuminate\Pagination\LengthAwarePaginator */
?>
@if ($paginator->hasPages())
<nav class="flex justify-center items-center mt-8 gap-2">
    @if ($paginator->onfirstPage())
        <span class="pagination-disabled"><i class="fa-solid fa-chevron-left"></i></span>
    @else
        <a class="pagination" href="{{$paginator->previousPageUrl()}}"><i class="fa-solid fa-chevron-left"></i></a>
    @endif

    <ul class="hidden md:flex gap-2">
        @foreach ($elements as $element)
            @if(is_string($element))
                <span class="pagination">{{$element}}</span>
            @endif

            @if(is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-focus">{{$page}}</span>
                    @else
                        <a class="pagination" href="{{$url}}">{{$page}}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>

    @if ($paginator->hasMorePages())
        <ul class="pagination">
            <a href="{{$paginator->nextPageUrl()}}"><i class="fa-solid fa-chevron-right"></i></a>
        </ul>
    @else
        <ul class="pagination-disabled">
            <span><i class="fa-solid fa-chevron-right"></i></span>
        </ul>
    @endif
</nav>
@endif