@section('title', 'Listado de clientes')

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
                                <button title="Filtrar información" wire:click="showFilter" type="button"
                                    class="btn btn-outline-dark mb-2 me-2">Filtros
                                    @if ($showFilters)
                                        <i class="mdi mdi-close-circle-outline me-1"></i>
                                    @else
                                        <i class="mdi mdi-filter-outline me-1"></i>
                                    @endif
                                </button>
                                <button title="Crear cliente" type="button" wire:click="$emit('createcustomer')"
                                    class="btn btn-dark mb-2 me-2"><i class="mdi mdi-plus me-1"></i>
                                    Nuevo</button>
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
                                        <x-input.select name="filters.status" label="Estado" :options="$statuses" />
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>

                    <div class="table-responsive ">
                        <x-table>
                            <x-slot name="head">

                                <x-table.heading style="width: 20px;">
                                    @if (count($customers) > 0)
                                        <x-input.check-input name="selectedPage" />
                                    @endif
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('name')" :direction="$sortField == 'name' ? $sortDirection : null">Nombre
                                </x-table.heading>

                                <x-table.heading>Celular</x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('address')" :direction="$sortField == 'address' ? $sortDirection : null">Dirección
                                </x-table.heading>

                                <x-table.heading>N° Documento</x-table.heading>

                                <x-table.heading>Estado</x-table.heading>

                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>

                            <x-slot name="body">
                                @forelse ($customers as $customer)
                                    <x-table.row wire:key="row-{{ $customer->id }}" wire:loading.class="bg-light"
                                        wire:target="search">
                                        <x-table.cell>
                                            <x-input.check-input name="selected" value="{{ $customer->id }}" />
                                        </x-table.cell>


                                        <x-table.cell>{{ $customer->name }}</x-table.cell>

                                        <x-table.cell>{{ $customer->phone }}</x-table.cell>

                                        <x-table.cell class="text-wrap w-25">
                                            {{ $customer->address ? $customer->address : 'N/D' }}</x-table.cell>

                                        <x-table.cell>{{ $customer->num_doc ?? 'N/D' }}</x-table.cell>

                                        <x-table.cell>
                                            <button
                                                class="btn btn-outline-{{ $customer->status_color }} rounded-pill btn-sm w-100"
                                                type="button" wire:click="changeStatus({{ $customer->id }})">
                                                {{ $customer->status }}
                                            </button>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <a class="btn btn-info btn-sm mb-1"
                                                wire:click="$emit('editcustomer',{{ $customer->id }})">
                                                Editar</a>

                                            <a class="btn btn-danger btn-sm mb-1"
                                                onclick="Confirm({{ $customer->id }}, 'delete')">
                                                Eliminar</a>
                                        </x-table.cell>
                                    </x-table.row>
                                @empty
                                    <x-table.row>
                                        <x-table.cell class="text-center" colspan="8">
                                            No hay clientes encontrados
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('modals')
    @livewire('customer.modal')
@endpush
