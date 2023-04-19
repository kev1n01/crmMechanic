<div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="dripicons-user-group text-muted " style="font-size: 24px;"></i>
                                    <h3><span> {{ \App\Models\Customer::count() }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Clientes</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="dripicons-cart text-muted" style="font-size: 24px;"></i>
                                    <h3><span> {{ \App\Models\Sale::where('status','pagado')->count() }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Ventas facturadas</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="uil-box text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ \App\Models\Product::count() }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Productos</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class=" uil-car-sideview text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ \App\Models\Vehicle::count() }}</span>
                                        <p class="text-muted font-15 mb-0">Vehiculos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
@endpush
