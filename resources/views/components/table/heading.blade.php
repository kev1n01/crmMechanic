@props(['sortable' => '', 'direction' => ''])

<th {{ $attributes->merge(['class' => ''])->only('class') }} scope="col">
    @unless($sortable)
        <span>
            {{ $slot }}
        </span>
    @else
        <span>
            {{ $slot }}
        </span>
        <a href="javascript:void(0);" class="action-icon"{{ $attributes->except('class') }}>
            @if ($direction === 'asc')
                <span class="mdi mdi-sort-ascending mdi-18px"></span>
            @elseif ($direction === 'desc')
                <span class="mdi mdi-sort-descending mdi-18px"></span>
            @else
                <span class="mdi mdi-sort mdi-18px"></span>
            @endif
        </a>

    @endif

    </th>
