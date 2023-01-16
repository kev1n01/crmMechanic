<div>
    @unless($upload)
        <input type="file" class="form-control @if ($errors->has('upload')) is-invalid @endif" name="upload"
            id="upload" wire:loading.remove wire:model="upload">
        @error('upload')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="row justify-content-center m-2">
            <span wire:loading.delay.longer wire:target="upload" class="spinner-grow text-success spinner-grow-md"></span>
        </div>
    @else
        <div class="row mb-4">
            <div class="col-md-4">
                <span>Nombre</span>
            </div>
            <div class="col-md-8">
                <select class="form-select" name="name" id="name" wire:model="fieldColumnMap.name">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4">
                <button class="btn btn-dark" wire:click="import">Importar</button>
            </div>
        </div>
        @endif
    </div>
