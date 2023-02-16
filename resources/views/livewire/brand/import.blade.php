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
            <div class="col-4 text-center">
                <label for="name" class="col-form-label">Nombre</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="name" id="name" wire:model="fieldColumnMap.name">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.name')
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
