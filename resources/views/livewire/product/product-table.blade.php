<div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-xl-7">
                            <div class="row">
                                <div class="col-2">
                                    <div class="d-flex align-items-start ">
                                        <select class="form-select ps-1 pe-0" id="perPage" wire:model="perPage">
                                            <option value="2">2</option>
                                            <option value="5">5</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-8">
                                    <input type="search" class="form-control" wire:model="search"
                                        placeholder="Buscar...">
                                </div>
                            </div>
                        </div>
                        <div class="row col-xl-5">
                            <div class="text-xl-end mt-xl-0 mt-2">
                                <button wire:click="showFilter" type="button"
                                    class="btn btn-outline-dark mb-2 me-2">Filtros
                                    @if ($showFilters)
                                        <i class="mdi mdi-close-circle-outline me-1"></i>
                                    @else
                                        <i class="mdi mdi-filter-outline me-1"></i>
                                    @endif
                                </button>

                                <button type="button" class="btn btn-dark mb-2 me-2 dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nuevo</button>
                                <div class="dropdown-menu">
                                    <button wire:click="$emit('createproduct')" class="dropdown-item action-icon">
                                        Producto</button>
                                    <button wire:click="$emit('createcategory')" class="dropdown-item action-icon">
                                        Categoria</button>
                                    <button wire:click="$emit('createbrand')" class="dropdown-item action-icon">
                                        Marca</button>
                                </div>
                                <button type="button" class="btn btn-light mb-2 dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span
                                        class="{{ count($selected) == 0 ? 'd-none' : '' }} fs-6 badge rounded-pill bg-primary">{{ count($selected) }}</span></button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item action-icon"
                                        @if ($selected != []) onclick="window.livewire.emit('exportSelected')" @else onclick="ToastErrorAlert('Seleccione algún registro')" @endif><i
                                            class="mdi mdi-download"></i> Exportar</button>
                                    <button class="dropdown-item action-icon"
                                        @if ($selected != []) onclick="Confirm(null,'deleteSelected')" @else onclick="ToastErrorAlert('Seleccione algún registro')" @endif><i
                                            class="mdi mdi-delete"></i>
                                        Eliminar</button>
                                    <button class="dropdown-item action-icon" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasRight1" aria-controls="offcanvasRight1"><i
                                            class="mdi mdi-upload"></i>Importar</button>
                                </div>

                                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight1"
                                    aria-labelledby="offcanvasRight1Label">
                                    <div class="offcanvas-header text-center">
                                        <h5 id="offcanvasRight1Label">Importar Productos</h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        @livewire('product.import')
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($showFilters)
                            <div class="border shadow-none bg-light rounded ">
                                <div class="row m-1">
                                    <div class="d-flex flex-row-reverse bd-highlight">
                                        <div class="bd-highlight">
                                            <p class="mb-0 fw-bold text-decoration-underline cursor"
                                                wire:click.prevent="resetFilters">Limpiar</p>
                                        </div>
                                    </div>
                                </div>
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
                                    <x-table.row wire:key="row-{{ $product->id }}" wire:loading.class="table-light"
                                        wire:target="search">

                                        <x-table.cell>
                                            <x-input.check-input name="selected" value="{{ $product->id }}" />
                                        </x-table.cell>

                                        <x-table.cell class="text-wrap w-25">{{ $product->name }}</x-table.cell>

                                        <x-table.cell>{{ $product->code }}</x-table.cell>

                                        <x-table.cell class=" text-center">{{ $product->stock }}</x-table.cell>

                                        <x-table.cell>
                                            <button
                                                class="btn btn-outline-{{ $product->status_color }} rounded-pill btn-sm w-100"
                                                type="button" wire:click="changeStatus({{ $product->id }})">
                                                {{ $product->status }}
                                            </button>
                                        </x-table.cell>

                                        <x-table.cell>{{ $product->category->name ?? 'N/A' }}</x-table.cell>

                                        <x-table.cell>{{ $product->brand->name ?? 'N/A' }}</x-table.cell>

                                        <x-table.cell>
                                            <a class="action-icon cursor"
                                                wire:click="$emit('editproduct',{{ $product->id }})">
                                                <i class="mdi mdi-square-edit-outline"></i> </a>
                                            <a class="action-icon cursor"
                                                onclick="Confirm({{ $product->id }}, 'delete')"><i
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
</div>
@push('modals')
    @livewire('product.modal')
    @livewire('category.modal')
    @livewire('brand.modal')
@endpush
