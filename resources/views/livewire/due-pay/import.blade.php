<div>
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
                <label for="name" class="col-form-label">Descripcion</label>
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
            <div class="col-4 text-start">
                <label for="name" class="col-form-label">Deudor</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="person_owed" id="person_owed" wire:model="fieldColumnMap.person_owed">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.person_owed')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-4 text-start">
                <label for="name" class="col-form-label">Monto adeudado</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="amount_owed" id="amount_owed" wire:model="fieldColumnMap.amount_owed">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.amount_owed')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-4 text-start">
                <label for="name" class="col-form-label">Monto pagado</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="amount_paid" id="amount_paid" wire:model="fieldColumnMap.amount_paid">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.amount_paid')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-4 text-start">
                <label for="name" class="col-form-label">razon</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="reason" id="reason" wire:model="fieldColumnMap.reason">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.reason')
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
