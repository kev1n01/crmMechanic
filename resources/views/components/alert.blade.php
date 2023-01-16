@props(['dismissible' => false, 'type' => ''])
@if (session()->has($type))
    @php
        $typecolor = $type === 'success' ? 'success' : 'danger';
    @endphp
    <div {{ $attributes->merge(['class' => 'alert alert-' . $typecolor . ' alert-dismissible']) }} role="alert">

        {{ session($type) }}

        @if ($dismissible == true)
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
@endif
