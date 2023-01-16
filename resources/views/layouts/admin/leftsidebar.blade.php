<div class="leftside-menu">

    <!-- LOGO -->
    <a href="#" class="logo text-center logo-light">
        <span class="logo-lg fs-3">
            <p class="mb-0 "><strong class="text-white">FLO</strong><strong class="text-primary">PAC</strong></p>
        </span>
        <span class="logo-sm fs-4">
            <p class="mb-0"><strong class="text-white">F</strong><strong class="text-primary">P</strong></p>
        </span>
    </a>

    <!-- LOGO -->
    <a href="#" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo_mechanic.png') }}" alt="" height="30">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo_mechanic_sm.png') }}" alt="" height="30">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-item">
                <a class="side-nav-link">
                    <i class=" uil-chart-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#inventario" aria-expanded="false" aria-controls="inventario"
                    class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> Inventario </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="inventario">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('categorias') }}">Categorias</a>
                        </li>
                        <li>
                            <a href="{{ route('marcas') }}">Marcas</a>
                        </li>
                        <li>
                            <a href="{{ route('proveedores') }}">Proveedores</a>
                        </li>
                        <li>
                            <a href="{{ route('productos') }}">Productos</a>
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
                            <a href="{{ route('compras') }}">Listado</a>
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
                            <a href="{{ route('ventas') }}">Listado</a>
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
                    <i class=" uil-car-sideview"></i>
                    <span> Vehiculos </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="vehiculos">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('vehiculos') }}">Listado</a>
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
                <a data-bs-toggle="collapse" href="#ot" aria-expanded="false" aria-controls="ot"
                    class="side-nav-link">
                    <i class=" uil-suitcase-alt"></i>
                    <span> Orden de trabajo </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="ot">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('ordenes') }}">Listado</a>
                        </li>
                        <li>
                            <a href="{{ route('ordenes.crear') }}">Crear OT</a>
                        </li>
                        <li>
                            <a href="{{ route('conceptos') }}">Conceptos</a>
                        </li>
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
                            <a href="#">OT</a>
                        </li>
                        <li>
                            <a href="#">Ventas</a>
                        </li>
                        <li>
                            <a href="#">Compras</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#facturas" aria-expanded="false" aria-controls="facturas"
                    class="side-nav-link">
                    <i class="uil-invoice"></i>
                    <span> Facturas </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="facturas">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="#">Listado</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('gastos') }}" class="side-nav-link">
                    <i class="uil-usd-circle"></i>
                    <span>Gastos</span>
                </a>
            </li>

        </ul>

        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
