@props(['error' => false, 'name' => '', 'label' => '', 'options' => [], 'required' => false])

<div {{ $attributes->merge(['class'=>'position-relative']) }} >
    <label for="{{ $name }}" class="form-label">{{ $label }} <span
            class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <select class="form-select  {{ $error ? 'is-invalid' : '' }}" wire:model="{{ $name }}" 
        id="{{ $name }}" >
        <option value="">Seleccionar..</option>
        @foreach ($options as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
    <div class="invalid-tooltip">
        {{ $error }}
    </div>
</div>
