<div>
    <div class="row mt-3">
        <div class="col-12">
            <x-form method="save">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2 g-2">
                            <x-input.input-tooltip-error class="col-xl-2" name="editing.code" label="Código"
                                type="text" :error="$errors->first('editing.code')" :required=true :disabled=true />

                            <x-input.select class="col-xl-4 mb-2" name="editing.customer" label="Cliente"
                                :required=true :options="$customers" :error="$errors->first('editing.customer')" />

                            <x-input.select class="col-xl-3 mb-2" name="editing.vehicle" label="Vehiculo"
                                :required=true :options="$vehicles" :error="$errors->first('editing.vehicle')" />

                            <x-input.input-tooltip-error class="col-xl-3 mb-2" name="editing.odo" label="ODO"
                                type="number" :error="$errors->first('editing.odo')" :required=true />

                            <x-input.datepicker class="col-xl-4" name="editing.arrival_date" label="Fecha llegada"
                                id="dp1" :error="$errors->first('editing.arrival_date')" :required=true />

                            <x-input.input-tooltip-error class="col-xl-2" name="editing.arrival_hour"
                                label="Hora llegada" type="time" :error="$errors->first('editing.arrival_hour')" :required=true />

                            <x-input.datepicker class="col-xl-4" name="editing.departure_date" label="Fecha salida"
                                id="dp2" :error="$errors->first('editing.departure_date')" />

                            <x-input.input-tooltip-error class="col-xl-2" name="editing.departure_hour"
                                label="Hora salida" type="time" :error="$errors->first('editing.departure_hour')" />

                            <x-input.select class="col-xl-4 mb-2" name="editing.type_atention" label="Tipo de atención"
                                :options="$types" :error="$errors->first('editing.type_atention')" :required=true/>

                            <x-input.textarea class="col-xl-8 " name="editing.observation" label="Observaciones" />
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
                                    <button type="button" wire:click="clearCart" class="btn border border-secondary"
                                        {{ !$editing->customer || !$editing->vehicle ? 'disabled' : '' }}><i
                                            class="mdi mdi-reload"></i></button>
                                </div>

                                <div id="scroll-products"
                                    class="dropdown-menu dropdown-menu-animated dropdown-lg w-75 {{ $concepts || $products ? 'd-block' : '' }}">
                                    <p class="text-center m-0 border border-secondary">SERVICIOS</p>
                                    @forelse ($concepts as $c)
                                        <span class="dropdown-item notify-item"
                                            wire:click.prevent="addConcept({{ $c->id }})">
                                            <span>⚒️ {{ $c->name . ' - '. $c->code}}</span>
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
                                            <span>📦 {{ $p->name.' - '. $p->code.' - '. $p->stock .' - '. $p->status}}</span>
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
                                        <x-table.row>
                                            <x-table.cell>{{ $c->name }}</x-table.cell>
                                            <x-table.cell>
                                                <input type="text" id="p{{ $c->id }}"
                                                    class="form-control w-auto"
                                                    wire:change="updatePriceCart({{ $c->id }}, $('#p' + {{ $c->id }}).val())"
                                                    value="{{ $c->price }}"
                                                    {{ strlen($c->id) != 1  ? 'disabled' : '' }}>
                                            </x-table.cell>
                                            <x-table.cell>
                                                <input type="number" id="r{{ $c->id }}" min="1"
                                                    wire:change="updateQuantityCart({{ $c->id }}, $('#r' + {{ $c->id }}).val(), $('#d'+{{ $c->id }}).val())"
                                                    style="font-size: 1rem !important;" class="form-control text-center"
                                                    value="{{ $c->quantity }}"
                                                    {{ strlen($c->id) == 1  ? 'disabled' : '' }}>
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
                        </div>

                        <div class="mt-2">
                            <button type="button" class="btn border border-danger me-2 ms-2" wire:click="cancel"
                                {{ !$editing->customer ? 'disabled' : '' }}>Cancelar</button>

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
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</div>
