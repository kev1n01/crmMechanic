@props([
    'error' => false,
    'options' => '',
    'name' => '',
    'label' => '',
    'required' => false,
    'disabled' => false,
    'fnbtn' => '',
    'iconbtn' => '',
])
<div {{ $attributes->merge(['class' => '']) }}>
    <label class="form-label" for="{{ $name }}">{{ $label }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <div class="input-group mb-0">
        <select class="form-select custom-select {{ $error ? 'is-invalid' : '' }}" wire:model="{{ $name }}"
            id="{{ $name }}" {{ $disabled ? 'disabled' : '' }}>
            <option value="">Seleccionar..</option>
            @foreach ($options as $value => $label)
                <option value="{{ $value }}">{{ strtoupper($label) }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <button class="btn btn-primary rounded btn-md" wire:click.prevent="{{ $fnbtn }}" type="button"><i
                    class="{{ $iconbtn }}"></i></button>
        </div>
    </div>
    <div class="row" style="display: block">
        @unless ($error)
        @else
            <p class="text-danger mb-0">
                {{ $error }}
            </p>
            @endif
        </div>
    </div>
