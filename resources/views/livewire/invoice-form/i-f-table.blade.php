@section('title', 'Listado de proformas')
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
                                <a type="button" href="{{ route('proforma.orden.crear') }}"
                                    class="btn btn-dark mb-2 me-2"><i class="mdi mdi-plus me-1"></i>
                                    Nuevo</a>
                                <button type="button" class="btn btn-light mb-2 dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span
                                        class="{{ count($selected) == 0 ? 'd-none' : '' }} fs-6 badge rounded-pill bg-primary">{{ count($selected) }}</span></button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item action-icon"
                                        @if ($selected != []) onclick="Confirm(null,'exportSelected')" @else onclick="ToastErrorAlert('Seleccione algún registro')" @endif><i
                                            class="mdi mdi-download"></i> Exportar</button>
                                    {{-- <button class="dropdown-item action-icon"
                                        @if ($selected != []) onclick="Confirm(null,'deleteSelected')" @else onclick="ToastErrorAlert('Seleccione algún registro')" @endif><i
                                            class="mdi mdi-delete"></i>
                                        Eliminar</button> --}}
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
                                        <x-input.select name="filters.confirmation" label="Confirmacion"
                                            :options="$confirmations" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.customer" label="Cliente" :options="$customers" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.vehicle" label="Vehiculo" :options="$vehicles" />
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

                                <x-table.heading>Total</x-table.heading>

                                <x-table.heading>Fecha emision</x-table.heading>

                                <x-table.heading>Estado </x-table.heading>

                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>

                            <x-slot name="body">
                                @forelse ($works as $wo)
                                    <x-table.row wire:key="row-{{ $wo->id }}" wire:loading.class="bg-light"
                                        wire:target="search">

                                        <x-table.cell>
                                            <x-input.check-input name="selected" value="{{ $wo->id }}" />
                                        </x-table.cell>

                                        <x-table.cell>
                                            {{ $wo->code }}
                                        </x-table.cell>

                                        <x-table.cell>{{ $wo->vehiclePlate->customer->name }}</x-table.cell>

                                        <x-table.cell>{{ $wo->vehiclePlate->license_plate }}</x-table.cell>

                                        <x-table.cell>{{ $wo->total }}</x-table.cell>

                                        <x-table.cell>
                                            {{ \Carbon\Carbon::parse($wo->date_emission)->format('d-m-Y') }}
                                        </x-table.cell>

                                        <x-table.cell class="text-center">
                                            <span
                                                class="badge badge-{{ $wo->confirmation_color }}-lighten">{{ strtoupper($wo->confirmation_name) }}</span>
                                        </x-table.cell>

                                        <x-table.cell>
                                            @if ($wo->is_confirmed == 0)
                                                <a class="btn btn-danger btn-sm mb-1"
                                                    wire:click="$emit('addDateWo',{{ $wo->id }})">
                                                    Confirmar
                                                </a>
                                            @endif

                                            <a class="btn btn-info btn-sm mb-1"
                                                href="{{ route('proforma.orden.editar', $wo->code) }}">
                                                Editar</a>

                                            <a class="btn btn-primary btn-sm mb-1"
                                                href="{{ route('proforma.pdf.view', $wo->id) }}">
                                                Ver</a>
                                            <a class="btn btn-warning btn-sm mb-1"
                                                href="{{ route('proforma.pdf.download', $wo->id) }}">
                                                Descargar</a>
                                            @if ($wo->is_confirmed == 1)
                                                <a class="btn btn-secondary btn-sm mb-1"
                                                    wire:click="$emit('payDuepay','{{ $wo->code }}')">
                                                    Pagar</a>
                                            @endif
                                        </x-table.cell>

                                    </x-table.row>
                                @empty
                                    <x-table.row>
                                        <x-table.cell class="text-center" colspan="8">
                                            No se encontraron proformas
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
@push('modals')
    @livewire('ot.ot-conf-modal')
    @livewire('due-pay.modal')
@endpush
