<div>
    <x-form method="save">
        <x-modal-dialog :id="$idModal" :title="$nameModal" :optionsModal="$modalsize">
            <x-slot name="body">
                <div class="row g-2">
                    <x-input.input-tooltip-error class="col-xl-6" name="editing.license_plate"
                        label="Placa de vehiculo" type="text" :error="$errors->first('editing.license_plate')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.odo" label="Kilometraje"
                        type="text" :error="$errors->first('editing.odo')" :required=true />

                    <x-input.select class="col-xl-6" name="editing.customer_id" label="Cliente" :options="$customers"
                        :error="$errors->first('editing.customer_id')" :required=true />

                    <x-input.select class="col-xl-6" name="editing.type_vehicle" label="Tipo de vehiculo"
                        :options="$types" :error="$errors->first('editing.type_vehicle')" :required=true />

                    <x-input.select class="col-xl-6" name="editing.brand_vehicle" label="Marca de vehiculo"
                        :options="$brands" :error="$errors->first('editing.brand_vehicle')" :required=true />

                    <x-input.select class="col-xl-6" name="editing.model_vehicle" label="Modelo de vehiculo"
                        :options="$models" :error="$errors->first('editing.model_vehicle')" :required=true />

                    <x-input.select class="col-xl-6" name="editing.color_vehicle" label="Color de vehiculo"
                        :options="$colors" :error="$errors->first('editing.color_vehicle')" :required=true />

                    <x-input.select class="col-xl-6" name="editing.model_year" label="Año" :options="$years"
                        :error="$errors->first('editing.model_year')" />

                    <x-input.textarea class="col-xl-12" name="editing.description" label="Descripción" />
                    
                    <x-input.input-tooltip-error class="col-12" name="image" label="Imagen de vehiculo"
                        type="file" :error="$errors->first('image')" />
                </div>

                <div class="col-12 shadow-none bg-secondary rounded text-center mt-2">
                    <span wire:loading wire:target="image" class="spinner-border text-primary m-2"></span>
                    @if ($image)
                        <img src="{{ $image->temporaryURL() }}" class="img-fluid m-2 w-50 h-50" wire:loading.remove/>
                    @else
                        @if ($editing->image)
                            <img src="{{ asset('storage/' . $editing->image) }}" class="img-fluid m-2 w-50 h-50" wire:loading.remove/>
                        @endif
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
        window.addEventListener('close-modal-vehicle', event => {
            $('#vehicleModal').modal('hide');
        });
        window.addEventListener('open-modal-vehicle', event => {
            $('#vehicleModal').modal('show');
        });
    </script>
@endpush
