<div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-sm-6 col-xl-3 ">
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
                                    <h3><span> {{ \App\Models\Sale::where('status')->count() }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Ventas</p>
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
                                    <h3><span>{{ \App\Models\Vehicle::count() }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Vehiculos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-sm-6 col-xl-3">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Today</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Last Week</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                                </div>
                            </div>
                            <h4 class="header-title mb-0">Estado de compras</h4>
                            {!! $chart_purchase->container() !!}
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Today</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Last Week</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                                </div>
                            </div>
                            <h4 class="header-title mb-0">Estado de OT</h4>
                            {!! $chart_ot->container() !!}
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Today</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Last Week</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                                </div>
                            </div>
                            <h4 class="header-title mb-0">Estado de Proforma</h4>
                            {!! $chart_i->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Today</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Last Week</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                                </div>
                            </div>
                            <h4 class="header-title mb-0">Ventas por mes</h4>
                            {{-- <div>
                                <x-input.datepicker class="col-xl-3 left-4" name="date_for_sale" label=""
                                    id="dp1" :required=false />
                            </div> --}}
                            {!! $chart_sale->container() !!}
                            </iv>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ $chart_purchase->cdn() }}"></script>
        {{ $chart_purchase->script() }}
        {{ $chart_sale->script() }}
        {{ $chart_ot->script() }}
        {{ $chart_i->script() }}
    @endpush
