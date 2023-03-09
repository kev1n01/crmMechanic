<div>
    <x-form method="save">
        <x-modal-dialog :id="$idModal" title="{{ $nameModal }}">
            <x-slot name="body">
                <div class="row g-2">
                    <x-input.input-tooltip-error class="col-xl-5 pe-0" name="editing.dni" label="DNI" type="text"
                        :error="$errors->first('editing.dni')" />
                    <div class="col-xl-1 ps-0">
                        <button type="button" class="btn btn-primary rounded btn-sm" style="margin-top:30px;"><i
                                class="uil-search"></i></button>
                    </div>

                    <x-input.input-tooltip-error class="col-xl-5 pe-0" name="editing.ruc" label="RUC" type="text"
                        :error="$errors->first('editing.ruc')" />
                    <div class="col-xl-1 ps-0">
                        <button type="button" class="btn btn-primary rounded btn-sm" style="margin-top:30px;"><i
                                class="uil-search"></i></button>
                    </div>
                    @if (!$showInputs)
                        <div class="col-12 shadow-none rounded text-center mt-2">
                            <span wire:loading wire:target="editing" class="spinner-border text-primary m-2"></span>
                        </div>
                    @endif

                    @if ($showInputs || strlen($editing->dni) == 8 || strlen($editing->ruc) == 11)
                        <x-input.input-tooltip-error class="col-xl-12" name="editing.name" label="Nombre de cliente"
                            type="text" :error="$errors->first('editing.name')" :required=true />

                        <x-input.input-tooltip-error class="col-xl-12" name="editing.address" label="Dirección"
                            type="text" :error="$errors->first('editing.address')" />

                        <x-input.input-tooltip-error class="col-xl-12" name="editing.email" label="Correo"
                            type="email" :error="$errors->first('editing.email')" />

                        <x-input.input-tooltip-error class="col-xl-6" name="editing.phone" label="Celular"
                            type="text" :error="$errors->first('editing.phone')" :required=true />

                        <x-input.select class="col-xl-6" name="editing.status" label="Estado" :options="$statuses"
                            :error="$errors->first('editing.status')" :required=true />
                    @endif
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
