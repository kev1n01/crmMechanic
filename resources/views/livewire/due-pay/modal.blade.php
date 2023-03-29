<div>
    <x-form method="save">
        <x-modal-dialog :id="$idModal" title="{{ $nameModal }}">
            <x-slot name="body">
                <div class="row g-2">
                    @if ($pay_from_sale)
                        <x-input.input-tooltip-error class="col-xl-6" name="editing.amount_owed" label="Monto adeudado"
                            type="number" :error="$errors->first('editing.amount_owed')" :required=true :disabled=true />

                        <x-input.input-tooltip-error class="col-xl-6" name="editing.amount_paid" label="Monto pagado"
                            type="number" :error="$errors->first('editing.amount_paid')" :required=true />
                    @elseif ($editing->reason === 'otro')
                        <x-input.input-tooltip-error class="col-xl-12" name="editing.description" label="Descripcion"
                            type="text" :error="$errors->first('editing.description')" :required=true />

                        <x-input.input-tooltip-error class="col-xl-6" name="editing.person_owed" label="Nombre deudor"
                            type="text" :error="$errors->first('editing.person_owed')" :required=true />

                        <x-input.input-tooltip-error class="col-xl-6" name="editing.amount_owed" label="Monto adeudado"
                            type="number" :error="$errors->first('editing.amount_owed')" :required=true />

                        <x-input.input-tooltip-error class="col-xl-6" name="editing.amount_paid" label="Monto pagado"
                            type="number" :error="$errors->first('editing.amount_paid')" :required=true />

                        <x-input.input-tooltip-error class="col-xl-6" name="editing.reason" label="Razon"
                            type="text" :error="$errors->first('editing.reason')" :required=true :disabled=true/>
                    @else
                        <x-input.input-tooltip-error class="col-xl-12" name="editing.description" label="Descripcion"
                            type="text" :error="$errors->first('editing.description')" :required=true :disabled=true />

                        <x-input.input-tooltip-error class="col-xl-6" name="editing.person_owed" label="Nombre deudor"
                            type="text" :error="$errors->first('editing.person_owed')" :required=true :disabled=true />

                        <x-input.input-tooltip-error class="col-xl-6" name="editing.amount_owed" label="Monto adeudado"
                            type="number" :error="$errors->first('editing.amount_owed')" :required=true :disabled=true />

                        <x-input.input-tooltip-error class="col-xl-6" name="editing.amount_paid" label="Monto pagado"
                            type="number" :error="$errors->first('editing.amount_paid')" :required=true />

                        <x-input.select class="col-xl-6" name="editing.reason" label="Razon" :options="$reasons"
                            :error="$errors->first('editing.reason')" :required=true :disabled=true />
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
        window.addEventListener('close-modal-duepay', event => {
            $('#dueModal').modal('hide');
        });
        window.addEventListener('open-modal-duepay', event => {
            $('#dueModal').modal('show');
        });
    </script>
@endpush
