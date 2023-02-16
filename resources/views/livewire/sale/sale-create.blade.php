<div>
    <div class="row mt-3">
        <div class="col-12">
            <x-form method="save">
                <div class="card">
                    <div class="card-body">

                        <div class="row mb-4 justify-content-center ">
                            <x-input.input-tooltip-error class="col-xl-2 me-1" name="editing.code_sale" label="Código"
                                type="text" :error="$errors->first('editing.code_sale')" :required=true :disabled=true />

                            <x-input.select class="col-xl-3 me-1" name="editing.customer_id" label="Cliente"
                                :required=true :options="$customers" :error="$errors->first('editing.customer_id')" />

                            <x-input.select class="col-xl-2 me-1" name="editing.status" label="Estado" :required=true
                                :options="$statuses" :error="$errors->first('editing.status')" />

                            <x-input.datepicker class="col-xl-3 me-1" name="editing.date_sale" label="Fecha"
                                id="dp1" :error="$errors->first('editing.date_sale')" :required=true />

                            <x-input.textarea class="col-xl-6 " name="editing.observation" label="Observaciones" />
                        </div>

                        <div class="row m-1">
                            <div class="app-search dropdown d-lg-block mb-3">
                                <div class="input-group w-auto">
                                    <input type="search" class="form-control me-2"
                                        placeholder="Buscar productos por nombre o codigo..." wire:model="searchProduct"
                                        {{ !$editing->customer_id ? 'disabled' : '' }}>
                                    <span class="mdi mdi-magnify search-icon"></span>
                                    <button type="button" wire:click="clearCart" class="btn btn-secondary"
                                        {{ !$editing->customer_id || count($cart) == 0 ? 'disabled' : '' }}><i
                                            class="mdi mdi-reload"></i></button>
                                </div>

                                <div id="scroll-products"
                                    class="dropdown-menu dropdown-menu-animated dropdown-lg {{ $products ? 'd-block' : '' }}">
                                    @forelse ($products as $p)
                                        <span class="dropdown-item notify-item"
                                            wire:click.prevent="addProduct({{ $p->id }})">
                                            <span>📦 {{ $p->name.' - '. $p->code.' - '. $p->stock .' - '. $p->status}}</span>
                                        </span>
                                    @empty
                                        <a class="dropdown-item notify-item">
                                            <span>No existe este producto..</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-9">
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
                                                        <input type="text" class="form-control w-auto"
                                                            value="S/ {{ number_format($c->price, 2) }}" disabled>
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        <input type="number" id="r{{ $c->id }}" min="1"
                                                            wire:change="updateQuantityCart({{ $c->id }}, $('#r' + {{ $c->id }}).val(), $('#d'+{{ $c->id }}).val())"
                                                            class="form-control" value="{{ $c->quantity }}">
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        <input type="number" id="d{{ $c->id }}"
                                                            wire:change="updateDiscountCart({{ $c->id }}, $('#d'+{{ $c->id }}).val())"
                                                            class="form-control"
                                                            value="{{ $c->attributes['discount'] }}" min="0">
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
                                            @php
                                                $totalDiscount = 0;
                                                $totalOG = 0;
                                                foreach ($cart as $c) {
                                                    $totalDiscount += $c->price * $c->quantity - $c->quantity * $c->price * ($c->attributes['discount'] / 100);
                                                }
                                                $totalOG = $totalDiscount / 1.18;
                                            @endphp
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

                                </div> <!-- end table-responsive-->

                                <!-- action buttons-->
                            </div>
                            <!-- end col -->

                            <div class="col-lg-3">
                                <div class="border p-1 mt-4 mt-lg-0 rounded shadow-none bg-light">
                                    <h4 class="header-title mb-3 text-center">INGRESO DE PAGO</h4>

                                    <div class="table-responsive">
                                        <table class="table m-0 p-0">
                                            <tbody>
                                                <tr>
                                                    <td>Total:</td>
                                                    <td>S/ {{ number_format($totalDiscount, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pago: </td>
                                                    <td>
                                                        <div class="input-group ">
                                                            <input wire:model="cash"
                                                                {{ !$editing->customer_id || $editing->status != 'pagado' || count($cart) == 0 ? 'disabled' : '' }}
                                                                type="number" class="form-control form-control-light">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Cambio: </td>
                                                    <td> S/{{ number_format($change, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end table-responsive -->
                                </div>
                            </div> <!-- end col -->
                        </div>

                        <div class="mt-2">
                            <button type="button"
                                class="btn btn-secondary me-2 ms-2 {{ !$editing->customer_id ? 'disabled' : '' }}"
                                wire:click="cancel">Cancelar</button>

                            <button type="submit" class="btn btn-primary me-2">
                                <span wire:loading.delay wire:target="save"
                                    class="spinner-border spinner-border-sm"></span>
                                Guardar
                            </button>

                            <button type="submit" wire:click="changeAnother"
                                class="btn border border-secondary>
                                <span wire:loading.delay wire:target="save"
                                class="spinner-border spinner-border-sm"></span>
                                Guardar y Crear
                            </button>
                        </div>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</div>
