@props(['error' => false, 'name' => '', 'label' => '', 'options' => [], 'required' => false, 'disabled' => false])

<div {{ $attributes->merge(['class'=>'mb-0']) }} >
    <label for="{{ $name }}" class="form-label">{{ $label }} <span
            class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <select class="form-select  {{ $error ? 'is-invalid' : '' }}" wire:model="{{ $name }}" 
        id="{{ $name }}" {{ $disabled ? 'disabled' : ''}}>
        <option value="">Seleccionar..</option>
        @foreach ($options as $value => $label)
            <option value="{{ $value }}">{{ strtoupper($label) }}</option>
        @endforeach
    </select>
    <p class="text-danger mb-0">
        {{ $error }}
    </p>
</div>
