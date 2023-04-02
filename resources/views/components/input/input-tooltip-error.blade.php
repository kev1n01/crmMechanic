@props(['error' => false, 'name' => '', 'label' => '', 'type' => '', 'required' => false, 'disabled' => false, 'max' => '', 'accept' => ''])

<div {{ $attributes->merge(['class' => 'mb-0']) }}>
    <label class="form-label" for="{{ $name }}">{{ $label }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <input type="{{ $type }}" class="form-control {{ $error ? 'is-invalid' : '' }}" id="{{ $name }}"
        placeholder="{{ $label }}" wire:model="{{ $name }}" {{ $disabled ? 'disabled' : '' }}
        maxlength="{{ $max }}" min="{{ $max }}" size="{{ $max }}" accept="{{ $accept }}">

    @unless($error)
    @else
        <p class="text-danger mb-0">
            {{ $error }}
        </p>
        @endif

    </div>
