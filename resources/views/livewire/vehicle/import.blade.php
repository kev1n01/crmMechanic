<div>
    <div class="row mt-0 mb-2 ms-4 me-4">
        <button class="btn btn-primary" wire:click="exportTemplate">Descargar plantilla</button>
    </div>
    @unless($upload)
        <input type="file" class="form-control @if ($errors->has('upload')) is-invalid @endif" name="upload"
            id="upload" wire:loading.remove wire:model="upload">
        @error('upload')
            <p class="text-white bg-danger" wire:loading.remove>{{ $message }}</p>
        @enderror
        <div class="row justify-content-center m-2">
            <span wire:loading.delay.longer wire:target="upload" class="spinner-grow text-success spinner-grow-md"></span>
        </div>
    @else
        <div class="row g-2">
            <div class="col-4 text-start">
                <label for="license_plate" class="col-form-label">Placa</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="license_plate" id="license_plate" wire:model="fieldColumnMap.license_plate">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.license_plate')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-4 text-start">
                <label for="model_year" class="col-form-label">Año vehiculo</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="model_year" id="model_year" wire:model="fieldColumnMap.model_year">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.model_year')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-4 text-start">
                <label for="odo" class="col-form-label">Odometro</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="odo" id="odo" wire:model="fieldColumnMap.odo">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.odo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-4 text-start">
                <label for="description" class="col-form-label">Descripcion</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="description" id="description" wire:model="fieldColumnMap.description">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="d-flex flex-row-reverse bd-highlight mt-2">
                <button class="btn btn-dark" wire:click="import">Importar</button>
                <button class="btn btn-secondary me-2" wire:click="cancel">Cancel</button>
            </div>
        </div>
        @endif
    </div>
