@section('title', 'Crear proforma')
<div>
    <div class="row mt-3">
        <div class="col-12">
            <x-form method="save">
                <div class="row">
                    <div class="d-flex flex-row-reverse bd-highlight mt-2 mb-3">
                        <button type="button" class="btn border border-danger me-2 ms-2" wire:click="cancel"
                            {{ !$editing->customer ? 'disabled' : '' }}>Cancelar</button>

                        <button type="submit" wire:click="changeAnother" class="btn border border-secondary">
                            <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                            Guardar y Crear
                        </button>

                        <button type="submit" class="btn border border-primary me-2">
                            <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                            Guardar
                        </button>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="d-flex">
                                    <div class="p-2 mb-0 flex-fill header-title text-center">
                                        <h5>Total de repuestos</h5>
                                        <h4><span>S/{{ number_format($total_replacement, 2) }}</span></h4>
                                    </div>
                                    <div class="p-2 mb-0 flex-fill header-title text-center">
                                        <h5>Total de servicios</h5>
                                        <h4><span>S/{{ number_format($total_service, 2) }}</span></h4>
                                    </div>
                                    <div class="p-2 mb-0 flex-fill header-title text-center">
                                        <h5>Monto total</h5>
                                        <h4><span>S/{{ number_format($totalDiscount, 2) }}</span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <x-input.select-button class="col-xl-12 pe-0" name="editing.customer"
                                        label="Cliente" :options="$customers" :error="$errors->first('editing.customer')" :required=true
                                        fnbtn="$emit('createcustomer')" iconbtn="uil-user-plus" title="Crear cliente" />
                                </div>

                                @if ($editing->customer > 0)
                                    <div class="mt-2">
                                        <ul class="mb-0 ms-2 list-inline">
                                            <li class="list-inline-item">
                                                <h5 class="mb-1">Cel: {{ $cf->phone }}</h5>
                                                <h5 class="mb-1">N°documento: {{ $cf->num_doc }}</h5>
                                            </li>
                                            <li class="list-inline-item ps-3">
                                                <h5 class="mb-1">Dirección: {{ $cf->address }}</h5>
                                                <h4 class="mb-1">
                                                    <span
                                                        class="badge badge-{{ $cf->status_color }}-lighten">{{ $cf->status }}</span>
                                                </h4>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <x-input.select-button class="col-xl-12 pe-0" name="editing.vehicle"
                                        label="Vehiculo" :options="$vehicles" :error="$errors->first('editing.vehicle')" :required=true
                                        fnbtn="$emit('createvehicle')" iconbtn="uil-car-sideview"
                                        title="Crear cliente" />
                                </div>
                                @if ($editing->vehicle > 0)
                                    <div class="mt-2">
                                        <ul class="mb-0 ms-2 list-inline">
                                            <li class="list-inline-item">
                                                <h5 class="mb-1">ODO: {{ $vf->odo }}</h5>
                                                <h5 class="mb-1">Color: {{ $vf->color->name }}</h5>
                                            </li>
                                            <li class="list-inline-item ps-3">
                                                <h5 class="mb-1">Tipo: {{ $vf->type->name }}</h5>
                                                <h5 class="mb-1">Modelo: {{ $vf->model->name }}</h5>
                                            </li>
                                            <li class="list-inline-item ps-3">
                                                <h5 class="mb-1">Marca:{{ $vf->brand->name }}</h5>
                                                <h5 class="mb-1">Año: {{ $vf->model_year }}</h5>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="row g-2 p-2">
                                <x-input.input-tooltip-error class="col-xl-4" name="editing.code" label="Código"
                                    type="text" :error="$errors->first('editing.code')" :required=true :disabled=true />
                                <x-input.select class="col-xl-4" name="editing.type_atention" label="Tipo de atención"
                                    :options="$types" :error="$errors->first('editing.type_atention')" :required=true />
                                <x-input.datepicker class="col-xl-4" name="editing.date_emission" label="Fecha emision"
                                    id="dp1" :error="$errors->first('editing.date_emission')" :required=true />
                                <x-input.textarea class="col-xl-12" name="editing.observation" label="Observaciones"
                                    rows="3" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row m-1">
                            <div class="app-search dropdown d-lg-block mb-3">
                                <div class="input-group w-auto">
                                    <input type="search" class="form-control me-2"
                                        placeholder="Buscar servicios y repuestos..." wire:model="searchProductService"
                                        {{ !$editing->customer || !$editing->vehicle ? 'disabled' : '' }}>
                                    <span class="mdi mdi-magnify search-icon"></span>
                                    <button title="Limpiar articulos" type="button" wire:click="clearCart"
                                        class="btn border border-secondary"
                                        {{ !$editing->customer || !$editing->vehicle ? 'disabled' : '' }}><i
                                            class="mdi mdi-cart-remove"></i></button>
                                    <button title="Crear servicio" type="button" wire:click="$emit('createconcept')"
                                        class="btn btn-warning rounded ms-2"><i class="uil-wrench"></i></button>
                                    <button title="Crear producto" type="button" wire:click="$emit('createproduct')"
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

                                    <p class="text-center m-0 border border-secondary">PRODUCTO Y/O REPUESTOS</p>
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
                                    <th width="15%">Descuento</th>
                                    <th width="20%">Subtotal</th>
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
                                                <input type="number" id="r{{ $c->id }}" min="1"
                                                    wire:change="updateQuantityCart({{ $c->id }}, $('#r' + {{ $c->id }}).val(), $('#d'+{{ $c->id }}).val())"
                                                    style="font-size: 1rem !important;"
                                                    class="form-control text-center" value="{{ $c->quantity }}">
                                            </x-table.cell>
                                            <x-table.cell>
                                                <input type="number" id="d{{ $c->id }}"
                                                    wire:change="updateDiscountCart({{ $c->id }}, $('#d'+{{ $c->id }}).val())"
                                                    class="form-control" value="{{ $c->attributes['discount'] }}"
                                                    min="0">
                                            </x-table.cell>
                                            <x-table.cell>
                                                <input type="text" class="form-control w-auto"
                                                    value="S/ {{ number_format($c->price * $c->quantity - $c->price * $c->quantity * ($c->attributes['discount'] / 100), 2) }}"
                                                    disabled>
                                            </x-table.cell>

                                            <x-table.cell>
                                                <a class="action-icon"
                                                    wire:click.prevent="removeItem({{ $c->id }})"><i
                                                        class="mdi mdi-delete"></i></a>
                                            </x-table.cell>
                                        </x-table.row>
                                    @empty
                                        <x-table.row>
                                            <x-table.cell class="text-center" colspan="6">
                                                No hay servicios y/o repuesto agregados
                                            </x-table.cell>
                                        </x-table.row>
                                    @endif

                                </x-slot>
                                <x-slot name="foot">
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">Subtotal</td>
                                        <td>S/ {{ number_format($total, 2) }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">Total Ope. Gravadas</td>
                                        <td>S/ {{ number_format($totalOG, 2) }}</td>
                                    </tr> --}}
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">Total Descuentos</td>
                                        <td>S/ {{ number_format($total - $totalDiscount, 2) }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">Total IGV 18%</td>
                                        <td>S/ {{ number_format($totalDiscount - $totalOG, 2) }}</td>
                                    </tr> --}}
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">TOTAL</td>
                                        <td>S/ {{ number_format($totalDiscount, 2) }}</td>
                                    </tr>
                                </x-slot>
                            </x-table>
                        </div>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</div>
@push('modals')
    @livewire('product.modal')
    @livewire('ot.modal-concept')
    @livewire('customer.modal')
    @livewire('vehicle.modal')
@endpush
