<?php

namespace App\Http\Livewire\Product;

use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Traits\DataTable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductTable extends Component
{
    use DataTable;
    use WithFileUploads;

    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;

    public $statuses = [];
    public $brands = [];
    public $categories = [];
    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'status' => '',
        'category' => '',
        'brand' => ''
    ];

    protected $listeners = ['delete', 'deleteSelected','exportSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->search = '';
        $this->sortField = 'name';
        $this->statuses = Product::STATUSES;
        $this->brands = BrandProduct::pluck('name', 'id');
        $this->categories = CategoryProduct::pluck('name', 'id');
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->products->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getProductsProperty()
    {
        return Product::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
            ->when($this->search, fn ($q, $search) => $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%')->orWhere('stock', 'like', '%' . $search . '%'))
            ->when($this->filters['status'], fn ($q, $status) => $q->where('status', $status))
            ->when($this->filters['category'], fn ($q, $category) => $q->where('category_products_id', $category))
            ->when($this->filters['brand'], fn ($q, $brand) => $q->where('brand_products_id', $brand))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.product.product-table', [
            'products' => $this->products,
        ])->extends('layouts.admin.app')->section('content');
    }

    public function delete(Product $product)
    {
        $this->removeImage($product->image);
        $product->delete();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo Product::whereKey($this->selected)->toCsv();
        }, 'productos.csv');
        $this->selected = [];
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $product = Product::whereKey($this->selected);
        $productfind = Product::find($this->selected);
        foreach ($productfind as $pf) {
            $this->removeImage($pf['image']);
        }
        $product->delete();
        $this->selected = [];
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }

    public function changeStatus(Product $product)
    {
        $product->status = $product->status === 'activo' ? 'inactivo' : 'activo';
        $product->save();
        $this->emit('success_alert', 'Estado actualizado');
    }
    

    public function removeImage($image)
    {
        if (!$image) return;
        if (Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
    }
}
