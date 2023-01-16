@section('title','Categorias de productos')
<div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-xl-9">
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
                        <div class="row col-xl-3">
                            <div class="text-xl-end mt-xl-0 mt-2">
                                <button type="button" wire:click="$emit('create')" class="btn btn-dark mb-2 me-2"><i
                                        class="mdi mdi-plus me-1"></i>
                                    Nuevo</button>
                                <button class="btn btn-success mb-2 me-2" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                    csv</button>

                                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                                    aria-labelledby="offcanvasRightLabel">
                                    <div class="offcanvas-header">
                                        <h5 id="offcanvasRightLabel">Importar categorías</h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        @livewire('category.import')
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($showFilters)
                            <div class="w-100 border shadow-none bg-light rounded" >
                                <div class="m-2" wire:target="showFilter">
                                        <x-input.input-group>
                                            <x-input.input-label name="filters.fromDate" label="Desde" class="me-2"
                                                type="date" />
                                            <x-input.input-label name="filters.toDate" label="Hasta" type="date" />
                                        </x-input.input-group>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <x-table>
                            <x-slot name="head">

                                <x-table.heading sortable wire:click="sortBy('id')" :direction="$sortField == 'id' ? $sortDirection : null">#
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('name')" :direction="$sortField == 'name' ? $sortDirection : null">Nombre
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sortField == 'created_at' ? $sortDirection : null">
                                Fecha creación
                                </x-table.heading>

                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>


                            <x-slot name="body">
                                @forelse ($categories as $category)
                                    <x-table.row wire:loading.class="bg-light" wire:target="search">

                                        <x-table.cell>{{ $category->id }}</x-table.cell>

                                        <x-table.cell>{{ $category->name }}</x-table.cell>

                                        <x-table.cell>{{ $category->created_at }}</x-table.cell>

                                        <x-table.cell>

                                            <a class="action-icon" wire:click="$emit('edit',{{ $category->id }})">
                                                <i class="mdi mdi-square-edit-outline"></i> </a>
                                            <a class="action-icon" onclick="Confirm({{ $category->id }}, 'delete')"><i
                                                    class="mdi mdi-delete"></i></a>
                                        </x-table.cell>

                                    </x-table.row>

                                @empty

                                    @if ($search || $filters)
                                        <x-table.row>
                                            <x-table.cell class="text-center" colspan="5">
                                                No se encontró la categoría
                                            </x-table.cell>
                                        </x-table.row>
                                    @else
                                        <x-table.row>
                                            <x-table.cell class="text-center" colspan="5">
                                                No hay categorias registradas
                                            </x-table.cell>
                                        </x-table.row>
                                    @endif
                                @endforelse

                            </x-slot>

                        </x-table>

                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('modals')
    @livewire('category.modal')
@endpush

@push('js')
    <script>
        window.addEventListener('close-modal', event => {
            $('#categoryModal').modal('hide');
        });
        window.addEventListener('open-modal', event => {
            $('#categoryModal').modal('show');
        });
    </script>
@endpush
