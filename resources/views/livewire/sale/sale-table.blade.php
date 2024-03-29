@section('title', 'Listado de ventas')
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
                                <a type="button" href="{{ route('ventas.crear') }}" class="btn btn-dark mb-2 me-2"><i
                                        class="mdi mdi-plus me-1"></i>
                                    Nuevo</a>
                                <button type="button" class="btn btn-light mb-2 dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span
                                        class="{{ count($selected) == 0 ? 'd-none' : '' }} fs-6 badge rounded-pill bg-primary">{{ count($selected) }}</span></button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item action-icon"
                                        @if ($selected != []) onclick="window.livewire.emit('exportSelected')" @else onclick="ToastErrorAlert('Seleccione algún registro')" @endif><i
                                            class="mdi mdi-download"></i> Exportar</button>
                                    {{-- <button class="dropdown-item action-icon"
                                        @if ($selected != []) onclick="Confirm(null,'deleteSelected')" @else onclick="ToastErrorAlert('Seleccione algún registro')" @endif><i
                                            class="mdi mdi-delete"></i>
                                        Eliminar</button> --}}
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
                                <div class="row m-1 mt-2">
                                    <div class="col-lg-3 mb-1 mb-1">
                                        <x-input.datepicker name="filters.fromDate" label="Desde" id="dp1" />
                                    </div>
                                    <div class="col-lg-3 mb-1">
                                        <x-input.datepicker name="filters.toDate" label="Hasta" id="dp2" />
                                    </div>
                                    <div class="col-lg-3 mb-1">
                                        <x-input.select name="filters.status" label="Estado" :options="$statuses" />
                                    </div>
                                    <div class="col-lg-3 mb-1">
                                        <x-input.select name="filters.method_payment" label="Metodo de pago"
                                            :options="$method_payments" />
                                    </div>
                                    <div class="col-lg-3 mb-1">
                                        <x-input.select name="filters.type_payment" label="Tipo de pago"
                                            :options="$type_payments" />
                                    </div>
                                    <div class="col-lg-3 mb-1">
                                        <x-input.select name="filters.type_sale" label="Tipo de venta"
                                            :options="$type_sales" />
                                    </div>

                                    <div class="col-lg-3 mb-1">
                                        <x-input.select name="filters.customer" label="Cliente" :options="$customers" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <x-table>
                            <x-slot name="head">

                                <x-table.heading style="width: 20px;">
                                    @if (count($sales) > 0)
                                        <x-input.check-input name="selectedPage" />
                                    @endif
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('code_sale')" :direction="$sortField == 'code_sale' ? $sortDirection : null">Código
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('customer_id')" :direction="$sortField == 'customer_id' ? $sortDirection : null">Cliente
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('date_sale')" :direction="$sortField == 'date_sale' ? $sortDirection : null">Fecha
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('total')" :direction="$sortField == 'total' ? $sortDirection : null">Total
                                </x-table.heading>

                                <x-table.heading class="text-center">Estado / Tipo</x-table.heading>

                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>


                            <x-slot name="body">

                                @forelse ($sales as $sale)
                                    <x-table.row wire:key="row-{{ $sale->id }}" wire:loading.class="bg-light"
                                        wire:target="search">

                                        <x-table.cell>
                                            <x-input.check-input name="selected" value="{{ $sale->id }}" />
                                        </x-table.cell>


                                        <x-table.cell>
                                            {{ substr($sale->code_sale, 0, 6) }}
                                            @if (substr($sale->code_sale, -6, 1) == 'P')
                                                -
                                                <a
                                                    href="{{ route('proforma.orden.editar', substr($sale->code_sale, 9)) }}">
                                                    {{ substr($sale->code_sale, 9) }}
                                                </a>
                                            @endif
                                        </x-table.cell>

                                        <x-table.cell>{{ $sale->customer->name ?? '' }}</x-table.cell>

                                        <x-table.cell>{{ \Carbon\Carbon::parse($sale->date_sale)->format('d-m-Y') }}
                                        </x-table.cell>

                                        <x-table.cell>{{ $sale->total }}</x-table.cell>

                                        <x-table.cell class="text-center">
                                            <span
                                                class="badge badge-{{ $sale->status_color }}-lighten fs-6">{{ strtoupper($sale->status) }}</span>
                                            <span
                                                class="badge badge-{{ $sale->type_color }}-lighten fs-6">{{ strtoupper($sale->type_sale) }}</span>
                                        </x-table.cell>

                                        <x-table.cell>
                                            @if ($sale->type_sale == 'comercial')
                                                    <a class="btn btn-info btn-sm mb-1"
                                                href="{{ route('ventas.editar', $sale->code_sale) }}">
                                                Editar</a>
                                                @if ($sale->status == 'no pagado')
                                                    <a class="btn btn-secondary btn-sm mb-1"
                                                        wire:click="$emit('payDuepay','{{ $sale->code_sale }}')">Pagar </a>
                                                @endif
                                            @endif
                                            @if ($sale->type_sale == 'vehicular')
                                                <a class="btn btn-info btn-sm mb-1"
                                                    href="{{ route('proforma.orden.editar', substr($sale->code_sale, 9)) }}">
                                                    Editar </a>
                                                @if ($sale->status == 'no pagado')
                                                    <a class="btn btn-secondary btn-sm mb-1"
                                                        href="{{ route('deudas') }}">
                                                       Pagar</a>
                                                @endif
                                            @endif

                                            <a class="btn btn-primary btn-sm mb-1"
                                                href="{{ route('venta.pdf.view', $sale->id) }}">Ver</a>
                                            <a class="btn btn-warning btn-sm mb-1"
                                                href="{{ route('venta.pdf.download', $sale->id) }}">
                                                Descargar</a>
                                        </x-table.cell>
                                    </x-table.row>
                                @empty
                                    <x-table.row>
                                        <x-table.cell class="text-center" colspan="8">
                                            No hay ventas encontradas
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            {{ $sales->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@livewire('due-pay.modal')
