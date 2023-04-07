@section('title', 'Ordenes de trabajo')
<div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-xl-7">
                            <div class="row">
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
                                <a type="button" href="{{ route('orden.crear') }}" class="btn btn-dark mb-2 me-2"><i
                                        class="mdi mdi-plus me-1"></i>
                                    Nuevo</a>
                            </div>
                        </div>

                        @if ($showFilters)
                            <div class="w-100 border shadow-none bg-light rounded ">
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
                                        <x-input.select name="filters.type" label="Tipo de atencion"
                                            :options="$types" />
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
                                <x-table.heading sortable wire:click="sortBy('customer')" :direction="$sortField == 'customer' ? $sortDirection : null">Cliente
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('vehicle')" :direction="$sortField == 'vehicle' ? $sortDirection : null">Vehiculo
                                </x-table.heading>

                                <x-table.heading>F H llegada</x-table.heading>

                                <x-table.heading>F H salida</x-table.heading>

                                <x-table.heading>Atencion</x-table.heading>

                                <x-table.heading>Estado</x-table.heading>

                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>

                            <x-slot name="body">
                                @forelse ($works as $wo)
                                    <x-table.row wire:key="row-{{ $wo->id }}" wire:loading.class="bg-light"
                                        wire:target="search">
                                        <x-table.cell>{{ $wo->vehiclePlate->customer->name }}</x-table.cell>

                                        <x-table.cell>{{ $wo->vehiclePlate->license_plate }}</x-table.cell>

                                        <x-table.cell>
                                            @if ($wo->arrival_date != null)
                                                {{ \Carbon\Carbon::parse($wo->arrival_date)->format('d-m-Y') .
                                                    ', ' .
                                                    \Carbon\Carbon::parse($wo->arrival_hour)->format('g:i a') }}
                                            @else
                                                N/H
                                            @endif
                                        </x-table.cell>

                                        <x-table.cell>
                                            @if ($wo->departure_date != null)
                                                {{ \Carbon\Carbon::parse($wo->departure_date)->format('d-m-Y') .
                                                    ', ' .
                                                    \Carbon\Carbon::parse($wo->departure_hour)->format('g:i a') }}
                                            @else
                                                N/H
                                            @endif
                                        </x-table.cell>

                                        <x-table.cell>
                                            <span
                                                class="badge badge-{{ $wo->type_color }}-lighten">{{ strtoupper($wo->type_atention) }}</span>
                                        </x-table.cell>
                                        <x-table.cell>
                                            <button
                                                class="btn btn-outline-{{ $wo->status_color }} rounded-pill btn-sm w-100"
                                                type="button" wire:click="changeStatus({{ $wo->id }})">
                                                {{ strtoupper($wo->status) }}
                                                @if ($wo->status === 'en progreso')
                                                    @if ($wo->departure_date != null && $wo->departure_hour != null)
                                                        @if (date('Y-m-d H:i:s') > $wo->departure_date . ' ' . $wo->departure_hour)
                                                            <span
                                                                wire:init="updateStatusToDelayed({{ $wo->id }})"></span>
                                                        @endif
                                                    @endif
                                                @endif
                                            </button>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <a class="btn btn-danger btn-sm mb-1"
                                                wire:click="$emit('addDateWo',{{ $wo->id }})">
                                                Horarios
                                            </a>

                                            <a class="btn btn-info btn-sm mb-1"
                                                href="{{ route('orden.editar', $wo->code) }}">
                                                Editar</a>

                                            <a class="btn btn-primary btn-sm mb-1"
                                                href="{{ route('proforma.pdf.view', $wo->id) }}">
                                                Ver</a>
                                            <a class="btn btn-warning btn-sm mb-1"
                                                href="{{ route('proforma.pdf.download', $wo->id) }}">
                                                Descargar</a>

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
@push('modals')
    @livewire('ot.ot-conf-modal')
@endpush
