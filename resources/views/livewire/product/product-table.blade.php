<div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-xl-8">
                            <div
                                class="row gy-2 gx-2 align-items-center justify-content-xl-start justify-content-between">
                                <div class="col-2">
                                    <div class="d-flex align-items-start me-1">
                                        <select class="form-select ps-1 pe-0" id="perPage" wire:model="perPage">
                                            <option value="2">2</option>
                                            <option value="5">5</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <input type="search" class="form-control" wire:model="search"
                                        placeholder="Buscar...">
                                </div>

                                <div class="col-3">
                                    <a wire:click="showFilter"
                                        class="action-icon">{{ $showFilters ? 'Ocultar filtros..' : 'Mostrar filtros..' }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="row col-xl-4">
                            <div class="text-xl-end mt-xl-0 mt-2">
                                <button type="button" wire:click="create" class="btn btn-dark mb-2 me-2"><i
                                        class="mdi mdi-plus me-1"></i>
                                    Nuevo</button>
                                <button type="button" class="btn btn-light mb-2 dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span
                                        class="{{ count($selected) == 0 ? 'd-none' : '' }} fs-6 badge rounded-pill bg-primary">{{ count($selected) }}</span></button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item action-icon" wire:click="exportSelected"><i
                                            class="mdi mdi-download"></i> Exportar</button>
                                    <button class="dropdown-item action-icon"
                                        @if ($selected != []) onclick="Confirm(null,'deleteSelected')" @else onclick="ToastErrorAlert('Seleccione algún registro')" @endif><i
                                            class="mdi mdi-delete"></i>
                                        Eliminar</button>
                                </div>
                            </div>
                        </div>
                        @if ($showFilters)
                            <div class="border shadow-none bg-light rounded ">
                                <div class="row m-1">
                                    <div class="col-lg-3">
                                        <x-input.datepicker name="filters.fromDate" label="Desde" id="dp1" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.datepicker name="filters.toDate" label="Hasta" id="dp2" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.status" label="Estado" :options="$statuses" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.category" label="Categoria" :options="$categories" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.brand" label="Marca" :options="$brands" />
                                    </div>
                                </div>
                                <div class="d-flex flex-row-reverse bd-highlight">
                                    <div class="p-2 bd-highlight">
                                        <button class="btn btn-primary" wire:click.prevent="resetFilters">Limpiar
                                            filtros</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <x-table>
                            <x-slot name="head">

                                <x-table.heading style="width: 20px;">
                                    <x-input.check-input name="selectedPage" />
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('name')" :direction="$sortField == 'name' ? $sortDirection : null">Nombre
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('code')" :direction="$sortField == 'code' ? $sortDirection : null">Código
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('stock')" :direction="$sortField == 'stock' ? $sortDirection : null">Stock
                                </x-table.heading>

                                <x-table.heading>Estado</x-table.heading>

                                <x-table.heading>Categoría</x-table.heading>

                                <x-table.heading>Marca</x-table.heading>

                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>

                            <x-slot name="body">
                                @forelse ($products as $product)
                                    <x-table.row wire:key="row-{{ $product->id }}" wire:loading.class="bg-light"
                                        wire:target="search">

                                        <x-table.cell>
                                            <x-input.check-input name="selected" value="{{ $product->id }}" />
                                        </x-table.cell>

                                        <x-table.cell class="text-wrap w-25">{{ $product->name }}</x-table.cell>

                                        <x-table.cell>{{ $product->code }}</x-table.cell>

                                        <x-table.cell class="text-center">{{ $product->stock }}</x-table.cell>

                                        <x-table.cell>
                                            <button
                                                class="btn btn-outline-{{ $product->status_color }} rounded-pill btn-sm w-100"
                                                type="button" wire:click="changeStatus({{ $product->id }})">
                                                {{ $product->status }}
                                            </button>
                                        </x-table.cell>

                                        <x-table.cell>{{ $product->category->name }}</x-table.cell>

                                        <x-table.cell>{{ $product->brand->name }}</x-table.cell>

                                        <x-table.cell>
                                            <a class="action-icon" wire:click="edit({{ $product->id }})">
                                                <i class="mdi mdi-square-edit-outline"></i> </a>
                                            <a class="action-icon" onclick="Confirm({{ $product->id }}, 'delete')"><i
                                                    class="mdi mdi-delete"></i></a>
                                        </x-table.cell>
                                    </x-table.row>
                                @empty
                                    <x-table.row>
                                        <x-table.cell class="text-center" colspan="8">
                                            No hay productos encontradas
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
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

                    <x-input.select class="col-xl-6" name="editing.category_products_id" label="Categorías"
                        :options="$categories" :error="$errors->first('editing.category_products_id')" :required=true />

                    <x-input.select class="col-xl-6" name="editing.brand_products_id" label="Marcas"
                        :options="$brands" :error="$errors->first('editing.brand_products_id')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.sale_price" label="Precio venta"
                        type="text" :error="$errors->first('editing.sale_price')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.purchase_price" label="Precio compra"
                        type="text" :error="$errors->first('editing.purchase_price')" :required=true />

                    <x-input.input-tooltip-error class="col-12" name="image" label="Imagen de producto"
                        type="file" :error="$errors->first('image')" />
                </div>

                <div class="col-12 shadow-none bg-secondary rounded text-center mt-2">
                    <span wire:loading wire:target="image" class="spinner-border text-primary m-2"></span>
                    @if ($image)
                        <img src="{{ $image->temporaryURL() }}" class="img-fluid m-2 w-50 h-50"
                            wire:loading.remove />
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
@push('styles')
@endpush
@push('js')
    <script>
        window.addEventListener('close-modal', event => {
            $('#productModal').modal('hide');
        });
        window.addEventListener('open-modal', event => {
            $('#productModal').modal('show');
        });
    </script>
@endpush
