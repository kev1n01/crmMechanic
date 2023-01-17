<?php

namespace App\Http\Livewire\Product;

use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Traits\DataTable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ProductTable extends Component
{
    use DataTable;
    use WithFileUploads;

    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;
    /* FOR MODAL */
    public $idModal = 'productModal';
    public $nameModal;
    public Product $editing;
    public $image;

    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'status' => '',
        'category' => '',
        'brand' => ''
    ];

    protected $listeners = ['delete', 'deleteSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->sortField = 'name';
        $this->editing = $this->makeBlankFields();
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
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }

    /* FOR MODAL */
    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:5', 'max:30', Rule::unique('products', 'name')->ignore($this->editing)],
            'editing.code' => ['required', 'min:5', 'max:5', Rule::unique('products', 'code')->ignore($this->editing)],
            'editing.stock' => 'nullable|integer',
            'editing.sale_price' => 'nullable|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'editing.purchase_price' => 'nullable|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'editing.category_products_id' => ['required'],
            'editing.brand_products_id' => ['required',],
            'editing.image' => 'nullable',
            'editing.status' => 'in:' . collect(Product::STATUSES)->keys()->implode(','),
        ];
    }

    protected $messages = [
        'editing.name.min' => 'El nombre no debe tener menos de 5 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 30 caracteres',
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.unique' => 'Ya existe un producto con el mismo nombre',
        'editing.stock.integer' => 'El stock tiene que ser un número entero',
        'editing.code.min' => 'El código no debe tener menos de 5 caracteres',
        'editing.code.max' => 'El código no debe tener más de 5 caracteres',
        'editing.code.required' => 'El código es obligatorio',
        'editing.code.unique' => 'Ya existe un producto con este código',
        'editing.sale_price.numeric' => 'El precio venta tiene que ser entero o decimal',
        'editing.sale_price.regex' => 'El formato decimal de precio es incorrecto',
        'editing.purchase_price.regex' => 'El formato decimal de precio es incorrecto',
        'editing.purchase_price.numeric' => 'El precio compra tiene que ser entero o decimal',
        'editing.category_products_id.required' => 'La categoria es obligatorio',
        'editing.brand_products_id.required' => 'La marca es obligatorio',
        'editing.status.in' => 'El valor es inválido',
        // 'editing.image.mimes' => 'Solo se permite jpg, jpge, png',

    ];

    public function save()
    {
        $this->validate();

        if ($this->editing->image != null) {
            $this->removeImage($this->editing->image);
        }

        if ($this->image) {
            $this->editing->image = $this->loadImage($this->image);
        }

        $this->editing->save();
        $this->nameModal === 'Crear nuevo producto' ? $this->emit('success_alert', 'Producto creado') : $this->emit('success_alert', 'Producto actualizado');
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('refreshList');
    }

    public function loadImage(TemporaryUploadedFile $image)
    {
        return Storage::disk('public')->put('productos', $image);
    }

    public function removeImage($image)
    {
        if (!$image) return;
        if (Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
    }

    public function makeBlankFields()
    {
        return Product::make(['status' => 'activo', 'stock' => 0]); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->image = '';
        $this->nameModal = 'Crear nuevo producto';
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->dispatchBrowserEvent('open-modal');
    }

    public function edit(Product $produc)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->image = '';
        $this->nameModal = 'Editar producto';
        if ($this->editing->isNot($produc)) $this->editing = $produc; // para preservar cambios en los inputs
        $this->dispatchBrowserEvent('open-modal');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }
}
