<div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-xl-7">
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
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <x-table>
                            <x-slot name="head">
                                <x-table.heading style="width: 20px;">
                                    @if (count($models) > 0)
                                        <x-input.check-input name="selectedPage" />
                                    @endif
                                </x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('id')" :direction="$sortField == 'id' ? $sortDirection : null">#
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('name')" :direction="$sortField == 'name' ? $sortDirection : null">Nombre
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sortField == 'created_at' ? $sortDirection : null">Fecha
                                    creación</x-table.heading>

                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>


                            <x-slot name="body">
                                @forelse ($models as $model)
                                    <x-table.row wire:key="row-{{ $model->id }}" wire:loading.class="bg-light"
                                        wire:target="search">
                                        <x-table.cell>
                                            <x-input.check-input name="selected" value="{{ $model->id }}" />
                                        </x-table.cell>
                                        <x-table.cell>{{ $model->id }}</x-table.cell>

                                        <x-table.cell>{{ $model->name }}</x-table.cell>

                                        <x-table.cell>{{ \Carbon\Carbon::parse($model->created_at)->format('d-m-Y') }}
                                        </x-table.cell>

                                        <x-table.cell>

                                            <a class="action-icon" wire:click="edit({{ $model->id }})">
                                                <i class="mdi mdi-square-edit-outline"></i> </a>
                                            <a class="action-icon" onclick="Confirm({{ $model->id }}, 'delete')"><i
                                                    class="mdi mdi-delete"></i></a>
                                        </x-table.cell>

                                    </x-table.row>
                                @empty
                                    <x-table.row>
                                        <x-table.cell class="text-center" colspan="5">
                                            No hay modelos encontrados
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            {{ $models->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-form method="save">
        <x-modal-dialog :id="$idModal" title="{{ $nameModal }}">
            <x-slot name="body">

                <x-input.input-group>
                    <x-input.input-group>
                        <x-input.input-tooltip-error class="col-12" name="editing.name" label="Nombre del modelo"
                            type="text" :error="$errors->first('editing.name')" :required=true />
                    </x-input.input-group>
                </x-input.input-group>

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
            $('#modelVehicleModal').modal('hide');
        });
        window.addEventListener('open-modal', event => {
            $('#modelVehicleModal').modal('show');
        });
    </script>
@endpush
