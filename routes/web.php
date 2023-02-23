<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'clientes');

//Rutas de dashboard
// Route::get('dashboard',\App\Http\Livewire\dashboard\Dashboard::class)->name('dashboard');

//Rutas de cliente
Route::get('clientes', \App\Http\Livewire\customer\CustomerTable::class)->name('clientes');

//Rutas de inventario
Route::get('marcas', \App\Http\Livewire\Brand\BrandTable::class)->name('marcas');
Route::get('categorias', \App\Http\Livewire\Category\CategoryTable::class)->name('categorias');
Route::get('proveedores', \App\Http\Livewire\Provider\ProviderTable::class)->name('proveedores');
Route::get('productos', \App\Http\Livewire\Product\ProductTable::class)->name('productos');

//Rutas entradas y salidas de productos
Route::get('compras', \App\Http\Livewire\Purchase\PurchaseTable::class)->name('compras');
Route::get('crear-compra', \App\Http\Livewire\Purchase\PurchaseCreate::class)->name('compras.crear');
Route::get('editar-compra/{code}', \App\Http\Livewire\Purchase\PurchaseEdit::class)->name('compras.editar');
Route::get('ventas', \App\Http\Livewire\Sale\SaleTable::class)->name('ventas');
Route::get('crear-venta', \App\Http\Livewire\Sale\SaleCreate::class)->name('ventas.crear');

//Rutas para registro de vehiculos
Route::get('tipos-vehiculo', \App\Http\Livewire\Vehicle\TypeVehicleTable::class)->name('tipos.vehiculo');
Route::get('brands-vehiculo', \App\Http\Livewire\Vehicle\BrandVehicleTable::class)->name('brands.vehiculo');
Route::get('modelos-vehiculo', \App\Http\Livewire\Vehicle\ModelVehicleTable::class)->name('models.vehiculo');
Route::get('colors-vehiculo', \App\Http\Livewire\Vehicle\ColorVehicleTable::class)->name('colors.vehiculo');
Route::get('vehiculos', \App\Http\Livewire\Vehicle\VehicleTable::class)->name('vehiculos');

//Rutas para proforma
Route::get('proformas', \App\Http\Livewire\InvoiceForm\IFTable::class)->name('proformas');
Route::get('proforma-crear', \App\Http\Livewire\Ot\OtCreate::class)->name('proforma.orden.crear');

//Rutas para Orden de trabajo
Route::get('ordenes-trabajo', \App\Http\Livewire\Ot\OtTable::class)->name('ordenes');
Route::get('servicios', \App\Http\Livewire\Ot\ConceptTable::class)->name('servicios');

//Rutas para deudas
Route::get('deudas', \App\Http\Livewire\DuePay\DuePaytable::class)->name('deudas');

//Rutas para Gastos
Route::get('gastos', \App\Http\Livewire\Cost\CostTable::class)->name('gastos');

//Rutas para Reportes
Route::get('reporte/orden-trabajo', \App\Http\Livewire\Report\OT::class)->name('reporte.ot');
Route::get('reporte/venta', \App\Http\Livewire\Report\Sale::class)->name('reporte.venta');
Route::get('reporte/compra', \App\Http\Livewire\Report\Purchase::class)->name('reporte.compra');

//Rutas para PDF de proforma
Route::get('proforma/preview/{id}', [\App\Http\Controllers\PDFController::class, 'preview'])->name('proforma.pdf.preview');
Route::get('proforma/view/{id}', [\App\Http\Controllers\PDFController::class, 'view'])->name('proforma.pdf.view');
Route::get('proforma/download/{id}', [\App\Http\Controllers\PDFController::class, 'download'])->name('proforma.pdf.download');

//Rutas para PDF de ventas

//Rutas para PDF de compras