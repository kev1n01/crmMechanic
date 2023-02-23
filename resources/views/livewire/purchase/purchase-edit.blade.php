<div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-form method="save">
                        <div class="row mb-4 justify-content-center ">
                            <x-input.input-tooltip-error class="col-xl-2 me-1" name="editing.code_purchase" label="Código"
                                type="text" :error="$errors->first('editing.code_purchase')" :required=true :disabled=true />

                            <x-input.select class="col-xl-3 me-1" name="editing.provider_id" label="Proveedor"
                                :required=true :options="$providers" :error="$errors->first('editing.provider_id')" :disabled=true/>

                            <x-input.select class="col-xl-2 me-1" name="editing.status" label="Estado" :required=true
                                :options="$statuses" :error="$errors->first('editing.status')" :disabled=true/>

                            <x-input.datepicker class="col-xl-3 me-1" name="editing.date_purchase" label="Fecha"
                                id="dp1" :error="$errors->first('editing.date_purchase')" :required=true />

                            <x-input.textarea class="col-xl-6 mt-2 " name="editing.observation" label="Observaciones" />
                        </div>

                        <div class="row m-1">
                            <div class="app-search dropdown d-lg-block mb-3">
                                <div class="input-group w-auto">
                                    <input type="search" class="form-control me-2"
                                        placeholder="Buscar productos por nombre o codigo..." wire:model="searchProduct">
                                    <span class="mdi mdi-magnify search-icon"></span>
                                    <button type="button" wire:click="clearCart" class="btn border border-secondary"
                                        {{ !$editing->provider_id ? 'disabled' : '' }}><i
                                            class="mdi mdi-reload"></i></button>
                                </div>

                                <div id="scroll-products"
                                    class="dropdown-menu dropdown-menu-animated dropdown-lg w-75 {{ $products ? 'd-block' : '' }}">
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
                                    @foreach($dtp as $p)
                                        <x-table.row>
                                            <x-table.cell>{{ $p->product->name }}</x-table.cell>
                                            <x-table.cell>
                                                <input type="number" id="p{{ $p->id }}"
                                                    class="form-control w-auto"
                                                    wire:change="updatePriceDp({{ $p->id }}, $('#p' + {{ $p->id }}).val())"
                                                    value="{{ $p->price }}">
                                            </x-table.cell>
                                            <x-table.cell>
                                                <input type="number" id="r{{ $p->id }}" min="1"
                                                    wire:change="updateQuantityDp({{ $p->id }}, $('#r' + {{ $p->id }}).val(), $('#d'+{{ $p->id }}).val())"
                                                    class="form-control text-center" value="{{ $p->quantity }}">
                                            </x-table.cell>
                                            <x-table.cell>
                                                <input type="number" id="d{{ $p->id }}"
                                                    wire:change="updateDiscountDp({{ $p->id }}, $('#d'+{{ $p->id }}).val())"
                                                    class="form-control" value="{{ $p->discount }}"
                                                    min="0" max="100">
                                            </x-table.cell>
                                            <x-table.cell>
                                                <input type="text" class="form-control w-auto"
                                                    value="S/ {{ number_format($p->price * $p->quantity - $p->price * $p->quantity * ($p->discount / 100), 2) }}"
                                                    disabled>
                                            </x-table.cell>
                                            <x-table.cell>
                                                <a class="action-icon"
                                                    wire:click.prevent="removeItemDp({{ $p->id }})"><i
                                                        class="mdi mdi-delete"></i></a>
                                            </x-table.cell>
                                        </x-table.row>
                                    @endforeach
                                    @foreach($cart as $c)
                                        <x-table.row wire:key="row-{{ $c->id }}">
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
                                                    class="form-control text-center" value="{{ $c->quantity }}">
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
                                    @endforeach
                                    @if (count($dtp) == 0 && count($cart) == 0)
                                        <x-table.row>
                                            <x-table.cell class="text-center" colspan="6">
                                                No hay productos agregados a la compra
                                            </x-table.cell>
                                        </x-table.row>
                                    @endif
                                </x-slot>
                                <x-slot name="foot">
                                    @php
                                        $totalDiscountCart = 0;
                                        $totalDiscountDp = 0;
                                        $totalCartOG = 0;
                                        $totalDpOG = 0;
                                        $totalDp = 0;
                                        foreach ($cart as $c) {
                                            $totalDiscountCart += $c->price * $c->quantity - $c->quantity * $c->price * ($c->attributes['discount'] / 100);
                                        }
                                        foreach ($dtp as $p) {
                                            $totalDiscountDp += $p->price * $p->quantity - $p->quantity * $p->price * ($p->discount / 100);
                                            $totalDp += $p->price * $p->quantity;
                                        }
                                        $totalCartOG = $totalDiscountCart / 1.18;
                                        $totalDpOG = $totalDiscountDp / 1.18;
                                        $totalOG = $totalCartOG + $totalDpOG;
                                        $total = $totalCart + $totalDp;
                                        $totalDiscount = $totalDiscountCart + $totalDiscountDp;
                                    @endphp
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

                        <div class="mt-2">
                            <button type="button" class="btn border border-danger me-2 ms-2" wire:click="cancel">Cancelar</button>

                            <button type="submit" class="btn border border-primary me-2">
                                <span wire:loading.delay wire:target="save"
                                    class="spinner-border spinner-border-sm"></span>
                                Guardar
                            </button>
                        </div>

                    </x-form>
                </div>
            </div>
        </div>
    </div>

</div>
