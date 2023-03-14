<div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-xl-7">
                            <div class="row">
                                <div class="col-2">
                                    <div class="d-flex align-items-start">
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
                                    <button wire:click="$emit('createvehicle')" class="dropdown-item action-icon">
                                        Vehiculo</button>
                                    <button wire:click="$emit('createtype')" class="dropdown-item action-icon">
                                        Tipo</button>
                                    <button wire:click="$emit('createbrand')" class="dropdown-item action-icon">
                                        Marca</button>
                                    <button wire:click="$emit('createmodel')" class="dropdown-item action-icon">
                                        Model</button>
                                    <button wire:click="$emit('createcolor')" class="dropdown-item action-icon">
                                        Color</button>
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
                                </div>
                            </div>
                        </div>
                        @if ($showFilters)
                            <div class="border shadow-none bg-light rounded">
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
                                        <x-input.select name="filters.customer" label="Cliente" :options="$customers" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.model_year" label="Año" :options="$years" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.type" label="Tipo" :options="$types" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.brand" label="Marca" :options="$brands" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.model" label="Modelo" :options="$models" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.color" label="Color" :options="$colors" />
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

                                <x-table.heading sortable wire:click="sortBy('license_plate')" :direction="$sortField == 'license_plate' ? $sortDirection : null">Placa
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('type_vehicle')" :direction="$sortField == 'type_vehicle' ? $sortDirection : null">Tipo
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('brand_vehicle')" :direction="$sortField == 'brand_vehicle' ? $sortDirection : null">Marca
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('model_vehicle')" :direction="$sortField == 'model_vehicle' ? $sortDirection : null">Model
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('color_vehicle')" :direction="$sortField == 'color_vehicle' ? $sortDirection : null">Color
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('model_year')" :direction="$sortField == 'model_year' ? $sortDirection : null">Año
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('odo')" :direction="$sortField == 'odo' ? $sortDirection : null">ODO
                                </x-table.heading>

                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>


                            <x-slot name="body">

                                @forelse ($vehicles as $vehicle)
                                    <x-table.row wire:key="row-{{ $vehicle->id }}" wire:loading.class="bg-light"
                                        wire:target="search">

                                        <x-table.cell>
                                            <x-input.check-input name="selected" value="{{ $vehicle->id }}" />
                                        </x-table.cell>
                                        <x-table.cell>{{ $vehicle->license_plate }}</x-table.cell>
                                        <x-table.cell>{{ $vehicle->type->name }}</x-table.cell>
                                        <x-table.cell>{{ $vehicle->brand->name }}</x-table.cell>
                                        <x-table.cell>{{ $vehicle->model->name }}</x-table.cell>
                                        <x-table.cell>{{ $vehicle->color->name }}</x-table.cell>
                                        <x-table.cell>{{ $vehicle->model_year }}</x-table.cell>
                                        <x-table.cell>{{ $vehicle->odo }}</x-table.cell>

                                        <x-table.cell>
                                            <a class="action-icon cursor"
                                                wire:click="$emit('editvehicle', {{ $vehicle->id }})">
                                                <i class="mdi mdi-square-edit-outline"></i> </a>
                                            <a class="action-icon cursor"
                                                onclick="Confirm({{ $vehicle->id }}, 'delete')"><i
                                                    class="mdi mdi-delete"></i></a>
                                        </x-table.cell>
                                    </x-table.row>
                                @empty
                                    <x-table.row>
                                        <x-table.cell class="text-center" colspan="10">
                                            No hay vehiculos encontrados
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            {{ $vehicles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('modals')
    @livewire('vehicle.modal')
    @livewire('vehicle.color-modal')
    @livewire('vehicle.type-modal')
    @livewire('vehicle.model-modal')
    @livewire('vehicle.brand-modal')
@endpush
