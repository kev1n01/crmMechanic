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
            <div class="col-4 text-start">
                <label for="code" class="col-form-label">Codigo</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="code" id="code" wire:model="fieldColumnMap.code">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.code')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-4 text-start">
                <label for="stock" class="col-form-label">Stock</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="stock" id="stock" wire:model="fieldColumnMap.stock">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.stock')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-4 text-start">
                <label for="sale_price" class="col-form-label">Precio venta</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="sale_price" id="sale_price" wire:model="fieldColumnMap.sale_price">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.sale_price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-4 text-start">
                <label for="purchase_price" class="col-form-label">Venta compra</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="purchase_price" id="purchase_price"
                    wire:model="fieldColumnMap.purchase_price">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.purchase_price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-4 text-start">
                <label for="" class="col-form-label">Estado</label>
            </div>
            <div class="col-8">
                <select class="form-select w-100" name="" id="" wire:model="fieldColumnMap.status">
                    <option value="">Selecciona columna</option>
                    @foreach ($columns as $c)
                        <option>{{ $c }}</option>
                    @endforeach
                </select>
                @error('fieldColumnMap.status')
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
