<div>
    <x-form method="save">
        <div class="card">
            <div class="card-body">
                <div class="row g-2">
                    <x-input.input-tooltip-error class="col-xl-10" name="editing.name" label="Nombre de la empresa"
                        type="text" :error="$errors->first('editing.name')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-2" name="editing.ubigeous" label="Ubigeo" type="number"
                        :error="$errors->first('editing.ubigeous')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.ruc" label="Ruc" type="text"
                        :error="$errors->first('editing.ruc')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.phone" label="Telefono" type="text"
                        :error="$errors->first('editing.phone')" :required=true />
   
                    <x-input.select class="col-xl-4" name="editing.department" :options="$departments" label="Departamento"
                        type="text" :error="$errors->first('editing.department')" :required=true />
   
                    <x-input.select class="col-xl-4" name="editing.province" :options="$provinces" label="Provincia"
                        type="text" :error="$errors->first('editing.province')" :required=true />
   
                    <x-input.select class="col-xl-4" name="editing.district" :options="$districs" label="Distrito"
                        type="text" :error="$errors->first('editing.district')" :required=true />
   
                    <x-input.input-tooltip-error class="col-xl-8" name="editing.address" label="Domicilio Fiscal"
                        type="text" :error="$errors->first('editing.address')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-4" name="logo" label="Logo de empresa" type="file"
                        :error="$errors->first('logo')" :required=true accept="image/png, image/jpeg, image/jpg" />
                </div>
                <div class="col-xl-12 shadow-none bg-secondary rounded text-center mt-3">
                    <span wire:loading wire:target="logo" class="spinner-border text-primary m-4"></span>
                    @if (!$logo && $editing->logo == null)
                        <img src="https://cdn-icons-png.flaticon.com/512/4131/4131814.png"
                            class="img-fluid m-2 w-25 h-25" wire:loading.remove wire:target="logo">
                    @endif
                    @if ($logo)
                        <img src="{{ $logo->temporaryURL() }}" class="img-fluid m-2 w-25 h-25" wire:loading.remove
                            wire:target="logo" />
                    @else
                        @if ($editing->logo)
                            <img src="{{ asset('storage/' . $editing->logo) }}" class="img-fluid m-4 w-25 h-25"
                                wire:loading.remove />
                        @endif
                    @endif
                </div>
            </div>
            <div class="d-flex flex-row-reverse bd-highlight mt-1 mb-3">
                <button type="submit" class="btn btn-primary me-3">
                    <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                    Guardar
                </button>
            </div>
        </div>
    </x-form>
</div>
