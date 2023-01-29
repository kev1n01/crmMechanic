<div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <x-input.select class="col-xl-12" name="vehicle_plate" label="Placa" :required=true
                                :options="$plates" :error="$errors->first('vehicle_plate')" />

                            <x-input.datepicker class="col-xl-12" name="fromDate" label="Desde" id="dp1"
                                :error="$errors->first('fromDate')" :required=true />

                            <x-input.datepicker class="col-xl-12" name="toDate" label="Hasta" id="dp2"
                                :error="$errors->first('toDate')" :required=true />

                            <button type="button" wire:click="consult" class="btn btn-primary col-xl-12 mt-3">
                                <span wire:loading.delay wire:target="consult"
                                    class="spinner-border spinner-border-sm"></span>
                                Consultar
                            </button>

                            <div class="col-xl-12 mt-3">
                                <div class="border pt-2 p-0 rounded shadow-none bg-light">
                                    <h4 class="header-title mb-1 text-center">GASTOS</h4>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Total:</td>
                                                    <td>S/{{ number_format($total, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Repuesto:</td>
                                                    <td>S/{{ number_format($total_replacement, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Servicio:</td>
                                                    <td>S/{{ number_format($total_service, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body pt-2">

                            {{-- <div class="border border-secondary rounded mb-2 mt-1">
                                <div class="d-flex flex-row-reverse bd-highlight">
                                    <div class="p-1 bd-highlight">
                                        <button class="btn btn-danger">Exportar en pdf</button>
                                    </div>
                                    <div class="p-1 bd-highlight">
                                        <button class="btn btn-success">Exportar en csv</button>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="table-responsive">
                                <x-table class="table-striped table-centered">
                                    <x-slot name="head">
                                        <th>Codigo</th>
                                        <th>ODO</th>
                                        <th>Estado</th>
                                        <th>Total</th>
                                        <th>Acción</th>
                                    </x-slot>

                                    <x-slot name="body">
                                        @forelse($ots as $ot)
                                            <x-table.row>
                                                <x-table.cell>{{ $ot->code }}</x-table.cell>

                                                <x-table.cell>{{ $ot->odo }}</x-table.cell>

                                                <x-table.cell>
                                                    <span class="badge badge-{{ $ot->status_color }}-lighten">
                                                        {{ strtoupper($ot->status) }}
                                                    </span>
                                                </x-table.cell>

                                                <x-table.cell>S/ {{ number_format($ot->total, 2) }}</x-table.cell>

                                                <x-table.cell>
                                                    <a class="action-icon"
                                                        wire:click.prevent="viewDetails({{ $ot->id }})"><i
                                                            class="mdi mdi-eye-outline"></i></a>
                                                </x-table.cell>
                                            </x-table.row>
                                        @empty
                                            <x-table.row>
                                                <x-table.cell class="text-center" colspan="5">
                                                    No hay ordenes de trabajo para este vehiculo o en las fechas
                                                    seleccionadas
                                                </x-table.cell>
                                            </x-table.row>
                                        @endif

                                    </x-slot>
                                </x-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal-dialog :id="$idModal" title="{{ $nameModal }}" optionsModal="{{ $modalsize }}">
        <x-slot name="body">
            <div class="table-responsive">
                <x-table class="table-bordered table-striped table-centered">
                    <x-slot name="head">
                        <th class="text-left">Kilometraje</th>
                        <th class="text-left">F/H llegada</th>
                        <th class="text-left">F/H Salida</th>
                        <th class="text-left">Observacion</th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($ot_dt as $od)
                            <x-table.row>
                                <x-table.cell class="text-center">{{ $od->odo }}</x-table.cell>
                                <x-table.cell class="text-center">{{ $od->arrival_date .'/'.$od->arrival_hour }}</x-table.cell>
                                <x-table.cell class="text-center">{{ $od->departure_date .'/'.$od->departure_hour ?? 'S/F'}}</x-table.cell>
                                <x-table.cell>{{ $od->observation }}</x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
            
            <h3 class="fs-4 text-center">Información del Cliente</h3>
            <div class="table-responsive">
                <x-table class="table-bordered table-striped table-centered">
                    <x-slot name="head">
                        <th class="text-left">Nombre</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Phone</th>
                        <th class="text-left">Dni</th>
                        <th class="text-left">Ruc</th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($ot_dt as $od)
                            <x-table.row>
                                <x-table.cell>{{ $od->customerUser->name }}</x-table.cell>
                                <x-table.cell>{{ $od->customerUser->email }}</x-table.cell>
                                <x-table.cell>{{ $od->customerUser->phone }}</x-table.cell>
                                <x-table.cell>{{ $od->customerUser->dni }}</x-table.cell>
                                <x-table.cell>{{ $od->customerUser->ruc }}</x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>

            <h3 class="fs-4 text-center">Lista de servicios</h3>
            <div class="table-responsive">
                <x-table footer class="table-bordered table-striped table-centered">
                    <x-slot name="head">
                        <th class="text-left">Descripcion</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Precio U.</th>
                        <th class="text-center">Importe</th>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($wod_service as $d)
                            <x-table.row>
                                <x-table.cell>{{ $d->concept->name }}</x-table.cell>
                                <x-table.cell class="text-center">{{ $d->quantity }}</x-table.cell>
                                <x-table.cell class="text-center">{{ number_format($d->price, 2) }}</x-table.cell>
                                <x-table.cell class="text-center">S/ {{ number_format($d->quantity * $d->price, 2) }}</x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                    <x-slot name="foot">
                        <td class="text-right">
                            <h6 class="text-primary fs-5">TOTALES: </h6>
                        </td>
                        <td class="text-center">
                            @if ($wod_service)
                                <h6 class="text-primary fs-5">{{ $wod_service->sum('quantity') }}</h6>
                            @endif
                        </td>
                        @if ($wod_service)
                            @php $mytotal = 0; @endphp
                            @foreach ($wod_service as $d)
                                @php $mytotal += $d->quantity * $d->price; @endphp
                            @endforeach
                            <td></td>
                            <td class="text-center">
                                <h6 class="text-primary fs-5">S/ {{ number_format($mytotal, 2) }}</h6>
                            </td>
                        @endif
                    </x-slot>
                </x-table>
            </div>

            <h3 class="fs-4 text-center">Lista de repuestos</h3>
            <div class="table-responsive">
                <x-table footer class="table-bordered table-striped table-centered">
                    <x-slot name="head">
                        <th class="text-left">Descripcion</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Precio U.</th>
                        <th class="text-center">Importe</th>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($wod_replacement as $d)
                            <x-table.row>
                                <x-table.cell>{{ $d->product->name }}</x-table.cell>
                                <x-table.cell class="text-center">{{ $d->quantity }}</x-table.cell>
                                <x-table.cell class="text-center">{{ number_format($d->price, 2) }}</x-table.cell>
                                <x-table.cell class="text-center">S/ {{ number_format($d->quantity * $d->price, 2) }}</x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                    <x-slot name="foot">
                        <td class="text-right">
                            <h6 class="text-primary fs-5">TOTALES: </h6>
                        </td>
                        <td class="text-center">
                            @if ($wod_replacement)
                                <h6 class="text-primary fs-5">{{ $wod_replacement->sum('quantity') }}</h6>
                            @endif
                        </td>
                        @if ($wod_replacement)
                            @php $mytotal = 0; @endphp
                            @foreach ($wod_replacement as $d)
                                @php $mytotal += $d->quantity * $d->price; @endphp
                            @endforeach
                            <td></td>
                            <td class="text-center">
                                <h6 class="text-primary fs-5">S/ {{ number_format($mytotal, 2) }}</h6>
                            </td>
                        @endif
                    </x-slot>
                </x-table>
            </div>
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-modal-dialog>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal', event => {
            $('#detailOtModal').modal('hide');
        });
        window.addEventListener('open-modal', event => {
            $('#detailOtModal').modal('show');
        });
    </script>
@endpush
