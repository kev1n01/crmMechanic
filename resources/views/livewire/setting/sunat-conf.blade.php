<div>
    <x-form method="save">
        <div class="card">
            <div class="card-body">
                <div class="row g-2">
                    <x-input.input-tooltip-error class="col-xl-4" name="editing.ruc" label="Ruc de facturación"
                        type="text" :error="$errors->first('editing.ruc')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-8" name="editing.social_reason" label="Razón social"
                        type="text" :error="$errors->first('editing.social_reason')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-12" name="editing.address" label="Domicilio Fiscal"
                        type="text" :error="$errors->first('editing.address')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.user_sol_secondary"
                        label="Usuario secundario" type="text" :error="$errors->first('editing.user_sol_secondary')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.password_sol_secondary"
                        label="Contraseña de usuario sol" type="text" :error="$errors->first('editing.password_sol_secondary')" :required=true />

                    <x-input.input-tooltip-error class="col-xl-6" name="certificate" label="Certificado digial (PFX)"
                        type="file" :error="$errors->first('certificate')" :required=true  accept=".pfx"/>

                    <x-input.input-tooltip-error class="col-xl-6" name="editing.certificate_password"
                        label="Contraseña del certificado" type="text" :error="$errors->first('editing.certificate_password')" :required=true />
                </div>
            </div>
            <div class="d-flex flex-row-reverse bd-highlight mt-1 mb-3">
                <button type="submit" class="btn btn-primary me-3">
                    <span wire:loading.delay wire:target="save" class="spinner-border spinner-border-sm"></span>
                    Guardar
                </button>
            </div>
        </div>
    </x-form>
</div>
