<div>
    <div class="row mt-3">
        <div class="col-12">
            <x-form method="save">
                <div class="row">
                    <div class="d-flex flex-row-reverse bd-highlight mt-2 mb-3">
                        <button type="button" class="btn border border-danger me-2 ms-2"
                            wire:click="cancel" {{ !$editing->customer_id ? 'disabled': '' }}>Cancelar</button>

                        <button type="submit" wire:click="changeAnother" class="btn border border-secondary">
                            <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                            Guardar y Crear
                        </button>

                        <button type="submit" class="btn border border-primary me-2">
                            <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                            Guardar
                        </button>
                    </div>
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-2">
                                    <x-input.input-tooltip-error class="col-xl-3" name="editing.code_sale"
                                        label="Código" type="text" :error="$errors->first('editing.code_sale')" :required=true :disabled=true />

                                    <x-input.select class="col-xl-8" name="editing.customer_id" label="Cliente"
                                        :required=true :options="$customers" :error="$errors->first('editing.customer_id')" />
                                    <div class="col-xl-1">
                                        <button type="button" wire:click="$emit('createcustomer')"
                                            class="btn btn-primary rounded btn-md" style="margin-top:30px;"><i
                                                class="uil-user-plus"></i></button>
                                    </div>

                                    <x-input.datepicker class="col-xl-6 mt-2" name="editing.date_sale" label="Fecha"
                                        id="dp1" :error="$errors->first('editing.date_sale')" :required=true />

                                    <x-input.select class="col-xl-6 mt-2" name="editing.type_payment"
                                        label="Tipo de pago" :required=true :options="$types_payment" :error="$errors->first('editing.type_payment')" />

                                    @if ($editing->type_payment)
                                        <x-input.select class="col-xl-6 mt-2" name="editing.status" label="Estado"
                                            :required=true :options="$statuses" :error="$errors->first('editing.status')" :disabled=true />

                                        <x-input.select class="col-xl-6 mt-2" name="editing.method_payment"
                                            label="Metodo de pago" :required=true :options="$methods_payment" :error="$errors->first('editing.method_payment')" />
                                    @endif
                                    <x-input.textarea class="col-xl-12 mt-2 " name="editing.observation"
                                        label="Observaciones" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="p-1 mt-4 mt-lg-0 rounded">
                                    <h4 class="header-title mt-3 text-center">Monto total</h4>
                                    <div class="table-responsive">
                                        <table class="table mb-4">
                                            <tbody>
                                                <tr>
                                                    <td class="fs-2 text-center" colspan="2">
                                                        S/{{ number_format($totalDiscount, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fs-4">Pago: </td>
                                                    <td>
                                                        <input wire:model="editing.cash"
                                                            {{ !$editing->customer_id || $editing->status != 'pagado' || count($cart) == 0 ? 'disabled' : '' }}
                                                            type="number" min="0"
                                                            class="fs-4 text-center form-control form-control-light">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fs-4">Cambio: </td>
                                                    <td class="fs-4"> S/{{ number_format($change, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row m-1">
                                <div class="app-search dropdown d-lg-block mb-3">
                                    <div class="input-group w-auto">
                                        <input type="search" class="form-control me-2"
                                            placeholder="Buscar productos por nombre o codigo..."
                                            wire:model="searchProduct" {{ !$editing->customer_id ? 'disabled' : '' }}>
                                        <span class="mdi mdi-magnify search-icon"></span>
                                        <button type="button" wire:click="clearCart"
                                            class="btn border border-secondary"
                                            {{ !$editing->customer_id || count($cart) == 0 ? 'disabled' : '' }}><i
                                                class="mdi mdi-cart-remove"></i></button>
                                        <button type="button" wire:click="$emit('createproduct')"
                                            class="btn btn-primary rounded ms-2"><i class="uil-box"></i></button>
                                    </div>

                                    <div id="scroll-products"
                                        class="dropdown-menu dropdown-menu-animated dropdown-lg {{ $products ? 'd-block' : '' }}">
                                        @forelse ($products as $p)
                                            <span class="dropdown-item notify-item"
                                                wire:click.prevent="addProduct({{ $p->id }})">
                                                <span>📦
                                                    {{ $p->name . ' - ' . $p->code . ' - ' . $p->stock . ' - ' . $p->status }}</span>
                                            </span>
                                        @empty
                                            <a class="dropdown-item notify-item">
                                                <span>No existe este producto..</span>
                                            </a>
                                        @endif 
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <x-table footer class="table-striped table-centered">
                                    <x-slot name="head">
                                        <th width="40%">Producto</th>
                                        <th width="25%">Precio U.</th>
                                        <th width="15%">Cantidad</th>
                                        <th width="15%">Descuento</th>
                                        <th width="20%">Subtotal</th>
                                        <th width="10%">Acción</th>
                                    </x-slot>

                                    <x-slot name="body">
                                        @forelse($cart as $c)
                                            <x-table.row>
                                                <x-table.cell>
                                                    <p class="m-0 d-inline-block align-middle font-14">
                                                        {{ $c->name }}
                                                    </p>
                                                </x-table.cell>
                                                <x-table.cell>
                                                    <input type="number" id="p{{ $c->id }}"
                                                        class="form-control w-auto"
                                                        wire:change="updatePriceCart({{ $c->id }}, $('#p' + {{ $c->id }}).val())"
                                                        value="{{ $c->price }}">
                                                </x-table.cell>
                                                <x-table.cell>
                                                    <input type="number" id="r{{ $c->id }}" min="1"
                                                        wire:change="updateQuantityCart({{ $c->id }}, $('#r' + {{ $c->id }}).val(), $('#d'+{{ $c->id }}).val())"
                                                        class="form-control" value="{{ $c->quantity }}"
                                                        min="1">
                                                </x-table.cell>
                                                <x-table.cell>
                                                    <input type="number" id="d{{ $c->id }}"
                                                        wire:change="updateDiscountCart({{ $c->id }}, $('#d'+{{ $c->id }}).val())"
                                                        class="form-control" value="{{ $c->attributes['discount'] }}"
                                                        min="0" max="100">
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
                                                    No hay productos agregados a la venta
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
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">Total Ope. Gravadas</td>
                                            <td>S/ {{ number_format($totalOG, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">Total Descuentos</td>
                                            <td>S/ {{ number_format($total - $totalDiscount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">Total IGV 18%</td>
                                            <td>S/ {{ number_format($totalDiscount - $totalOG, 2) }}</td>
                                        </tr>
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
                </div>
            </x-form>
        </div>
    </div>
</div>
@push('modals')
    @livewire('product.modal')
    @livewire('customer.modal')
@endpush
