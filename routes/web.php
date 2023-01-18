<?php

use Illuminate\Support\Facades\Route;

//Rutas de inventario
Route::redirect('/', 'categorias');
Route::get('marcas',\App\Http\Livewire\Brand\BrandTable::class)->name('marcas');
Route::get('categorias',\App\Http\Livewire\Category\CategoryTable::class)->name('categorias');
Route::get('proveedores',\App\Http\Livewire\Provider\ProviderTable::class)->name('proveedores');
Route::get('productos',\App\Http\Livewire\Product\ProductTable::class)->name('productos');

//Rutas entradas y salidas de productos
Route::get('compras',\App\Http\Livewire\Purchase\PurchaseTable::class)->name('compras');
Route::get('crear-compra',\App\Http\Livewire\Purchase\PurchaseCreate::class)->name('compras.crear');
Route::get('ventas',\App\Http\Livewire\Sale\SaleTable::class)->name('ventas');
Route::get('crear-venta',\App\Http\Livewire\Sale\SaleCreate::class)->name('ventas.crear');

//Rutas para registro de vehiculos
Route::get('tipos-vehiculo',\App\Http\Livewire\Vehicle\TypeVehicleTable::class)->name('tipos.vehiculo');
Route::get('brands-vehiculo',\App\Http\Livewire\Vehicle\BrandVehicleTable::class)->name('brands.vehiculo');
Route::get('modelos-vehiculo',\App\Http\Livewire\Vehicle\ModelVehicleTable::class)->name('models.vehiculo');
Route::get('colors-vehiculo',\App\Http\Livewire\Vehicle\ColorVehicleTable::class)->name('colors.vehiculo');
Route::get('vehiculos',\App\Http\Livewire\Vehicle\VehicleTable::class)->name('vehiculos');

//Rutas para Orden de trabajo
Route::get('ordenes',\App\Http\Livewire\Ot\OtTable::class)->name('ordenes');
Route::get('ordenes-crear',\App\Http\Livewire\Ot\OtCreate::class)->name('ordenes.crear');
Route::get('conceptos',\App\Http\Livewire\Ot\ConceptTable::class)->name('conceptos');

//Rutas para Gastos
Route::get('gastos',\App\Http\Livewire\Cost\CostTable::class)->name('gastos');

