<div>
    <div class="row mt-3">
        <div class="col-12">
            <x-form method="save">
                <div class="row">
                    <div class="d-flex flex-row-reverse bd-highlight mt-2 mb-3">
                        <button type="button" class="btn border border-danger me-2 ms-2"
                            wire:click="cancel">Cancelar</button>

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
                                                            {{ $editing->type_payment == 'credito' ? 'disabled' : '' }}
                                                            type="number" min="0"
                                                            class="fs-4 text-center form-control form-control-light">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fs-4">Cambio: </td>
                                                    <td class="fs-4">
                                                        @if ($editing->cash > $totalDiscount)
                                                            S/{{ number_format($editing->cash - $totalDiscount, 2) }}
                                                        @else
                                                            S/{{ number_format(0, 2) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
                                                wire:model="searchProduct">
                                            <span class="mdi mdi-magnify search-icon"></span>
                                            <button type="button" wire:click="clearCart"
                                                class="btn border border-secondary"
                                                {{ !$editing->customer_id ? 'disabled' : '' }}><i
                                                    class="mdi mdi-cart-remove"></i></button>
                                            <button type="button" wire:click="$emit('createproduct')"
                                                class="btn btn-primary rounded ms-2"><i class="uil-box"></i></button>
                                        </div>

                                        <div id="scroll-products"
                                            class="dropdown-menu dropdown-menu-animated dropdown-lg w-75 {{ $products ? 'd-block' : '' }}">
                                            @forelse ($products as $s)
                                                <span class="dropdown-item notify-item"
                                                    wire:click.prevent="addProduct({{ $s->id }})">
                                                    <span>📦
                                                        {{ $s->name . ' - ' . $s->code . ' - ' . $s->stock . ' - ' . $s->status }}</span>
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
                                    <x-table footer class="table-striped table-bordered">
                                        <x-slot name="head">
                                            <th width="40%">Producto</th>
                                            <th width="20%">Precio U.</th>
                                            <th width="15%">Cantidad</th>
                                            <th width="15%">Descuento</th>
                                            <th width="10%">Subtotal</th>
                                            <th width="10%">Acción</th>
                                        </x-slot>

                                        <x-slot name="body">
                                            @if (count($dts) > 0)
                                                <x-table.row>
                                                    <td colspan="6" class="text-center ">Productos registrados de la
                                                        venta</td>
                                                </x-table.row>
                                            @endif

                                            @foreach ($dts as $s)
                                                <x-table.row>
                                                    <x-table.cell>{{ $s->product->name }}</x-table.cell>
                                                    <x-table.cell>
                                                        <input type="number" id="p{{ $s->id }}"
                                                            class="form-control w-auto"
                                                            wire:change="updatePriceDs({{ $s->id }}, $('#p' + {{ $s->id }}).val())"
                                                            value="{{ $s->price }}">
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        <input type="number" id="r{{ $s->id }}"
                                                            min="1"
                                                            wire:change="updateQuantityDs({{ $s->id }}, $('#r' + {{ $s->id }}).val(), $('#d'+{{ $s->id }}).val())"
                                                            class="form-control text-center"
                                                            value="{{ $s->quantity }}">
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        <input type="number" id="d{{ $s->id }}"
                                                            wire:change="updateDiscountDs({{ $s->id }}, $('#d'+{{ $s->id }}).val())"
                                                            class="form-control" value="{{ $s->discount }}"
                                                            min="0" max="100">
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        <input type="text" class="form-control w-auto"
                                                            value="S/ {{ number_format($s->price * $s->quantity - $s->price * $s->quantity * ($s->discount / 100), 2) }}"
                                                            disabled>
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        <a class="action-icon"
                                                            wire:click.prevent="removeItemDs({{ $s->id }})"><i
                                                                class="mdi mdi-delete"></i></a>
                                                    </x-table.cell>
                                                </x-table.row>
                                            @endforeach
                                            @if (count($cart) > 0)
                                                <x-table.row>
                                                    <td colspan="6" class="text-center ">Productos agregados
                                                        recientemente</td>
                                                </x-table.row>
                                            @endif
                                            @foreach ($cart as $c)
                                                <x-table.row>
                                                    <x-table.cell>{{ $c->name }}</x-table.cell>
                                                    <x-table.cell>
                                                        <input type="number" id="cp{{ $c->id }}"
                                                            class="form-control w-auto"
                                                            wire:change="updatePriceCart({{ $c->id }}, $('#cp' + {{ $c->id }}).val())"
                                                            value="{{ $c->price }}">
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        <input type="number" id="cr{{ $c->id }}"
                                                            min="1"
                                                            wire:change="updateQuantityCart({{ $c->id }}, $('#cr' + {{ $c->id }}).val(), $('#cd'+{{ $c->id }}).val())"
                                                            class="form-control text-center"
                                                            value="{{ $c->quantity }}">
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        <input type="number" id="cd{{ $c->id }}"
                                                            wire:change="updateDiscountCart({{ $c->id }}, $('#cd'+{{ $c->id }}).val())"
                                                            class="form-control"
                                                            value="{{ $c->attributes['discount'] }}" min="0"
                                                            max="100">
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
                                            @endforeach
                                            @if (count($dts) == 0 && count($cart) == 0)
                                                <x-table.row>
                                                    <x-table.cell class="text-center" colspan="6">
                                                        No hay productos recientemente agregados a la venta
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
                                                <td>S/ {{ number_format($totalDiscount - $totalOG, 2) }}
                                                </td>
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
                </div>
            </x-form>
        </div>
    </div>
</div>
@push('modals')
    @livewire('product.modal')
    @livewire('customer.modal')
@endpush
