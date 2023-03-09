<div>
    <x-form method="save">
        <x-modal-dialog :id="$idModal" title="{{ $nameModal }}">
            <x-slot name="body">
                <x-input.input-group>
                    <x-input.input-tooltip-error class="col-12" name="editing.name" label="Nombre de proveedor"
                        type="text" :error="$errors->first('editing.name')" :required=true />
                </x-input.input-group>

                <x-input.input-group>
                    <x-input.input-tooltip-error class="col-12" name="editing.phone" label="Celular" type="text"
                        :error="$errors->first('editing.phone')" :required=true />
                </x-input.input-group>

                <x-input.input-group>
                    <x-input.input-tooltip-error class="col-12" name="editing.address" label="Dirección" type="text"
                        :error="$errors->first('editing.address')" />
                </x-input.input-group>

                <x-input.input-group>
                    <x-input.input-tooltip-error class="col-12" name="editing.ruc" label="Ruc" type="text"
                        :error="$errors->first('editing.ruc')" :required=true />
                </x-input.input-group>

                <x-input.input-group>
                    <x-input.select class="col-12" name="editing.status" label="Estado" :options="$statuses"
                        :error="$errors->first('editing.status')" :required=true />
                </x-input.input-group>

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
        window.addEventListener('close-modal-provider', event => {
            $('#providerModal').modal('hide');
        });
        window.addEventListener('open-modal-provider', event => {
            $('#providerModal').modal('show');
        });
    </script>
@endpush
