@props(['name' => '', 'label' => '', 'error' => false, 'rows' => '1', 'required' => false])
<div {{ $attributes->merge(['class' => 'form-group mb-1']) }}>
    <label class="form-label" for="{{ $name }}">{{ $label }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <textarea class="form-control mt-1 {{ $error ? 'is-invalid' : '' }}" id="{{ $name }}"
        wire:model="{{ $name }}" rows="{{ $rows }}"></textarea>

    @unless ($error)
    @else
        <p class="text-danger mb-0">
            {{ $error }}
        </p>
        @endif
    </div>
