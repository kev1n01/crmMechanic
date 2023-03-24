@section('title', 'Listado de compras')
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
                                <a type="button" href="{{ route('compras.crear') }}" class="btn btn-dark mb-2 me-2"><i
                                        class="mdi mdi-plus me-1"></i>
                                    Nuevo</a>
                                <button type="button" class="btn btn-light mb-2 dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones <span
                                        class="{{ count($selected) == 0 ? 'd-none' : '' }} fs-6 badge rounded-pill bg-primary">{{ count($selected) }}</span></button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item action-icon"
                                        @if (count($selected) > 0) onclick="window.livewire.emit('exportSelected')" @else onclick="ToastErrorAlert('Seleccione algún registro')" @endif><i
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
                                <div class="row m-1 mt-2">
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
                                        <x-input.select name="filters.provider" label="Proveedor" :options="$providers" />
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

                                <x-table.heading sortable wire:click="sortBy('code_purchase')" :direction="$sortField == 'code_purchase' ? $sortDirection : null">Código
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('provider_id')" :direction="$sortField == 'provider_id' ? $sortDirection : null">Proveedor
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('date_purchase')" :direction="$sortField == 'date_purchase' ? $sortDirection : null">Fecha
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('total')" :direction="$sortField == 'total' ? $sortDirection : null">Total
                                </x-table.heading>

                                <x-table.heading class="text-center">Estado</x-table.heading>

                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>

                            <x-slot name="body">
                                @forelse ($purchases as $purchase)
                                    <x-table.row wire:key="row-{{ $purchase->id }}" wire:loading.class="bg-light"
                                        wire:target="search">

                                        <x-table.cell>
                                            <x-input.check-input name="selected" value="{{ $purchase->id }}" />
                                        </x-table.cell>

                                        <x-table.cell>{{ $purchase->code_purchase }}</x-table.cell>

                                        <x-table.cell>{{ $purchase->provider->name ?? '' }}</x-table.cell>

                                        <x-table.cell>
                                            {{ \Carbon\Carbon::parse($purchase->date_purchase)->format('d-m-Y') }}
                                        </x-table.cell>

                                        <x-table.cell>{{ $purchase->total }}</x-table.cell>

                                        <x-table.cell class="text-center">
                                            <button
                                                class="btn btn-outline-{{ $purchase->status_color }} rounded-pill btn-sm w-100"
                                                type="button" wire:click="changeStatus({{ $purchase->id }})">
                                                {{ strtoupper($purchase->status) }}
                                            </button>
                                        </x-table.cell>

                                        <x-table.cell>
                                            @if ($purchase->status == 'pendiente')
                                                <a class="action-icon cursor"
                                                    href="{{ route('compras.editar', $purchase->code_purchase) }}">
                                                    <i class="mdi mdi-square-edit-outline"></i></a>
                                            @endif
                                            {{-- <a class="action-icon cursor" onclick="Confirm({{ $purchase->id }}, 'delete')"><i
                                                    class="mdi mdi-delete"></i></a> --}}
                                            <a class="action-icon cursor"
                                                href="{{ route('compra.pdf.view', $purchase->id) }}">
                                                <i class="mdi mdi-file-eye-outline"></i></a>
                                            <a class="action-icon cursor"
                                                href="{{ route('compra.pdf.download', $purchase->id) }}">
                                                <i class="mdi mdi-folder-download-outline"></i></a>
                                        </x-table.cell>
                                    </x-table.row>
                                @empty
                                    <x-table.row>
                                        <x-table.cell class="text-center" colspan="8">
                                            No hay compras encontradas
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            {{ $purchases->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
