<div>
    <x-form method="save">
        <x-modal-dialog :id="$idModal" title="{{ $nameModal }}">
            <x-slot name="body">
                <div class="row g-2">
                    <x-input.select class="col-xl-12" name="type_doc" label="Tipo de documentos" :options="$type_documents"
                        :error="$errors->first('type_doc')" :required=true />

                    <x-input.input-button class="col-xl-5 pe-0" name="editing.num_doc" label="Numero de documento"
                        :max="$type_doc === '1' ? '8' : '11'" :error="$errors->first('editing.num_doc')" :required=true :disabled="!$type_doc ? true : false" fnbtn="searchNumDoc"
                        iconbtn="uil-search"  title="Buscar"/>

                    {{-- @if (strlen($editing->dni) == 8) --}}
                    <div class="col-xl-12 text-center mt-0">
                        <span wire:loading wire:target="searchNumDoc" class="text-white m-2">Buscando datos por
                            {{ $type_doc === '1' ? 'DNI' : 'RUC' }}</span>
                    </div>
                    {{-- @endif --}}

                    <x-input.input-tooltip-error class="col-xl-12" name="editing.name" label="Nombre de cliente"
                        type="text" :error="$errors->first('editing.name')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-12" name="editing.address" label="Dirección"
                        type="text" :error="$errors->first('editing.address')" />

                    <x-input.input-tooltip-error class="col-xl-12" name="editing.email" label="Correo" type="email"
                        :error="$errors->first('editing.email')" />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.phone" label="Celular" type="text"
                        :error="$errors->first('editing.phone')" :required=true max="9" />

                    <x-input.select class="col-xl-6" name="editing.status" label="Estado" :options="$statuses"
                        :error="$errors->first('editing.status')" :required=true />
                </div>

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
        window.addEventListener('close-modal-customer', event => {
            $('#customerModal').modal('hide');
        });
        window.addEventListener('open-modal-customer', event => {
            $('#customerModal').modal('show');
        });
    </script>
@endpush
