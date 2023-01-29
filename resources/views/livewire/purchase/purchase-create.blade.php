<div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-form method="save">
                        <div class="row mb-4 justify-content-center ">
                            <x-input.input-tooltip-error class="col-xl-2 me-1" name="editing.code_purchase" label="Código"
                                type="text" :error="$errors->first('editing.code_purchase')" :required=true />

                            <x-input.select class="col-xl-3 me-1" name="editing.provider_id" label="Proveedor"
                                :required=true :options="$providers" :error="$errors->first('editing.provider_id')" />

                            <x-input.select class="col-xl-2 me-1" name="editing.status" label="Estado" :required=true
                                :options="$statuses" :error="$errors->first('editing.status')" />

                            <x-input.datepicker class="col-xl-3 me-1" name="editing.date_purchase" label="Fecha"
                                id="dp1" :error="$errors->first('editing.date_purchase')" :required=true />

                            <x-input.textarea class="col-xl-6 " name="editing.observation" label="Observaciones" />
                        </div>

                        <div class="row m-1">
                            <div class="app-search dropdown d-lg-block mb-3">
                                <div class="input-group w-auto">
                                    <input type="search" class="form-control me-2"
                                        placeholder="Buscar productos por nombre o codigo..." wire:model="searchProduct"
                                        {{ !$editing->provider_id ? 'disabled' : '' }}>
                                    <span class="mdi mdi-magnify search-icon"></span>
                                    <button type="button" wire:click="clearCart" class="btn border border-secondary"
                                        {{ !$editing->provider_id ? 'disabled' : '' }}><i
                                            class="mdi mdi-reload"></i></button>
                                </div>

                                <div
                                    class="dropdown-menu dropdown-menu-animated dropdown-lg w-75 {{ $products ? 'd-block' : '' }}">
                                    @forelse ($products as $p)
                                        <span class="dropdown-item notify-item"
                                            wire:click.prevent="addProduct({{ $p->id }})">
                                            <span>{{ $p->name }}</span>
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
                            <x-table footer class="table-striped">
                                <x-slot name="head">
                                    <th width="40%">Producto</th>
                                    <th width="20%">Precio U.</th>
                                    <th width="15%">Cantidad</th>
                                    <th width="20%">Subtotal</th>
                                    <th width="10%">Acción</th>
                                </x-slot>

                                <x-slot name="body">
                                    @forelse($cart as $c)
                                        <x-table.row>
                                            <x-table.cell>{{ $c->name }}</x-table.cell>
                                            <x-table.cell>
                                                <input type="text" class="form-control w-auto"
                                                    value="S/ {{ number_format($c->price, 2) }}">
                                            </x-table.cell>
                                            <x-table.cell>
                                                <input type="text" id="r{{ $c->id }}"
                                                    wire:change="updateQuantityCart({{ $c->id }}, $('#r' + {{ $c->id }}).val())"
                                                    style="font-size: 1rem !important;" class="form-control text-center"
                                                    value="{{ $c->quantity }}">
                                            </x-table.cell>
                                            <x-table.cell>
                                                <input type="text" class="form-control w-auto"
                                                    value="S/ {{ number_format($c->quantity * $c->price, 2) }}"
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
                                            <x-table.cell class="text-center" colspan="5">
                                                No hay productos agregados a la compra
                                            </x-table.cell>
                                        </x-table.row>
                                    @endif

                                </x-slot>
                                <x-slot name="foot">
                                    <td colspan="2"></td>
                                    <td>TOTAL</td>
                                    <td>S/ {{ number_format($total, 2) }}</td>
                                </x-slot>
                            </x-table>

                        </div>

                        <div class="mt-2">
                            <button type="button" class="btn border border-danger me-2 ms-2" wire:click="cancel"
                                {{ !$editing->provider_id ? 'disabled' : '' }}>Cancelar</button>

                            <button type="submit" class="btn border border-primary me-2">
                                <span wire:loading.delay wire:target="save"
                                    class="spinner-border spinner-border-sm"></span>
                                Guardar
                            </button>

                            <button type="submit" wire:click="changeAnother" class="btn border border-secondary">
                                <span wire:loading.delay wire:target="save"
                                    class="spinner-border spinner-border-sm"></span>
                                Guardar y Crear
                            </button>
                        </div>

                    </x-form>
                </div>
            </div>
        </div>
    </div>

</div>
