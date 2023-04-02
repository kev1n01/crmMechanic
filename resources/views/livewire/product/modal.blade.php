<div>
    <x-form method="save">
        <x-modal-dialog :id="$idModal" :title="$nameModal">
            <x-slot name="body">
                <div class="row g-2">
                    <x-input.input-tooltip-error class="col-xl-12" name="editing.name" label="Nombre de producto"
                        type="text" :error="$errors->first('editing.name')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.code" label="Código de producto"
                        type="text" :error="$errors->first('editing.code')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.stock" label="Stock" type="number"
                        :error="$errors->first('editing.stock')" :required=true />

                    <x-input.select class="col-xl-6" name="editing.status" label="Estado" :options="$statuses"
                        :error="$errors->first('editing.status')" />

                    <x-input.select class="col-xl-6 " name="editing.category_products_id" label="Categorías"
                        :options="$categories" :error="$errors->first('editing.category_products_id')" :required=true />

                    <x-input.select class="col-xl-6" name="editing.brand_products_id" label="Marcas" :options="$brands"
                        :error="$errors->first('editing.brand_products_id')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.sale_price" label="Precio venta"
                        type="text" :error="$errors->first('editing.sale_price')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.purchase_price" label="Precio compra"
                        type="text" :error="$errors->first('editing.purchase_price')" :required=true />

                    <x-input.input-tooltip-error class="col-12" name="image" label="Imagen de producto" type="file"
                        :error="$errors->first('image')" accept="image/png, image/jpeg, image/jpg"/>
                </div>

                <div class="col-12 shadow-none bg-secondary rounded text-center mt-2">
                    <span wire:loading wire:target="image" class="spinner-border text-primary m-2"></span>
                    @if ($image)
                        <img src="{{ $image->temporaryURL() }}" class="img-fluid m-2 w-50 h-50" wire:loading.remove />
                    @else
                        @if ($editing->image)
                            <img src="{{ asset('storage/' . $editing->image) }}" class="img-fluid m-2 w-50 h-50"
                                wire:loading.remove />
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
        window.addEventListener('close-modal-product', event => {
            $('#productModal').modal('hide');
        });
        window.addEventListener('open-modal-product', event => {
            $('#productModal').modal('show');
        });
    </script>
@endpush
