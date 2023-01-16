@props(['name' => '', 'checked' => null, 'typeSwitch' => 'bool'])
<div {{ $attributes }}>
    <input type="checkbox" id="{{ $name }}" {{ $checked }} data-switch="{{ $typeSwitch }}" wire:model="{{ $name }}"/>
    <label for="{{ $name }}" data-on-label="Si" data-off-label="No"></label>
</div>
