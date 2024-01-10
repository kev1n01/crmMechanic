@props(['id' => null, 'optionsModal' => '', 'title' => ''])

<div {{ $attributes->merge(['class' => 'modal fade']) }} id="{{ $id }}" tabindex="-1" wire:ignore.self
    aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog {{ $optionsModal }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" title="Cerrar" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {{ $body }}

            </div>
            <div class="modal-footer">

                {{ $footer }}

            </div>
        </div>
    </div>
</div>
