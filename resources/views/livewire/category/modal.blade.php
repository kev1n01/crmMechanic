<div>
    <x-form method="save">
        <x-modal-dialog :id="$idModal" title="{{ $nameModal }}">
            <x-slot name="body">

                <x-input.input-tooltip-error class="col-12" name="editing.name" label="Nombre de categoría" type="text"
                    :error="$errors->first('editing.name')" :required=true />

            </x-slot>

            <x-slot name="footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>

                <button type="submit" class="btn btn-dark">
                    <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                    Guardar
                </button>
            </x-slot>
        </x-modal-dialog>
    </x-form>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal-category', event => {
            $('#categoryModal').modal('hide');
        });
        window.addEventListener('open-modal-category', event => {
            $('#categoryModal').modal('show');
        });
    </script>
@endpush
