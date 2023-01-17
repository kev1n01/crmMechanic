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
                                <a type="button" href="{{ route('ordenes.crear') }}" class="btn btn-dark mb-2 me-2"><i
                                        class="mdi mdi-plus me-1"></i>
                                    Nuevo</a>
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
                            <div class="w-100 border shadow-none bg-light rounded ">
                                <div class="row m-1">
                                    <div class="col-lg-3">
                                        <x-input.datepicker name="filters.fromDate" label="Desde" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.datepicker name="filters.toDate" label="Hasta" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.status" label="Tipo de comprobante"
                                            :options="$statuses" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.customer" label="Tipo de comprobante"
                                            :options="$customers" />
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

                                <x-table.heading sortable wire:click="sortBy('code')" :direction="$sortField == 'code' ? $sortDirection : null">Código
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('customer')" :direction="$sortField == 'customer' ? $sortDirection : null">Cliente
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('vehicle')" :direction="$sortField == 'vehicle' ? $sortDirection : null">Vehiculo
                                </x-table.heading>

                                <x-table.heading>F/H llegada</x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('total')" :direction="$sortField == 'total' ? $sortDirection : null">Total
                                </x-table.heading>

                                <x-table.heading>Estado</x-table.heading>

                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>


                            <x-slot name="body">

                                @forelse ($works as $wo)
                                    <x-table.row wire:key="row-{{ $wo->id }}" wire:loading.class="bg-light"
                                        wire:target="search">

                                        <x-table.cell>
                                            <x-input.check-input name="selected" value="{{ $wo->id }}" />
                                        </x-table.cell>

                                        <x-table.cell>{{ $wo->code }}</x-table.cell>

                                        <x-table.cell>{{ $wo->customerUser->name }}</x-table.cell>

                                        <x-table.cell>{{ $wo->vehiclePlate->license_plate }}</x-table.cell>

                                        <x-table.cell>{{ $wo->arrival_date . '/' . $wo->arrival_hour }}</x-table.cell>

                                        <x-table.cell>{{ $wo->total }}</x-table.cell>


                                        <x-table.cell>
                                            <span class="badge badge-{{ $wo->status_color }}-lighten">
                                                {{ strtoupper($wo->status) }}
                                            </span>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <a class="action-icon" wire:click="edit({{ $wo->id }})">
                                                <i class="mdi mdi-square-edit-outline"></i> </a>
                                            <a class="action-icon" onclick="Confirm({{ $wo->id }}, 'delete')"><i
                                                    class="mdi mdi-delete"></i></a>
                                            <a class="action-icon" wire:click="generatePdf({{ $wo->id }})"><i
                                                    class="mdi mdi-file-pdf-outline"></i></a>
                                        </x-table.cell>

                                    </x-table.row>
                                @empty
                                    <x-table.row>
                                        <x-table.cell class="text-center" colspan="8">
                                            No hay ordenes de trabajo registrados
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            {{ $works->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
