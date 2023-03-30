@section('title', 'Reporte de ventas' )
<div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <x-input.select class="col-xl-12" name="customer_id" label="Cliente" :required=true
                                :options="$customers" :error="$errors->first('customer_id')" />

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
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body pt-2">

                            {{-- <div class="border-white rounded mb-2 mt-1">
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
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th>Total</th>
                                        <th>Acción</th>
                                    </x-slot>

                                    <x-slot name="body">
                                        @forelse($sales as $sale)
                                            <x-table.row>
                                                <x-table.cell>{{ $sale->code_sale }}</x-table.cell>

                                                <x-table.cell>{{ $sale->date_sale }}</x-table.cell>

                                                <x-table.cell>
                                                    <span class="badge badge-{{ $sale->status_color }}-lighten">
                                                        {{ strtoupper($sale->status) }}
                                                    </span>
                                                </x-table.cell>

                                                <x-table.cell>S/ {{ number_format($sale->total, 2) }}</x-table.cell>

                                                <x-table.cell>
                                                    <a class="btn btn-primary btn-sm"
                                                        wire:click.prevent="viewDetails({{ $sale->id }})">Ver</a>
                                                </x-table.cell>
                                            </x-table.row>
                                        @empty
                                            <x-table.row>
                                                <x-table.cell class="text-center" colspan="5">
                                                    No hay ventas para este cliente seleccionado o en las fechas
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
                        <th class="text-left">Dinero</th>
                        <th class="text-left">Cambio</th>
                        <th class="text-left">Observacion</th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($sale_dt as $od)
                            <x-table.row>
                                <x-table.cell class="text-center">S/ {{ number_format($od->cash, 2) }}</x-table.cell>
                                <x-table.cell class="text-center">S/ {{ number_format($od->change, 2) }}</x-table.cell>
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
                        <th class="text-left">Ruc</th>
                        <th class="text-left">DNI</th>
                        <th class="text-left">Direccion</th>
                        <th class="text-left">Celular</th>
                        <th class="text-left">Estado</th>
                        <th class="text-left">Email</th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($sale_dt as $sdt)
                            <x-table.row>
                                <x-table.cell>{{ $sdt->customer->name }}</x-table.cell>
                                <x-table.cell>{{ $sdt->customer->ruc ?? 'N/D'}}</x-table.cell>
                                <x-table.cell>{{ $sdt->customer->dni }}</x-table.cell>
                                <x-table.cell>{{ $sdt->customer->address }}</x-table.cell>
                                <x-table.cell>{{ $sdt->customer->phone }}</x-table.cell>
                                <x-table.cell>{{ $sdt->customer->status }}</x-table.cell>
                                <x-table.cell>{{ $sdt->customer->email }}</x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>

            <h3 class="fs-4 text-center">Lista productos</h3>
            <div class="table-responsive">
                <x-table footer class="table-bordered table-striped table-centered">
                    <x-slot name="head">
                        <th class="text-left">Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Precio U.</th>
                        <th class="text-center">Importe</th>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($details as $d)
                            <x-table.row>
                                <x-table.cell>{{ $d->product->name }}</x-table.cell>
                                <x-table.cell class="text-center">{{ $d->quantity }}</x-table.cell>
                                <x-table.cell class="text-center">S/ {{ number_format($d->price, 2) }}</x-table.cell>
                                <x-table.cell class="text-center">S/ {{ number_format($d->quantity * $d->price, 2) }}
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                    <x-slot name="foot">
                        <td class="text-right">
                            <h6 class="text-primary fs-5">TOTALES: </h6>
                        </td>
                        <td class="text-center">
                            @if ($details)
                                <h6 class="text-primary fs-5">{{ $details->sum('quantity') }}</h6>
                            @endif
                        </td>
                        @if ($details)
                            @php $mytotal = 0; @endphp
                            @foreach ($details as $d)
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
            $('#detailSaleModal').modal('hide');
        });
        window.addEventListener('open-modal', event => {
            $('#detailSaleModal').modal('show');
        });
    </script>
@endpush
