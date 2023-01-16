@props(['name' => '', 'label' => '', 'type' => '', 'required' => false])
<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <label class="form-label" for="{{ $name }}">{{ $label }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <input type="{{ $type }}" class="form-control" id="{{ $name }}" placeholder="{{ $label }}"
        wire:model="{{ $name }}">

</div>
