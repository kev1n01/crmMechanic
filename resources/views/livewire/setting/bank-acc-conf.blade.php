<div>
    <x-form method="save">
        <div class="card">
            <div class="card-body">
                <div class="row g-2">
                    <x-input.input-tooltip-error class="col-xl-12" name="editing.name" label="Nombre del banco"
                        type="text" :error="$errors->first('editing.name')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.cta_bank" label="Cuenta bancaria"
                        type="text" :error="$errors->first('editing.cta_bank')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.cta_interbank"
                        label="Cuenta interbancaria" type="text" :error="$errors->first('editing.cta_interbank')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.nro" label="Número de billetera"
                        type="text" :error="$errors->first('editing.nro')" :required=true max="9" />
                </div>
            </div>
            <div class="d-flex flex-row-reverse bd-highlight mt-1 mb-3">
                <button type="submit" class="btn btn-primary me-3">
                    <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                    Guardar
                </button>
            </div>
        </div>
    </x-form>

    <div class="table-responsive">
        <x-table>
            <x-slot name="head">
                <x-table.heading sortable wire:click="sortBy('name')" :direction="$sortField == 'name' ? $sortDirection : null">Nombre
                </x-table.heading>

                <x-table.heading sortable wire:click="sortBy('cta_bank')" :direction="$sortField == 'cta_bank' ? $sortDirection : null">Numero de referencia
                </x-table.heading>

                <x-table.heading>Acción</x-table.heading>

            </x-slot>

            <x-slot name="body">
                @forelse ($banksacc as $bc)
                    <x-table.row>
                        <x-table.cell class="text-wrap w-25">{{ $bc->name }}</x-table.cell>

                        <x-table.cell>
                            @if ($bc->cta_bank)
                                {{ $bc->cta_bank }} <br> {{ $bc->cta_interbank }}
                            @else    
                                {{ $bc->nro }}
                            @endif
                        </x-table.cell>

                        <x-table.cell>
                            <a class="btn btn-info btn-sm mb-1" wire:click="edit({{ $bc->id }})">
                                Editar</a>

                            <a class="btn btn-danger btn-sm mb-1" onclick="Confirm({{ $bc->id }}, 'delete')">
                                Eliminar</a>
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell class="text-center" colspan="4">
                            No hay cuentas de bancos encontrados
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>
    </div>
</div>
