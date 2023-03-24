@section('title', 'Reporte de OT' )
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

                            {{-- <div class="rounded mb-2 mt-1">
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
                                                <x-table.cell>
                                                    <a href="{{ route('proforma.orden.editar', $ot->code) }}">
                                                        {{ $ot->code }}</a>
                                                </x-table.cell>

                                                <x-table.cell>{{ $ot->odo }}</x-table.cell>

                                                <x-table.cell>
                                                    <span class="badge badge-{{ $ot->status_color }}-lighten">
                                                        {{ strtoupper($ot->status) }}
                                                    </span>
                                                </x-table.cell>

                                                <x-table.cell>S/ {{ number_format($ot->total, 2) }}</x-table.cell>

                                                <x-table.cell>
                                                    <a class="action-icon"
                                                    href="{{ route('proforma.pdf.preview', $ot->id) }}" target="_blank"
                                                        {{-- wire:click="viewDetails({{ $ot->id }})" --}}
                                                        ><i
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
            {{-- @if ($ot_dt)

                <div class="table-responsive">
                    <x-table class="table-bordered">
                        <x-slot name="head">

                        </x-slot>
                        <x-slot name="body">
                            <tr>
                                <th>Fecha/Hora de llegada</td>
                                <td>
                                    {{ $ot_dt->arrival_date != null
                                        ? \Carbon\Carbon::parse($ot_dt->arrival_date)->format('d-m-Y') .
                                            ' , ' .
                                            \Carbon\Carbon::parse($ot_dt->arrival_hour)->format('g:i a')
                                        : 'No especificado' }}
                                </td>
                                <th>Estado</th>
                                <td>
                                    {{ $ot_dt->status }}
                                </td>

                            </tr>
                            <tr>
                                <th>Fecha/Hora de salida</th>
                                <td>
                                    {{ $ot_dt->departure_date != null
                                        ? \Carbon\Carbon::parse($ot_dt->departure_date)->format('d-m-Y') .
                                            ' , ' .
                                            \Carbon\Carbon::parse($ot_dt->departure_hour)->format('g:i a ')
                                        : 'No especificado' }}
                                </td>
                                <th>Código</th>
                                <td>{{ $ot_dt->code }}</td>
                            </tr>
                            <tr>
                                <th>Observaciones</th>
                                <td colspan="3">{{ $ot_dt->observation ?? 'Ninguno' }}</td>
                            </tr>
                        </x-slot>
                    </x-table>
                </div>

                <h3 class="fs-4 text-center">Información del Cliente</h3>
                <div class="table-responsive">
                    <x-table class="table-bordered">
                        <x-slot name="head">

                        </x-slot>
                        <x-slot name="body">
                            <tr>
                                <th>Señor(a)</th>
                                <td>{{ $ot_dt->customerUser->name }}</td>

                                <th>Dni</th>
                                <td>{{ $ot_dt->customerUser->dni }}</td>
                            </tr>
                            <tr>
                                <th>Estado</th>
                                <td>{{ $ot_dt->customerUser->status }}</td>

                                <th>Ruc</th>
                                <td>{{ $ot_dt->customerUser->ruc }}</td>
                            </tr>
                            <tr>
                                <th>Dirección</th>
                                <td>{{ $ot_dt->customerUser->address }}</td>

                                <th>Telófono</th>
                                <td>{{ $ot_dt->customerUser->phone }}</td>
                            </tr>
                        </x-slot>
                    </x-table>
                </div>

                <h3 class="fs-4 text-center">Información del Vehiculo {{ $ot_dt->vehiclePlate->license_plate }}</h3>
                <div class="table-responsive">
                    <x-table class="table-bordered">
                        <x-slot name="head">
                        </x-slot>
                        <x-slot name="body">
                            <tr>
                                <th>Marca</th>
                                <td>{{ $ot_dt->vehiclePlate->brand->name }}
                                </td>

                                <th>Color</th>
                                <td>{{ $ot_dt->vehiclePlate->color->name }}</td>

                                <th>Tipo</th>
                                <td>{{ $ot_dt->vehiclePlate->type->name }}</td>
                            </tr>
                            <tr>
                                <th>Modelo</th>
                                <td>{{ $ot_dt->vehiclePlate->model->name }}
                                </td>

                                <th>Año</th>
                                <td>{{ $ot_dt->vehiclePlate->model_year }}</td>

                                <th>Kilometraje</th>
                                <td>{{ $ot_dt->odo }}</td>
                            </tr>
                        </x-slot>
                    </x-table>
                </div>
            @endif

            <h3 class="fs-4 text-center">Lista de repuestos / servicios</h3>
            <div class="table-responsive">
                <x-table footer class="table-bordered table-striped table-centered">
                    <x-slot name="head">
                        <th class="text-left">Codigo</th>
                        <th class="text-left">Descripcion</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Precio U.</th>
                        <th class="text-center">DTO.</th>
                        <th class="text-center">Importe</th>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($dot_modal as $d)
                            <x-table.row>
                                <x-table.cell>{{ $d->item->code }}</x-table.cell>
                                <x-table.cell>{{ $d->item->name }}</x-table.cell>
                                <x-table.cell class="text-center">{{ $d->quantity }}</x-table.cell>
                                <x-table.cell class="text-center">{{ number_format($d->price, 2) }}</x-table.cell>
                                <x-table.cell class="text-center">{{ $d->discount }}</x-table.cell>
                                <x-table.cell class="text-center">S/
                                    {{ number_format($d->price * $d->quantity - $d->quantity * $d->price * ($d->discount / 100), 2) }}
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                    <x-slot name="foot">
                        @php $subtotal = 0; @endphp
                        @foreach ($dot_modal as $d)
                            @php $subtotal += $d->price * $d->quantity; @endphp
                        @endforeach
                        @php $mytotal = 0; @endphp
                        @foreach ($dot_modal as $d)
                            @php $mytotal += ($d->price * $d->quantity) - (($d->quantity * $d->price) * ($d->discount / 100)); @endphp
                        @endforeach
                        <tr>
                            <td></td>
                            <td class="text-right">
                                <h6 class="fs-5">SUBTOTAL: </h6>
                            </td>
                            <td class="text-center">
                            </td>
                            <td></td>
                            <td></td>
                            <td class="text-center">
                                <h6 class="fs-5">S/ {{ number_format($subtotal, 2) }}</h6>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right">
                                <h6 class="fs-5">DESCUENTO: </h6>
                            </td>
                            <td class="text-center">
                            </td>
                            <td></td>
                            <td></td>
                            <td class="text-center">
                                <h6 class="fs-5">S/ {{ number_format($subtotal - $mytotal, 2) }}</h6>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right">
                                <h6 class="fs-5">TOTALES: </h6>
                            </td>
                            <td class="text-center">
                                @if ($dot_modal)

                                    <h6 class="fs-5">{{ $dot_modal->sum('quantity') }}</h6>
                                @endif

                            </td>
                            <td></td>
                            <td></td>
                            <td class="text-center">
                                <h6 class="fs-5">S/ {{ number_format($mytotal, 2) }}</h6>
                            </td>
                        </tr>
                    </x-slot>
                </x-table>
            </div> --}}
            {{ $id_ot }}    
            <div class="row mt-3">
                <div class="col-12">
                    <object width="100%" height="1000px"
                        data="{{ env('APP_URL') }}/proforma/preview/{{ $id_ot }}" type="application/pdf">
                        <embed src="{{ env('APP_URL') }}/proforma/preview/{{ $id_ot }}"
                            type="application/pdf" />
                    </object>
                </div>
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
