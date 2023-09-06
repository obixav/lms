
@if ($paginator->hasPages())
    @if(isset($display)&&$display=='info')
        Showing {{$paginator->firstItem()}} - {{$paginator->lastItem()}} of {{$paginator->total()}} Results
    @else

        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())

                <li class="page-item disabled ">

                    <span class="page-link"><em class="icon ni ni-chevrons-left"></em>Prev</span>
                </li>
            @else

                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <em class="icon ni ni-chevrons-left"></em><span >Prev</span></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link page-link-next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <span  aria-hidden="true"> Next <em class="icon ni ni-chevrons-right"></em></span>  </a>
                </li>
            @else

                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">Next<em class="icon ni ni-chevrons-right"></em></span>
                </li>
            @endif
        </ul>

    @endif
@endif
