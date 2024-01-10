<div>
    <x-form method="save">
        <x-modal-dialog :id="$idModal" title="{{ $nameModal }}">
            <x-slot name="body">

                <x-input.input-tooltip-error class="col-12 mb-2" name="editingconcept.code" label="Codigo" type="text"
                    :error="$errors->first('editingconcept.code')" :required=true :disabled=true />

                <x-input.input-tooltip-error class="col-12" name="editingconcept.name" label="Nombre del concepto"
                    type="text" :error="$errors->first('editingconcept.name')" :required=true />

            </x-slot>

            <x-slot name="footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>

                <button type="submit" class="btn btn-primary">
                    <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                    Guardar
                </button>
            </x-slot>
        </x-modal-dialog>
    </x-form>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal-concept', event => {
            $('#conceptModal').modal('hide');
        });
        window.addEventListener('open-modal-concept', event => {
            $('#conceptModal').modal('show');
        });
    </script>
@endpush
