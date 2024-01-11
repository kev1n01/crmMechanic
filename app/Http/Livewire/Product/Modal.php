<?php

namespace App\Http\Livewire\Product;

use App\Http\Requests\RequestProduct;
use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\UnitProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Modal extends Component
{
    use WithFileUploads;

    public $idModal = 'productModal';
    public $nameModal;
    public Product $editing;
    public $image;

    public $statuses = [];
    public $units = [];
    public $brands = [];
    public $categories = [];
    protected $listeners = ['createproduct' => 'create', 'editproduct' => 'edit', 'refreshmodal' => 'mount'];

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
        $this->statuses = Product::STATUSES;
        $this->units = UnitProduct::pluck('name', 'id');
        $this->editing->unit_products_id = 1;
        $this->brands = BrandProduct::pluck('name', 'id');
        $this->categories = CategoryProduct::pluck('name', 'id');
    }

    public function code_random()
    {
        $code = random_int(1000, 99999);
        $product = Product::where('code', $code)->first();
        if ($product) {
            $this->code_random();
        }
        return $code;
    }

    public function updatedEditingSku($value)
    {
        $this->editing->sku = strtoupper($value);
    }

    public function rules()
    {
        return (new RequestProduct())->rules($this->editing);
    }

    public function messages()
    {
        return (new RequestProduct())->messages();
    }

    public function updatingImage($value)
    {
        Validator::make(
            ['image' => $value],
            ['image' => 'mimes:jpg,jpeg,png|max:1024'],
            [
                'image.mimes' => 'Solo se permite imagenes de tipo jpg, jpeg, png',
                'image.max' => 'El tamaño máximo de la imagen es 1MB',
            ]
        )->validate();
    }

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
        $this->dispatchBrowserEvent('close-modal-product');
        $this->emit('refreshList');
        $this->emit('refreshListModals');
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages());
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
        return Product::make(['status' => 'activo', 'stock' => 0, 'sale_price' => 0, 'purchase_price' => 0]); /*para dejar vacios los inpust*/
    }

    public function create()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->image = '';
        $this->nameModal = 'Crear nuevo producto';
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs
        $this->editing->code = $this->code_random();
        $this->dispatchBrowserEvent('open-modal-product');
    }

    public function edit(Product $product)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->image = '';
        $this->nameModal = 'Editar producto';
        $this->dispatchBrowserEvent('open-modal-product');
        if ($this->editing->isNot($product)) $this->editing = $product; // para preservar cambios en los inputs
        
        $this->emit('refreshList');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-product');
    }

    public function cancel()
    {
        $this->dispatchBrowserEvent('close-modal-product');
    }

    public function render()
    {
        return view('livewire.product.modal');
    }
}
