@props(['name' => '', 'label' => '', 'required' => false, 'id' => '', 'error' => false])
<div {{ $attributes->merge(['class' => 'position-relative mb-2']) }} id="{{ $id }}">
    <label class="form-label">{{ $label }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <input type="text" class="form-control {{ $error ? 'is-invalid' : '' }}" wire:model="{{ $name }}"
        data-provide="datepicker" placeholder="DD/MM/YYYY" data-date-container="#{{ $id }}" autocomplete="off"
        data-date-autoclose="true" data-date-today-highlight="true" data-date-format="dd-mm-yyyy"
        onchange="this.dispatchEvent(new InputEvent('input'))">

    <div class="invalid-tooltip">
        {{ $error }}
    </div>
</div>
