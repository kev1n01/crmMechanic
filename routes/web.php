<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\dashboard\Dashboard;
use App\Http\Livewire\reminder\ReminderTable;
use App\Http\Livewire\customer\CustomerTable;
use App\Http\Livewire\Product\UnitProductTable;
use App\Http\Livewire\Product\ProductTable;
use App\Http\Livewire\Brand\BrandTable;
use App\Http\Livewire\Category\CategoryTable;
use App\Http\Livewire\Provider\ProviderTable;
use App\Http\Livewire\Purchase\PurchaseTable;
use App\Http\Livewire\Purchase\PurchaseEdit;
use App\Http\Livewire\Purchase\PurchaseCreate;
use App\Http\Livewire\Sale\SaleEdit;
use App\Http\Livewire\Sale\SaleTable;
use App\Http\Livewire\Sale\SaleCreate;
use App\Http\Livewire\Vehicle\VehicleTable;
use App\Http\Livewire\Vehicle\TypeVehicleTable;
use App\Http\Livewire\Vehicle\BrandVehicleTable;
use App\Http\Livewire\Vehicle\ColorVehicleTable;
use App\Http\Livewire\Vehicle\ModelVehicleTable;
use App\Http\Livewire\InvoiceForm\IFTable;
use App\Http\Livewire\Ot\OtEdit;
use App\Http\Livewire\Ot\OtTable;
use App\Http\Livewire\Ot\OtCreate;
use App\Http\Livewire\Ot\ConceptTable;
use App\Http\Livewire\Ot\OtEditDirect;
use App\Http\Livewire\Ot\OtCreateDirect;
use App\Http\Livewire\Report\OT;
use App\Http\Livewire\Report\Sale;
use App\Http\Livewire\Report\Purchase;
use App\Http\Livewire\Sunat\ComprobantTable;
use App\Http\Livewire\Sunat\CreateInvoiceTicket;
use App\Http\Livewire\Cost\CostTable;
use App\Http\Livewire\DuePay\DuePaytable;
use App\Http\Controllers\PDFController;
use App\Http\Livewire\User\UserView;
use App\Http\Livewire\User\UserCreate;

Route::get('/usercreate',  UserCreate::class)->name('user');
Route::get('/userview',  UserView::class)->name('user.view');
Route::redirect('/', 'dashboard');
//Rutas de dashboard
Route::get('dashboard', Dashboard::class)->name('dashboard');

//Rutas de cliente
Route::get('clientes', CustomerTable::class)->name('clientes');

//Rutas de informes
Route::get('informes', ReminderTable::class)->name('informes');

//Rutas de inventario
Route::get('unidades', UnitProductTable::class)->name('unidades');
Route::get('marcas', BrandTable::class)->name('marcas');
Route::get('categorias', CategoryTable::class)->name('categorias');
Route::get('proveedores', ProviderTable::class)->name('proveedores');
Route::get('productos', ProductTable::class)->name('productos');

//Rutas entradas y salidas de productos
Route::get('compras', PurchaseTable::class)->name('compras');
Route::get('crear-compra', PurchaseCreate::class)->name('compras.crear');
Route::get('editar-compra/{code}', PurchaseEdit::class)->name('compras.editar');
Route::get('ventas', SaleTable::class)->name('ventas');
Route::get('crear-venta', SaleCreate::class)->name('ventas.crear');
Route::get('editar-venta/{code}', SaleEdit::class)->name('ventas.editar');

//Rutas para registro de vehiculos
Route::get('tipos-vehiculo', TypeVehicleTable::class)->name('tipos.vehiculo');
Route::get('brands-vehiculo', BrandVehicleTable::class)->name('brands.vehiculo');
Route::get('modelos-vehiculo', ModelVehicleTable::class)->name('models.vehiculo');
Route::get('colors-vehiculo', ColorVehicleTable::class)->name('colors.vehiculo');
Route::get('vehiculos', VehicleTable::class)->name('vehiculos');

//Rutas para proforma
Route::get('proformas', IFTable::class)->name('proformas');
Route::get('crear-proforma', OtCreate::class)->name('proforma.orden.crear');
Route::get('editar-proforma/{code}', OtEdit::class)->name('proforma.orden.editar');

//Rutas para Orden de trabajo y servicios
Route::get('ordenes-trabajo', OtTable::class)->name('ordenes');
Route::get('crear-ot', OtCreateDirect::class)->name('orden.crear');
Route::get('editar-ot/{code}', OtEditDirect::class)->name('orden.editar');

Route::get('servicios', ConceptTable::class)->name('servicios');

//Rutas para finanzas
Route::get('deudas', DuePaytable::class)->name('deudas');
Route::get('gastos', CostTable::class)->name('gastos');

//Rutas para configuracion
Route::get('configuracion', function () {
    return view('configuration-index');
})->name('conf.index');

//Rutas para procesos de sunat
Route::get('sunat/crear-comprobante', CreateInvoiceTicket::class)->name('sunat.crear.comprobante');
Route::get('comprobantes', ComprobantTable::class)->name('comprobantes');

//Rutas para Reportes
Route::get('reporte/orden-trabajo', OT::class)->name('reporte.ot');
Route::get('reporte/venta', Sale::class)->name('reporte.venta');
Route::get('reporte/compra', Purchase::class)->name('reporte.compra');

//Rutas para PDF de proforma
Route::get('proforma/preview/{id}', [PDFController::class, 'previewPF'])->name('proforma.pdf.preview');
Route::get('proforma/view/{id}', [PDFController::class, 'viewPF'])->name('proforma.pdf.view');
Route::get('proforma/download/{id}', [PDFController::class, 'downloadPF'])->name('proforma.pdf.download');

//Rutas para PDF de ventas
Route::get('venta/preview/{id}', [PDFController::class, 'previewSale'])->name('venta.pdf.preview');
Route::get('venta/view/{id}', [PDFController::class, 'viewSale'])->name('venta.pdf.view');
Route::get('venta/download/{id}', [PDFController::class, 'downloadSale'])->name('venta.pdf.download');

//Rutas para PDF de compras
Route::get('compra/preview/{id}', [PDFController::class, 'previewPurchase'])->name('compra.pdf.preview');
Route::get('compra/view/{id}', [PDFController::class, 'viewPurchase'])->name('compra.pdf.view');
Route::get('compra/download/{id}', [PDFController::class, 'downloadPurchase'])->name('compra.pdf.download');

//Rutas para PDF de comprobantes
Route::get('comprobante/preview/{id}', [PDFController::class, 'previewComprobant'])->name('comprobante.pdf.preview');
Route::get('comprobante/view/{id}', [PDFController::class, 'viewComprobant'])->name('comprobante.pdf.view');
Route::get('comprobante/download/{id}', [PDFController::class, 'downloadComprobant'])->name('comprobante.pdf.download');
