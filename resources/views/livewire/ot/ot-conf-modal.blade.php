<div>
    <x-form method="save">
        <x-modal-dialog :id="$idModal" title="{{ $nameModal }}">
            <x-slot name="body">
                <div class="row g-2">
                    <x-input.datepicker class="col-xl-6" name="editing.arrival_date" label="Fecha de llegada" id="dp1"
                        :error="$errors->first('editing.arrival_date')" :required=true/>

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.arrival_hour" label="Hora de llegada"
                        type="time" :error="$errors->first('editing.arrival_hour')" :required=true />

                    <x-input.datepicker class="col-xl-6" name="editing.departure_date" label="Fecha de salida"
                        id="dp1" :error="$errors->first('editing.departure_date')" />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.departure_hour" label="Hora de salida"
                        type="time" :error="$errors->first('editing.departure_hour')" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>

                <button type="submit" class="btn btn-primary">
                    <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                    Guargar y confirmar
                </button>
            </x-slot>
        </x-modal-dialog>
    </x-form>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal-ot-conf', event => {
            $('#otConfModal').modal('hide');
        });
        window.addEventListener('open-modal-ot-conf', event => {
            $('#otConfModal').modal('show');
        });
    </script>
@endpush
