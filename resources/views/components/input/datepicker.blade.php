@props(['label' => '', 'name' => ''])
<div {{ $attributes->merge(['class' => 'position-relative']) }} id="datepicker1">
    <label class="form-label">{{ $label }}</label>
    <input type="text" class="form-control" data-provide="datepicker" data-date-container="#datepicker1"
        wire:model="{{ $name }}">
</div>
