@section('title', 'Listado de comprobantes')
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
                                <a type="button" href="{{ route('sunat.crear.comprobante') }}"
                                    class="btn btn-dark mb-2 me-2"><i class="mdi mdi-plus me-1"></i>
                                    Nuevo</a>
                                <button type="button" class="btn btn-light mb-2 dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span
                                        class="{{ count($selected) == 0 ? 'd-none' : '' }} fs-6 badge rounded-pill bg-primary">{{ count($selected) }}</span></button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item action-icon"
                                        @if ($selected != []) onclick="window.livewire.emit('exportSelected')" @else onclick="ToastErrorAlert('Seleccione algún registro')" @endif><i
                                            class="mdi mdi-download"></i> Exportar</button>
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
                                    <div class="col-lg-3">
                                        <x-input.datepicker name="filters.fromDate" label="Desde" id="dp1" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.datepicker name="filters.toDate" label="Hasta" id="dp2" />
                                    </div>
                                    {{-- <div class="col-lg-3">
                                        <x-input.select name="filters.status" label="Estado" :options="$statuses" />
                                    </div> --}}
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.type_payment" label="Tipo de pago"
                                            :options="$type_payments" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.type_cpe" label="Tipo comprobante"
                                            :options="$type_cpes" />
                                    </div>

                                    <div class="col-lg-3">
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
                                    @if (count($comprobants) > 0)
                                        <x-input.check-input name="selectedPage" />
                                    @endif
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('correlativo')" :direction="$sortField == 'correlativo' ? $sortDirection : null">Número
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('fechaEmision')" :direction="$sortField == 'fechaEmision' ? $sortDirection : null">Fecha
                                    emisión
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('moneda')" :direction="$sortField == 'moneda' ? $sortDirection : null">Moneda
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('tipoPago')" :direction="$sortField == 'tipoPago' ? $sortDirection : null">Tipo pago
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('cliente->rznSocial')" :direction="$sortField == 'cliente->rznSocial)' ? $sortDirection : null">
                                    Cliente
                                </x-table.heading>


                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>


                            <x-slot name="body">

                                @forelse ($comprobants as $comprobant)
                                    <x-table.row wire:key="row-{{ $comprobant->id }}" wire:loading.class="bg-light"
                                        wire:target="search">

                                        <x-table.cell>
                                            <x-input.check-input name="selected" value="{{ $comprobant->id }}" />
                                        </x-table.cell>

                                        <x-table.cell>{{ $comprobant->serie . '-' . $comprobant->correlativo }}
                                        </x-table.cell>

                                        <x-table.cell>
                                            {{ \Carbon\Carbon::parse($comprobant->fechaEmision)->format('d-m-Y') }}
                                        </x-table.cell>

                                        <x-table.cell>
                                            {{ $comprobant->moneda }}
                                        </x-table.cell>

                                        <x-table.cell>
                                            {{ $comprobant->tipoPago }}
                                        </x-table.cell>

                                        <x-table.cell>
                                            @php
                                                $jsoncust = json_decode($comprobant->cliente, true);
                                            @endphp
                                            {{ $jsoncust['rznSocial'] }}
                                        </x-table.cell>

                                        <x-table.cell>
                                            <a class="btn btn-primary btn-sm mb-1"
                                                href="{{ route('comprobante.pdf.view', $comprobant->id) }}">Ver</a>
                                            <a class="btn btn-warning btn-sm mb-1"
                                                href="{{ route('comprobante.pdf.download', $comprobant->id) }}">
                                                Descargar</a>
                                        </x-table.cell>
                                    </x-table.row>
                                @empty
                                    <x-table.row>
                                        <x-table.cell class="text-center" colspan="8">
                                            No hay comprobantes encontrados
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            {{ $comprobants->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
