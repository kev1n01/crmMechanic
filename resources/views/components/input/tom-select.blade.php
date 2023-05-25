<div wire:ignore>
    <label for="{{ $attributes['id'] }}" class="form-label">{{ $attributes['label'] }} <span
            class="text-danger">{{ $attributes['required'] ? '*' : '' }}</span>
    </label>
    <select class="{{ $attributes['error'] ? 'is-invalid' : '' }}" x-data="{ tomSelect: null, options: @entangle($attributes['options']) }" x-init="tomSelect = new TomSelect($refs.select, {
        options: options,
        sortField: {
            field: 'text',
            direction: 'asc'
        },
        plugins: ['dropdown_input'],
        placeholder: '{{ $attributes['placeholder'] }}'
    })"
        x-ref="select" x-cloak {{ $attributes }}>
    </select>
    <p class="text-danger mb-0">
        {{ $attributes['error'] }}
    </p>
</div>
