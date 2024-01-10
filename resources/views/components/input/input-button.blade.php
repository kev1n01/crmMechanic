@props([
    'error' => false,
    'name' => '',
    'label' => '',
    'required' => false,
    'disabled' => false,
    'max' => '',
    'accept' => '',
    'fnbtn' => '',
    'iconbtn' => '',
    'title' => '',
])
<div>
    <label class="form-label mb-0" for="{{ $name }}">{{ $label }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <div {{ $attributes->merge(['class' => 'input-group']) }}>
        <input type="text" class="form-control" placeholder="{{ $label }}" wire:model="{{ $name }}"
            {{ $disabled ? 'disabled' : '' }} maxlength="{{ $max }}" min="{{ $max }}"
            size="{{ $max }}" accept="{{ $accept }}" />
        <div class="input-group-append">
            <button class="btn btn-primary rounded btn-sm" title="{{ $title }}" wire:click.prevent="{{ $fnbtn }}" type="button"
                {{ $disabled ? 'disabled' : '' }}><i class="{{ $iconbtn }}"></i></button>
        </div>

    </div>
    @unless ($error)
    @else
        <p class="text-danger mb-0">
            {{ $error }}
        </p>
        @endif
    </div>
