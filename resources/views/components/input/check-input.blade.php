@props(['name' => '', 'checked' => null])

<div class="form-checkbox">
    <input type="checkbox" {{ $attributes->merge(['class' => 'form-check-input border border-secondary']) }}
        {{ $checked }} id="{{ $name }}" wire:model="{{ $name }}" />
    <label class="form-check-label" for="{{ $name }}">&nbsp;</label>
</div>
