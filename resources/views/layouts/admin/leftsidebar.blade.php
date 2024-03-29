<div class="leftside-menu position-fixed">

    <!-- LOGO -->
    <a href="#" class="logo text-center logo-light">
        <span class="logo-lg fs-3">
            <p class="mb-0 "><strong class="text-white">FLO</strong><strong class="text-primary">PACH</strong></p>
        </span>
        <span class="logo-sm fs-4">
            <p class="mb-0"><strong class="text-white">F</strong><strong class="text-primary">P</strong></p>
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-item">
                <a class="side-nav-link" href="{{ route('dashboard') }}">
                    <i class=" uil-chart-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a class="side-nav-link" href="{{ route('clientes') }}">
                    <i class=" uil-users-alt"></i>
                    <span class="badge bg-primary float-end">
                        {{ \App\Models\Customer::count() }}
                    </span>
                    <span> Clientes </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a class="side-nav-link" href="{{ route('informes') }}">
                    <i class="uil-stopwatch"></i>
                    <span> Informes </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#inventario" aria-expanded="false" aria-controls="inventario"
                    class="side-nav-link">
                    <i class="uil-box"></i>
                    <span> Inventario </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="inventario">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('unidades') }}">Unidades</a>
                        </li>
                        <li>
                            <a href="{{ route('categorias') }}">Categorias</a>
                        </li>
                        <li>
                            <a href="{{ route('marcas') }}">Marcas</a>
                        </li>
                        <li>
                            <a href="{{ route('proveedores') }}">Proveedores
                                <span class="badge bg-primary float-end">
                                    {{ \App\Models\Provider::count() }}
                                </span></a>
                        </li>
                        <li>
                            <a href="{{ route('productos') }}">Productos
                                <span class="badge bg-primary float-end">
                                    {{ \App\Models\Product::count() }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#compras" aria-expanded="false" aria-controls="compras"
                    class="side-nav-link">
                    <i class="uil-cart"></i>
                    <span> Compras </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="compras">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('compras') }}">Listado
                                <span class="badge bg-primary float-end">
                                    {{ \App\Models\Purchase::count() }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('compras.crear') }}">Crear compra</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#ventas" aria-expanded="false" aria-controls="ventas"
                    class="side-nav-link">
                    <i class="uil-shopping-trolley"></i>
                    <span> Ventas </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="ventas">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('ventas') }}">Listado
                                <span class="badge bg-primary float-end">
                                    {{ \App\Models\Sale::count() }}
                                </span></a>
                        </li>
                        <li>
                            <a href="{{ route('ventas.crear') }}">Crear Venta</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#vehiculos" aria-expanded="false" aria-controls="vehiculos"
                    class="side-nav-link">
                    <i class="mdi mdi-car-multiple"></i>
                    <span> Vehiculos </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="vehiculos">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('vehiculos') }}">Listado
                                <span class="badge bg-primary float-end">
                                    {{ \App\Models\Vehicle::count() }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tipos.vehiculo') }}">Tipo</a>
                        </li>
                        <li>
                            <a href="{{ route('brands.vehiculo') }}">Marca</a>
                        </li>
                        <li>
                            <a href="{{ route('models.vehiculo') }}">Modelo</a>
                        </li>
                        <li>
                            <a href="{{ route('colors.vehiculo') }}">Color</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#formpro" aria-expanded="false" aria-controls="formpro"
                    class="side-nav-link">
                    <i class="uil-clipboard-notes"></i>
                    <span>Proformas</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="formpro">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('proformas') }}">Listado</a>
                        </li>
                        <li>
                            <a href="{{ route('proforma.orden.crear') }}">Crear Proforma</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#ot" aria-expanded="false" aria-controls="ot"
                    class="side-nav-link">
                    <i class=" uil-suitcase-alt"></i>
                    <span> Ordenes de trabajo </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="ot">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('ordenes') }}">Listado
                                <span class="badge bg-primary float-end">
                                    {{ \App\Models\WorkOrder::where('is_confirmed', 1)->count() }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('orden.crear') }}">Crear OT
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('servicios') }}">Servicios
                                <span class="badge bg-primary float-end">
                                    {{ \App\Models\Concept::count() }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sunat" aria-expanded="false" aria-controls="sunat"
                    class="side-nav-link">
                    <i class="uil-invoice"></i>
                    <span>Facturación</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sunat">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('comprobantes') }}">Listado</a>
                        </li>
                        <li>
                            <a href="{{ route('sunat.crear.comprobante') }}">Emitir</a>
                        </li>
                        {{-- 
                        <li>
                            <a href="#">Notas de crédito</a>
                        </li> --}}
                    </ul>
                </div>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#reportes" aria-expanded="false" aria-controls="reportes"
                    class="side-nav-link">
                    <i class="uil-file-search-alt"></i>
                    <span> Reportes </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="reportes">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('reporte.ot') }}">OT</a>
                        </li>
                        <li>
                            <a href="{{ route('reporte.venta') }}">Ventas</a>
                        </li>
                        <li>
                            <a href="{{ route('reporte.compra') }}">Compras</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#finanzas" aria-expanded="false" aria-controls="finanzas"
                    class="side-nav-link">
                    <i class="uil-usd-circle"></i>
                    <span> Finanzas </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="finanzas">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('deudas') }}">Deudas por cobrar
                                <span class="badge bg-primary float-end">
                                    {{ \App\Models\DuePay::count() }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gastos') }}">Gastos</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a class="side-nav-link" href="{{ route('conf.index') }}">
                    <i class="dripicons-gear"></i>
                    <span> Configuración </span>
                </a>
            </li>
        </ul>

        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
