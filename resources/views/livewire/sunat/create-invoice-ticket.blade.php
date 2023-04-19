@section('title', 'Crear comprobante')
<div>
    <div class="row mt-3">
        <div class="col-12">
            <x-form method="save">
                <div class="row">
                    <div class="d-flex flex-row-reverse bd-highlight mt-2 mb-3">
                        <button type="button" class="btn border border-danger me-2 ms-2"
                            wire:click="cancel">Cancelar</button>

                        <button type="submit" wire:click="changeAnother" class="btn border border-secondary">
                            <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                            Guardar y Crear
                        </button>

                        <button type="submit" class="btn border border-primary me-2">
                            <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                            Guardar
                        </button>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-2">
                                    <x-input.select class="col-xl-3" name="comprobant.tipoDoc" :options="$typescpe"
                                        label="Tipo de CPE" type="text" :error="$errors->first('comprobant.tipoDoc')" :required=true />

                                    <x-input.select class="col-xl-3" name="select_id" :options="$sales"
                                        label="Venta o OT" type="text" :error="$errors->first('select_id')" :required=true />

                                    @if ($comprobant->tipoDoc)
                                        <x-input.input-tooltip-error class="col-xl-2" name="serial" label="Serie"
                                            type="text" :error="$errors->first('serial')" :required=true />

                                        <x-input.input-tooltip-error class="col-xl-3" name="correlative"
                                            label="Correlativo" type="text" :error="$errors->first('correlative')" :required=true />
                                    @endif

                                    <x-input.datepicker class="col-xl-4   mt-2" name="fechaEmision" label="Fecha"
                                        id="dp1" :error="$errors->first('fechaEmision')" :required=true />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</div>
