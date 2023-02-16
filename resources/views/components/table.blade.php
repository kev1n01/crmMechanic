@props(['footer' => ''])
<table {{ $attributes->merge(['class' => 'table']) }}>
    <thead class="table-dark">
        <tr>
            {{ $head }}
        </tr>
    </thead>

    <tbody>
        {{ $body }}
    </tbody>

    @unless($footer)
        
    @else
        <tfoot>
            {{ $foot }}
        </tfoot>
    @endif
</table>
