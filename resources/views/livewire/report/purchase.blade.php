@section('title', 'Reporte de compras')
<div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <x-input.select class="col-xl-12" name="provider_id" label="Proveedor" :required=true
                                :options="$providers" :error="$errors->first('provider_id')" />

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
                                        @forelse($purchases as $purchase)
                                            <x-table.row>
                                                <x-table.cell>{{ $purchase->code_purchase }}</x-table.cell>

                                                <x-table.cell>{{ $purchase->date_purchase }}</x-table.cell>

                                                <x-table.cell>
                                                    <span class="badge badge-{{ $purchase->status_color }}-lighten">
                                                        {{ strtoupper($purchase->status) }}
                                                    </span>
                                                </x-table.cell>

                                                <x-table.cell>S/ {{ number_format($purchase->total, 2) }}</x-table.cell>

                                                <x-table.cell>
                                                    <a class="action-icon"
                                                        wire:click.prevent="viewDetails({{ $purchase->id }})"><i
                                                            class="mdi mdi-eye-outline"></i></a>
                                                            
                                                </x-table.cell>
                                            </x-table.row>
                                        @empty
                                            <x-table.row>
                                                <x-table.cell class="text-center" colspan="5">
                                                    No hay compras para este proveedor seleccionado o en las fechas
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
                        <th class="text-left">Observacion</th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($purchase_dt as $od)
                            <x-table.row>
                                <x-table.cell>{{ $od->observation }}</x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>

            <h3 class="fs-4 text-center">Información del Proveedor</h3>
            <div class="table-responsive">
                <x-table class="table-bordered table-striped table-centered">
                    <x-slot name="head">
                        <th class="text-left">Nombre</th>
                        <th class="text-left">Ruc</th>
                        <th class="text-left">Direccion</th>
                        <th class="text-left">Celular</th>
                        <th class="text-left">Estado</th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($purchase_dt as $sdt)
                            <x-table.row>
                                <x-table.cell>{{ $sdt->provider->name }}</x-table.cell>
                                <x-table.cell>{{ $sdt->provider->ruc }}</x-table.cell>
                                <x-table.cell>{{ $sdt->provider->address }}</x-table.cell>
                                <x-table.cell>{{ $sdt->provider->phone }}</x-table.cell>
                                <x-table.cell>{{ $sdt->provider->status }}</x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>

            <h3 class="fs-4 text-center">Lista de servicios y repuesto</h3>
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
