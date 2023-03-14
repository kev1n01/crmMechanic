<div>
    <x-form method="save">
        <x-modal-dialog :id="$idModal" title="{{ $nameModal }}">
            <x-slot name="body">
                <div class="row g-2">
                    <x-input.input-tooltip-error class="col-xl-11 pe-0" name="editing.ruc" label="Ruc" type="text"
                        :error="$errors->first('editing.ruc')" :required=true max="11" />
                    <div class="col-xl-1 ps-0">
                        <button type="button" wire:click.prevent="searchRuc" class="btn btn-primary rounded btn-sm"
                            style="margin-top:30px;"><i class="uil-search"></i></button>
                    </div>

                    @if (strlen($editing->ruc) == 11)
                        <div class="col-xl-12 text-center mt-0">
                            <span wire:loading wire:target="searchRuc" class="text-primary m-2">Buscando datos por
                                RUC</span>
                        </div>
                    @endif

                    <x-input.input-tooltip-error class="col-xl-12" name="editing.name" label="Nombre de proveedor"
                        type="text" :error="$errors->first('editing.name')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-12" name="editing.address" label="Dirección"
                        type="text" :error="$errors->first('editing.address')" />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.phone" label="Celular" type="text"
                        :error="$errors->first('editing.phone')" :required=true />

                    <x-input.select class="col-xl-6" name="editing.status" label="Estado" :options="$statuses"
                        :error="$errors->first('editing.status')" :required=true max="9" />
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
        window.addEventListener('close-modal-provider', event => {
            $('#providerModal').modal('hide');
        });
        window.addEventListener('open-modal-provider', event => {
            $('#providerModal').modal('show');
        });
    </script>
@endpush
