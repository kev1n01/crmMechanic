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
                                <button type="button" wire:click="create" class="btn btn-dark mb-2 me-2"><i
                                        class="mdi mdi-plus me-1"></i>
                                    Nuevo</button>
                                <button type="button" class="btn btn-light mb-2 dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones  <span
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
                                <div class="m-2" wire:target="showFilter">
                                    <div class="d-flex row justify-content-center">
                                        <x-input.input-group>
                                            <x-input.input-label name="filters.fromDate" label="Desde" class="me-2"
                                                type="date" />
                                            <x-input.input-label name="filters.toDate" label="Hasta" type="date"
                                                class="me-2" />

                                            <x-input.select name="filters.customer" label="Cliente" :options="$customers"
                                                class="me-2" />

                                            <x-input.select name="filters.model_year" label="Año" :options="$years"
                                                class="me-2" />

                                            <x-input.select name="filters.type" label="Tipo" :options="$types"
                                                class="me-2" />

                                            <x-input.select name="filters.brand" label="Marca" :options="$brands"
                                                class="me-2" />

                                            <x-input.select name="filters.model" label="Modelo" :options="$models"
                                                class="me-2" />

                                            <x-input.select name="filters.color" label="Color" :options="$colors"
                                                class="me-2" />
                                        </x-input.input-group>

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

                                <x-table.heading sortable wire:click="sortBy('license_plate')" :direction="$sortField == 'license_plate' ? $sortDirection : null">Placa
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('customer_id')" :direction="$sortField == 'customer_id' ? $sortDirection : null">Cliente
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('type_vehicle')" :direction="$sortField == 'type_vehicle' ? $sortDirection : null">Tipo
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('brand_vehicle')" :direction="$sortField == 'brand_vehicle' ? $sortDirection : null">Marca
                                </x-table.heading>
                                
                                <x-table.heading sortable wire:click="sortBy('model_vehicle')" :direction="$sortField == 'model_vehicle' ? $sortDirection : null">Model
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('color_vehicle')" :direction="$sortField == 'color_vehicle' ? $sortDirection : null">Color
                                </x-table.heading>
                               
                                <x-table.heading sortable wire:click="sortBy('model_year')" :direction="$sortField == 'model_year' ? $sortDirection : null">Año
                                </x-table.heading>
                                
                                <x-table.heading sortable wire:click="sortBy('odo')" :direction="$sortField == 'odo' ? $sortDirection : null">ODO
                                </x-table.heading>

                                <x-table.heading>Acción</x-table.heading>

                            </x-slot>


                            <x-slot name="body">

                                @forelse ($vehicles as $vehicle)
                                    <x-table.row wire:key="row-{{ $vehicle->id }}" wire:loading.class="bg-light"
                                        wire:target="search">

                                        <x-table.cell>
                                            <x-input.check-input name="selected" value="{{ $vehicle->id }}" />
                                        </x-table.cell>
                                        <x-table.cell>{{ $vehicle->license_plate }}</x-table.cell>
                                        <x-table.cell>{{ $vehicle->customer->name }}</x-table.cell>
                                        <x-table.cell>{{ $vehicle->type->name }}</x-table.cell>
                                        <x-table.cell>{{ $vehicle->brand->name }}</x-table.cell>
                                        <x-table.cell>{{ $vehicle->model->name }}</x-table.cell>
                                        <x-table.cell>{{ $vehicle->color->name }}</x-table.cell>
                                        <x-table.cell>{{ $vehicle->model_year }}</x-table.cell>
                                        <x-table.cell>{{ $vehicle->odo }}</x-table.cell>

                                        <x-table.cell>
                                            <a class="action-icon" wire:click="edit({{ $vehicle->id }})">
                                                <i class="mdi mdi-square-edit-outline"></i> </a>
                                            <a class="action-icon" onclick="Confirm({{ $vehicle->id }}, 'delete')"><i
                                                    class="mdi mdi-delete"></i></a>
                                        </x-table.cell>

                                    </x-table.row>

                                @empty
                                        <x-table.row>
                                            <x-table.cell class="text-center" colspan="10">
                                                No hay vehiculos encontrados
                                            </x-table.cell>
                                        </x-table.row>
                                @endforelse

                            </x-slot>

                        </x-table>

                        {{ $vehicles->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <x-form method="save">
        <x-modal-dialog :id="$idModal" :title="$nameModal" :optionsModal="$modalsize">
            <x-slot name="body">
                <x-input.input-group>
                    <x-input.input-tooltip-error class="col-12" name="editing.license_plate" label="Placa de vehiculo"
                        type="text" :error="$errors->first('editing.license_plate')" :required=true />
                </x-input.input-group>
           
                <x-input.input-group>
                    <x-input.input-tooltip-error class="col-12" name="editing.odo" label="Kilometraje"
                        type="text" :error="$errors->first('editing.odo')" :required=true />
                </x-input.input-group>

                <x-input.input-group>
                    <x-input.select class="col-12" name="editing.customer_id" label="Cliente" :options="$customers"
                        :error="$errors->first('editing.customer_id')" />
                </x-input.input-group>

                <x-input.input-group>
                    <x-input.select class="col-12" name="editing.type_vehicle" label="Tipo de vehiculo" :options="$types"
                        :error="$errors->first('editing.type_vehicle')" :required=true />
                </x-input.input-group>

                <x-input.input-group>
                    <x-input.select class="col-12" name="editing.brand_vehicle" label="Marca de vehiculo" :options="$brands"
                        :error="$errors->first('editing.brand_vehicle')" :required=true />
                </x-input.input-group>

                <x-input.input-group>
                    <x-input.select class="col-12" name="editing.model_vehicle" label="Tipo de vehiculo" :options="$types"
                        :error="$errors->first('editing.model_vehicle')" :required=true />
                </x-input.input-group>

                <x-input.input-group>
                    <x-input.select class="col-12" name="editing.color_vehicle" label="Color de vehiculo" :options="$colors"
                        :error="$errors->first('editing.color_vehicle')" :required=true />
                </x-input.input-group>

                <x-input.input-group>
                    <x-input.select class="col-12" name="editing.model_year" label="Año" :options="$years"
                        :error="$errors->first('editing.model_year')" />
                </x-input.input-group>

                <x-input.textarea class="col-xl-3 " name="editing.description" label="Descripción" />


                <x-input.input-group>
                    <x-input.input-tooltip-error class="col-12" name="image" label="Imagen de vehiculo"
                        type="file" :error="$errors->first('image')" />
                </x-input.input-group>

                <div class="col-12 shadow-none bg-light rounded">
                    @if ($image)
                        <img src="{{ $image->temporaryURL() }}" class="img-fluid m-2">
                    @else
                        @if ($editing->image)
                            <img src="{{ asset('storage/' . $editing->image_product) }}" class="img-fluid m-2">
                        @endif
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
@push('styles')
@endpush
@push('js')
    <script>
        window.addEventListener('close-modal', event => {
            $('#vehicleModal').modal('hide');
        });
        window.addEventListener('open-modal', event => {
            $('#vehicleModal').modal('show');
        });
    </script>
@endpush
