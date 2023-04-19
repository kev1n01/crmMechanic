@section('title', 'Recordatorios')
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
                                    {{-- <button class="dropdown-item action-icon" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                                            class="mdi mdi-upload"></i>Importar</button> --}}
                                </div>

                                {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                                    aria-labelledby="offcanvasRightLabel">
                                    <div class="offcanvas-header text-center">
                                        <h5 id="offcanvasRightLabel">Importar gastos</h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        @livewire('r.import')
                                    </div>
                                </div> --}}
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
                                    <div class="col-lg-3">
                                        <x-input.select name="filters.vehicle_id" label="Vehiculo" :options="$vehicles" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive ">
                        <x-table>
                            <x-slot name="head">

                                <x-table.heading style="width: 20px;">
                                    <x-input.check-input name="selectedPage" />
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('description')" :direction="$sortField == 'description' ? $sortDirection : null">
                                    Descripción
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('vehicle_id')" :direction="$sortField == 'vehicle_id' ? $sortDirection : null">Vehiculo
                                </x-table.heading>

                                <x-table.heading>Cliente</x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('date')" :direction="$sortField == 'date' ? $sortDirection : null">Fecha
                                    recordatorio
                                </x-table.heading>

                                <x-table.heading>Estado</x-table.heading>

                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>


                            <x-slot name="body">

                                @forelse ($reminders as $r)
                                    <x-table.row wire:key="row-{{ $r->id }}" wire:loading.class="bg-light"
                                        wire:target="search">

                                        <x-table.cell>
                                            <x-input.check-input name="selected" value="{{ $r->id }}" />
                                        </x-table.cell>

                                        <x-table.cell class="text-wrap w-25">{{ $r->description }}</x-table.cell>

                                        <x-table.cell>{{ $r->vehicle->license_plate }}</x-table.cell>

                                        <x-table.cell>{{ $r->vehicle->customer->name }}</x-table.cell>

                                        <x-table.cell class="text-center fs-4">
                                            <span
                                                class="badge bg-{{ date('Y-m-d') >= $r->date ? 'danger' : 'info' }}">{{ $r->date }}</span>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <button
                                                class="btn btn-outline-{{ $r->status_color }} rounded-pill btn-sm w-100" wire:click="changeStatus({{ $r->id }})"
                                                type="button">
                                                {{ strtoupper($r->status) }}

                                                @if (date('Y-m-d') >= $r->date)
                                                    <span
                                                        wire:init="addNotificationReminderExpired({{ $r->id }})"></span>
                                                @endif
                                            </button>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <a class="btn btn-success btn-sm mb-1" target="_blank"
                                                href="https://api.whatsapp.com/send?phone=51{{ $r->vehicle->customer->phone }}&text={{ $r->description }}">
                                                Enviar
                                            <i class="mdi mdi-whatsapp"></i></a>

                                            <a class="btn btn-info btn-sm mb-1" wire:click="edit({{ $r->id }})">
                                                Editar</a>

                                            <a class="btn btn-danger btn-sm mb-1"
                                                onclick="Confirm({{ $r->id }}, 'delete')">
                                                Eliminar</a>
                                        </x-table.cell>

                                    </x-table.row>

                                @empty
                                    <x-table.row>
                                        <x-table.cell class="text-center" colspan="7">
                                            No hay informes encontrados
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            {{ $reminders->links() }}
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
                    <x-input.textarea class="col-xl-12" name="editing.description" label="Observaciones" rows="3"
                        :error="$errors->first('editing.description')" :required=true />

                    <x-input.datepicker class="col-xl-6" name="editing.date" label="Fecha recordatorio"
                        id="dp3" :error="$errors->first('editing.date')" :required=true />

                    <x-input.select class="col-xl-6" name="editing.status" label="Estado" :options="$statuses"
                        :error="$errors->first('editing.status')" />

                    <x-input.select class="col-xl-6" name="editing.vehicle_id" label="Vehiculo" :options="$vehicles"
                        :error="$errors->first('editing.vehicle_id')" />

                    @if ($editing->vehicle_id)
                        <x-input.input-tooltip-error class="col-xl-6" name="customername" label="Cliente"
                            type="text" :disabled=true />
                    @endif
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
        window.addEventListener('close-modal-reminder', event => {
            $('#reminderModal').modal('hide');
        });
        window.addEventListener('open-modal-reminder', event => {
            $('#reminderModal').modal('show');
        });
    </script>
@endpush
