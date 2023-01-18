@props(['name' => '', 'label' => '', 'required' => false, 'id' => '', 'error' => false])
<div {{ $attributes->merge(['class' => '']) }}>
    <label class="form-label">{{ $label }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <input id="{{ $id }}" type="text" class="form-control {{ $error ? 'is-invalid' : '' }}"
        wire:model="{{ $name }}" data-provide="{{ $id }}">
    <div class="invalid-tooltip">
        {{ $error }}
    </div>
</div>
