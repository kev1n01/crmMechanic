@section('title', 'Conf mi empresa')
<div>
    <div class="row mt-3 justify-content-center ">
        <div class="col-8">
            <x-form method="save">

                <div class="card">
                    <div class="card-body">
                        <div class="row g-2">
                            <x-input.input-tooltip-error class="col-xl-8" name="editing.name" label="Nombre de la empresa"
                                type="text" :error="$errors->first('editing.name')" :required=true />

                            <x-input.input-tooltip-error class="col-xl-2" name="editing.phone"
                                label="Telefono" type="text" :error="$errors->first('editing.phone')" :required=true />

                            <x-input.input-tooltip-error class="col-xl-2" name="editing.ubigeous" label="Ubigeo"
                                type="number" :error="$errors->first('editing.ubigeous')" :required=true />
                            <x-input.input-tooltip-error class="col-xl-4" name="editing.department" label="Departamento"
                                type="text" :error="$errors->first('editing.department')" :required=true />

                            <x-input.input-tooltip-error class="col-xl-4" name="editing.province" label="Provincia"
                                type="text" :error="$errors->first('editing.province')" :required=true />

                            <x-input.input-tooltip-error class="col-xl-4" name="editing.district" label="Distrito"
                                type="text" :error="$errors->first('editing.district')" :required=true />

                            <x-input.input-tooltip-error class="col-xl-8" name="editing.address"
                                label="Domicilio Fiscal" type="text" :error="$errors->first('editing.address')" :required=true />

                            <x-input.input-tooltip-error class="col-xl-4" name="logo" label="Logo de empresa"
                                type="file" :error="$errors->first('logo')" :required=true />
                        </div>
                        <div class="col-xl-12 shadow-none bg-secondary rounded text-center mt-3">
                            <span wire:loading wire:target="logo" class="spinner-border text-primary m-4"></span>
                            {{-- @if (!$logo)
                                <img src="https://cdn-icons-png.flaticon.com/512/4131/4131814.png"
                                    class="img-fluid m-2 w-25 h-25" wire:loading.remove>
                            @endif --}}
                            @if ($logo)
                                <img src="{{ $logo->temporaryURL() }}" class="img-fluid m-2 w-25 h-25"
                                    wire:loading.remove />
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
                            Guardar configuración
                        </button>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</div>
