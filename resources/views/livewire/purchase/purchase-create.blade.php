<div>
    <div class="row mt-3">
        <div class="col-12">
            <x-form method="save">
                <div class="row">
                    <div class="d-flex flex-row-reverse bd-highlight mt-2 mb-3">
                        <button type="button" class="btn border border-danger me-2 ms-2" wire:click="cancel"
                            {{ !$editing->provider_id ? 'disabled' : '' }}>Cancelar</button>

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
                                    <x-input.input-tooltip-error class="col-xl-3" name="editing.code_purchase"
                                        label="Código" type="text" :error="$errors->first('editing.code_purchase')" :required=true :disabled=true />

                                    <x-input.select class="col-xl-8" name="editing.provider_id" label="Proveedor"
                                        :required=true :options="$providers" :error="$errors->first('editing.provider_id')" />

                                    <div class="col-xl-1">
                                        <button type="button" wire:click="$emit('createprovider')"
                                            class="btn btn-primary rounded btn-md" style="margin-top:30px;"><i
                                                class="uil-user-plus"></i></button>
                                    </div>
                                    <x-input.select class="col-xl-6 mt-2" name="editing.status" label="Estado"
                                        :required=true :options="$statuses" :error="$errors->first('editing.status')" />

                                    <x-input.datepicker class="col-xl-6 mt-2" name="editing.date_purchase"
                                        label="Fecha" id="dp1" :error="$errors->first('editing.date_purchase')" :required=true />

                                    <x-input.select class="col-xl-6 mt-2" name="editing.type_cpe" label="Tipo de CPE"
                                        :required=true :options="$types" :error="$errors->first('editing.type_cpe')" />

                                    @if ($editing->type_cpe)

                                        <x-input.input-tooltip-error class="col-xl-3" name="serial"
                                            label="Serie" type="text" :error="$errors->first('serial')" :required=true />

                                        <x-input.input-tooltip-error class="col-xl-3" name="correlative"
                                            label="Correlativo" type="text" :error="$errors->first('correlative')" :required=true />

                                        <x-input.select class="col-xl-6 mt-2" name="editing.method_payment"
                                            label="Metodo de pago" :required=true :options="$methods"
                                            :error="$errors->first('editing.method_payment')" />
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
                                            wire:model="searchProduct" {{ !$editing->provider_id ? 'disabled' : '' }}>
                                        <span class="mdi mdi-magnify search-icon"></span>
                                        <button type="button" wire:click="clearCart"
                                            class="btn border border-secondary"
                                            {{ !$editing->provider_id ? 'disabled' : '' }}><i
                                                class="mdi mdi-cart-remove"></i></button>
                                        <button type="button" wire:click="$emit('createproduct')"
                                            class="btn btn-primary rounded ms-2"><i class="uil-box"></i></button>
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
                                        <th width="10%">Importe</th>
                                        <th width="10%">Acción</th>
                                    </x-slot>

                                    <x-slot name="body">
                                        @forelse($cart as $c)
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
                                        @empty
                                            <x-table.row>
                                                <x-table.cell class="text-center" colspan="6">
                                                    No hay productos agregados a la compra
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
    @livewire('provider.modal')
@endpush
