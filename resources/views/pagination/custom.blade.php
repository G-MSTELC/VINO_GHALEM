<ul class="pagination">
    @foreach ($elements as $element)
        {{-- Condition pour les liens --}}
        @if (is_string($element))
            <li class="disabled">{{ $element }}</li>
        @endif

        {{-- Condition pour les pages actives --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active">{{ $page }}</li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach
</ul>
