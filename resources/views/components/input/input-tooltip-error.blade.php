@props(['error' => false, 'name' => '', 'label' => '', 'type' => '', 'required' => false])

<div {{ $attributes->merge(['class' => 'position-relative mb-2']) }}>
    <label class="form-label" for="{{ $name }}">{{ $label }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <input type="{{ $type }}" class="form-control {{ $error ? 'is-invalid' : '' }}" id="{{ $name }}"
        placeholder="{{ $label }}" wire:model="{{ $name }}">
        
    @unless ($error)
        
    @else
        <div class="invalid-tooltip">
            {{ $error }}
        </div>
    @endif
   
</div>
