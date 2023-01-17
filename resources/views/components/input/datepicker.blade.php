@props(['name' => '', 'label' => '', 'required' => false])
<div {{ $attributes->merge(['class' => 'position-relative mb-2']) }} id="datepicker1">
    <label class="form-label">{{ $label }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <input type="text" class="form-control" wire:model="{{ $name }}" data-provide="datepicker"
        placeholder="DD/MM/YYYY"
        data-date-container="#datepicker1" autocomplete="off" data-date-autoclose="true" data-date-today-highlight="true"
        data-date-format="dd-mm-yyyy" onchange="this.dispatchEvent(new InputEvent('input'))">
</div>