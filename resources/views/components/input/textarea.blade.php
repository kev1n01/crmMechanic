@props(['name' => '', 'label' => ''])
<div {{ $attributes->merge(['class' => 'form-group mb-2']) }}>
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea class="form-control mt-1" id="{{ $name }}" wire:model="{{ $name }}" rows="1"></textarea>
</div>
