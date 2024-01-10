@props(['error' => false, 'name' => '', 'label' => '', 'type' => '', 'required' => false, 'disabled' => false, 'max' => '', 'span' => ''])

<div {{ $attributes->merge(['class' => '']) }}>
    <label class="form-label" for="{{ $name }}">{{ $label }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <div class="input-group">
        <span class="input-group-text border border-primary" id="{{ $name }}">{{ $span }}</span>
        <input type="{{ $type }}" class="form-control {{ $error ? 'is-invalid' : '' }}" id="{{ $name }}"
            placeholder="{{ $label }}" wire:model="{{ $name }}" {{ $disabled ? 'disabled' : '' }}
            maxlength="{{ $max }}" min="{{ $max }}" size="{{ $max }}"
            aria-label="{{ $name }}" aria-describedby="{{ $name }}">
    </div>
</div>
