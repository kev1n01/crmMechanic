@props(['error', 'name' => '', 'label' => '', 'type' => '', 'required' => false])

<div {{ $attributes->merge(['class' => 'form-floating']) }}>
    <input type="{{ $type }}" class="form-control form-control-sm {{ $error ? 'is-invalid' : !$error && $name ?? 'is-valid' }}"
        id="{{ $name }}" placeholder="{{ $label }}" wire:model="{{ $name }}">
    <label for="{{ $name }}">{{ $label }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    @if ($error)
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
