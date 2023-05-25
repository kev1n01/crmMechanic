@section('title', 'Crear comprobante')
<div>
    <div class="row mt-3">
        <div class="col-12">
            <x-form method="save">
                <div class="row">
                    <div class="d-flex flex-row-reverse bd-highlight mt-2 mb-3">
                        <button type="button" class="btn border border-danger me-2 ms-2"
                            wire:click="cancel">Cancelar</button>

                        <button type="submit" wire:click.defer="changeAnother" class="btn border border-secondary">
                            <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                            Guardar y Crear
                        </button>

                        <button type="submit" class="btn border border-primary me-2">
                            <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                            Guardar
                        </button>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <x-input.select class="col-xl-11 mb-2" name="selectCustomer" :options="$customers"
                                        label="Cliente" :error="$errors->first('selectCustomer')" :required=true />
                                    <div class="col-xl-1 ps-1">
                                        <button type="button" wire:click="$emit('createcustomer')"
                                            style="margin-top:30px;" class="btn btn-primary rounded btn-sm">
                                            <i class="uil-user-plus"></i></button>
                                    </div>
                                </div>
                                @if ($selectCustomer)
                                    <div class="">
                                        <ul class="mb-0 ms-2 list-inline">
                                            <li class="list-inline-item">
                                                <h5 class="mb-1 me-4">RUC: {{ $customer->ruc }}</h5>
                                                <h5 class="mb-1">DNI: {{ $customer->dni }}</h5>
                                            </li>
                                            <li class="list-inline-item">
                                                <h5 class="mb-1">CEL: {{ $customer->phone }}</h5>
                                                <h4 class="mb-1">
                                                    <span
                                                        class="badge badge-info-lighten">{{ $customer->status }}</span>
                                                </h4>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-2">
                                    <x-input.select class="col-xl-5" name="comprobant.tipoDoc" :options="$typescpe"
                                        label="Tipo de comprobante" :error="$errors->first('comprobant.tipoDoc')" :required=true />

                                    <x-input.input-tooltip-error class="col-xl-3" name="comprobant.serie" label="Serie"
                                        type="text" :error="$errors->first('comprobant.serie')" :required=true :disabled=true />

                                    <x-input.input-tooltip-error class="col-xl-4" name="comprobant.correlativo"
                                        label="Correlativo" type="text" :error="$errors->first('comprobant.correlativo')" :required=true
                                        :disabled=true />

                                    <x-input.datepicker class="col-xl-5 mt-2" name="comprobant.fechaEmision"
                                        label="Fecha" id="dp1" :error="$errors->first('comprobant.fechaEmision')" :required=true />

                                    <x-input.select class="col-xl-3" name="comprobant.moneda" :options="$typescurrency"
                                        label="Moneda" :error="$errors->first('comprobant.moneda')" :required=true />

                                    <x-input.select class="col-xl-4" name="comprobant.tipoPago" :options="$typespayments"
                                        label="Tipo de pago" :error="$errors->first('comprobant.tipoPago')" :required=true />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row m-1">
                                    <div class="app-search dropdown d-lg-block mb-3">
                                        <div class="input-group w-auto">
                                            <input type="search" class="form-control me-2"
                                                placeholder="Buscar servicios y repuestos..."
                                                wire:model="searchProductService" {{ !$customer ? 'disabled' : '' }}>
                                            <span class="mdi mdi-magnify search-icon"></span>
                                            <button type="button" wire:click="clearCart"
                                                class="btn border border-secondary"><i
                                                    class="mdi mdi-cart-remove"></i></button>
                                            <button type="button" wire:click="$emit('createconcept')"
                                                class="btn btn-warning rounded ms-2"><i class="uil-wrench"></i></button>
                                            <button type="button" wire:click="$emit('createproduct')"
                                                class="btn btn-primary rounded ms-2"><i class="uil-box"></i></button>
                                        </div>

                                        <div id="scroll-products"
                                            class="dropdown-menu dropdown-menu-animated dropdown-lg w-75 {{ $concepts || $products ? 'd-block' : '' }}">
                                            <p class="text-center m-0 border border-secondary">SERVICIOS</p>
                                            @forelse ($concepts as $c)
                                                <span class="dropdown-item notify-item"
                                                    wire:click.prevent="addConcept({{ $c->id }})">
                                                    <span>⚒️ {{ $c->name . ' - codigo: ' . $c->code }}</span>
                                                </span>
                                            @empty
                                                <a class="dropdown-item notify-item">
                                                    <span>No se encontro servicio</span>
                                                </a>
                                            @endif

                                            <p class="text-center m-0 border border-secondary">PRODUCTO Y/O REPUESTOS
                                            </p>
                                            @forelse ($products as $p)
                                                <span class="dropdown-item notify-item"
                                                    wire:click.prevent="addProduct({{ $p->id }})">
                                                    <span>📦
                                                        {{ $p->name . ' - codigo: ' . $p->code . ' - stock: ' . $p->stock . ' - estado: ' . $p->status }}</span>
                                                </span>
                                            @empty
                                                <a class="dropdown-item notify-item">
                                                    <span>No se encontro repuesto</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <x-table footer class="table-striped">
                                        <x-slot name="head">
                                            <th width="40%">Producto</th>
                                            <th width="20%">Precio U.</th>
                                            <th width="15%">Cantidad</th>
                                            <th width="15%">Igv %</th>
                                            <th width="20%">Subtotal</th>
                                            <th width="20%">Gravado/Exonerado</th>
                                            <th width="10%">Acción</th>
                                        </x-slot>

                                        <x-slot name="body">
                                            @forelse($cart as $c)
                                                <x-table.row wire:key="row-{{ $c->name }}">
                                                    <x-table.cell>{{ $c->name }}</x-table.cell>
                                                    <x-table.cell>
                                                        <input type="number" id="p{{ $c->id }}"
                                                            class="form-control w-auto"
                                                            wire:change="updatePriceCart({{ $c->id }}, $('#p' + {{ $c->id }}).val())"
                                                            value="{{ $c->price }}">
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        <input type="number" id="r{{ $c->id }}"
                                                            min="1"
                                                            wire:change="updateQuantityCart({{ $c->id }}, $('#r' + {{ $c->id }}).val())"
                                                            style="font-size: 1rem !important;"
                                                            class="form-control text-center"
                                                            value="{{ $c->quantity }}">
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        <input type="number" disabled class="form-control w-auto"
                                                            value="{{ $c->attributes['porcentIgv'] }}">
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        <input type="text" class="form-control w-auto"
                                                            value="S/ {{ number_format($c->price * $c->quantity, 2) }}"
                                                            disabled>
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        <input type="checkbox" id="af{{ $c->id }}"
                                                            {{ $c->attributes['typeAfectIgv'] === 10 ? 'checked' : '' }}
                                                            wire:change="updateAfectIgvCart({{ $c->id }}, $('#af' + {{ $c->id }}).val())"
                                                            data-switch="success"
                                                            value="{{ $c->attributes['typeAfectIgv'] }}">

                                                        <label for="af{{ $c->id }}" data-on-label="Grav"
                                                            data-off-label="Exon"></label>

                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        <a class="action-icon"
                                                            wire:click.prevent="removeItem({{ $c->id }})"><i
                                                                class="mdi mdi-delete"></i></a>
                                                    </x-table.cell>
                                                </x-table.row>
                                            @empty
                                                <x-table.row>
                                                    <x-table.cell class="text-center" colspan="7">
                                                        No hay servicios y/o repuesto agregados
                                                    </x-table.cell>
                                                </x-table.row>
                                            @endif

                                        </x-slot>
                                        <x-slot name="foot">
                                            <tr>
                                                <td colspan="3"></td>
                                                <td colspan="2">Total Ope. Gravadas</td>
                                                <td colspan="2">S/ {{ number_format($totalOG, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td colspan="2">Total Ope. Exoneradas</td>
                                                <td colspan="2">S/ {{ number_format($totalOE, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td colspan="2">Total IGV 18%</td>
                                                <td colspan="2">S/ {{ number_format($totaligvgrav, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td colspan="2">TOTAL</td>
                                                <td colspan="2">S/ {{ number_format($total + $totaligvgrav, 2) }}</td>
                                            </tr>
                                        </x-slot>
                                    </x-table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</div>
@push('js')
    <script>
        // new TomSelect("#select", {
        //     sortField: {
        //         field: "text",
        //         direction: "asc"
        //     },
        //     placeholder: "Seleccionar cliente",


        // });
    </script>
@endpush
@push('modals')
    @livewire('product.modal')
    @livewire('ot.modal-concept')
    @livewire('customer.modal')
@endpush
