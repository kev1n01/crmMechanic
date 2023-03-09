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
                                <button type="button" wire:click="create" class="btn btn-dark mb-2 me-2"><i
                                        class="mdi mdi-plus me-1"></i>
                                    Nuevo</button>

                                <button type="button" class="btn btn-light mb-2 me-2 dropdown-toggle"
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
                                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                                            class="mdi mdi-upload"></i>Importar</button>
                                </div>

                                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                                    aria-labelledby="offcanvasRightLabel">
                                    <div class="offcanvas-header text-center">
                                        <h5 id="offcanvasRightLabel">Importar deudas por cobrar</h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        @livewire('due-pay.import')
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($showFilters)
                            <div class="w-100 border shadow-none bg-light rounded">
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

                                <x-table.heading sortable wire:click="sortBy('description')" :direction="$sortField == 'description' ? $sortDirection : null">
                                    Descripcion
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('person_owed')" :direction="$sortField == 'person_owed' ? $sortDirection : null">Deudor
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('amount_owed')" :direction="$sortField == 'amount_owed' ? $sortDirection : null">Monto
                                    adeudado
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('amount_paid')" :direction="$sortField == 'amount_paid' ? $sortDirection : null">Monto
                                    pagado
                                </x-table.heading>

                                <x-table.heading>Monto restante</x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('reason')" :direction="$sortField == 'reason' ? $sortDirection : null">Razon
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sortField == 'created_at' ? $sortDirection : null">Fecha
                                </x-table.heading>

                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>


                            <x-slot name="body">
                                @forelse ($dues as $d)
                                    <x-table.row wire:key="row-{{ $d->id }}" wire:loading.class="bg-light"
                                        wire:target="search">
                                        <x-table.cell>
                                            <x-input.check-input name="selected" value="{{ $d->id }}" />
                                        </x-table.cell>

                                        <x-table.cell>
                                            {{-- {{ substr($d->description, -6, 1) }} --}}
                                            @if (substr($d->description, 0, 1) == 'V')
                                                <a href="{{ route('ventas.editar', $d->description) }}">
                                                    {{ substr($d->description, 0, 6) }}
                                                </a>
                                            @endif
                                            @if (substr($d->description, -6, 1) == 'P')
                                                <a
                                                    href="{{ route('proforma.orden.editar', substr($d->description, 9)) }}">
                                                    {{ substr($d->description, 9) }}
                                                </a>
                                            @else
                                                {{ $d->description }}
                                            @endif
                                        </x-table.cell>

                                        <x-table.cell>{{ $d->person_owed }}</x-table.cell>

                                        <x-table.cell>{{ number_format($d->amount_owed, 2) }}</x-table.cell>

                                        <x-table.cell>{{ number_format($d->amount_paid, 2) }}</x-table.cell>

                                        <x-table.cell>{{ number_format($d->amount_owed - $d->amount_paid, 2) }}
                                        </x-table.cell>

                                        <x-table.cell>{{ $d->reason }}</x-table.cell>

                                        <x-table.cell>
                                            {{ \Carbon\Carbon::parse($d->created_at)->format('d-m-Y') }}
                                            {{ \Carbon\Carbon::parse($d->created_at)->format('g i: a') }}
                                        </x-table.cell>

                                        <x-table.cell>

                                            <a class="action-icon" wire:click="edit({{ $d->id }})">
                                                <i class="mdi mdi-square-edit-outline"></i> </a>
                                            <a class="action-icon" onclick="Confirm({{ $d->id }}, 'delete')"><i
                                                    class="mdi mdi-delete"></i></a>
                                        </x-table.cell>

                                    </x-table.row>

                                @empty
                                    <x-table.row>
                                        <x-table.cell class="text-center" colspan="9">
                                            No hay deudas pendientes
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            {{ $dues->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-form method="save">
        <x-modal-dialog :id="$idModal" title="{{ $nameModal }}">
            <x-slot name="body">
                <div class="row g-2">
                    <x-input.input-tooltip-error class="col-xl-12" name="editing.description" label="Descripcion"
                        type="text" :error="$errors->first('editing.description')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.person_owed" label="Nombre deudor"
                        type="text" :error="$errors->first('editing.person_owed')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.amount_owed" label="Monto adeudado"
                        type="number" :error="$errors->first('editing.amount_owed')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.amount_paid" label="Monto pagado"
                        type="number" :error="$errors->first('editing.amount_paid')" :required=true />

                    <x-input.select class="col-xl-6" name="editing.reason" label="Razon" :options="$reasons"
                        :error="$errors->first('editing.reason')" :required=true />
                </div>
            </x-slot>

            <x-slot name="footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>

                <button type="submit" class="btn btn-primary">
                    <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                    Guardar
                </button>
            </x-slot>
        </x-modal-dialog>
    </x-form>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal', event => {
            $('#dueModal').modal('hide');
        });
        window.addEventListener('open-modal', event => {
            $('#dueModal').modal('show');
        });
    </script>
@endpush
