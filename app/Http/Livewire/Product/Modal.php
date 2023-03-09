<?php

namespace App\Http\Livewire\Product;

use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
    public $brands = [];
    public $categories = [];
    protected $listeners = ['createproduct' => 'create', 'editproduct' => 'edit'];

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
        $this->statuses = Product::STATUSES;
        $this->brands = BrandProduct::pluck('name', 'id');
        $this->categories = CategoryProduct::pluck('name', 'id');
    }

    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:4', 'max:50', Rule::unique('products', 'name')->ignore($this->editing)],
            'editing.code' => ['required', 'min:4', 'max:15', Rule::unique('products', 'code')->ignore($this->editing)],
            'editing.stock' => 'nullable|integer',
            'editing.sale_price' => 'nullable|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'editing.purchase_price' => 'nullable|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'editing.category_products_id' => ['required'],
            'editing.brand_products_id' => ['required',],
            'editing.image' => ['nullable'],
            'editing.status' => 'required|in:' . collect(Product::STATUSES)->keys()->implode(','),
        ];
    }

    protected $messages = [
        'editing.name.min' => 'El nombre no debe tener menos de 4 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 50 caracteres',
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.unique' => 'Ya existe un producto con el mismo nombre',
        'editing.stock.integer' => 'El stock tiene que ser un número entero',
        'editing.code.min' => 'El código no debe tener menos de 4 caracteres',
        'editing.code.max' => 'El código no debe tener más de 15 caracteres',
        'editing.code.required' => 'El código es obligatorio',
        'editing.code.unique' => 'Ya existe un producto con este código',
        'editing.sale_price.numeric' => 'El precio venta tiene que ser entero o decimal',
        'editing.sale_price.regex' => 'El formato decimal de precio es incorrecto',
        'editing.purchase_price.regex' => 'El formato decimal de precio es incorrecto',
        'editing.purchase_price.numeric' => 'El precio compra tiene que ser entero o decimal',
        'editing.category_products_id.required' => 'La categoria es obligatorio',
        'editing.brand_products_id.required' => 'La marca es obligatorio',
        'editing.status.required' => 'El estado es obligatorio',
        'editing.status.in' => 'El valor es inválido',
    ];

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
        $this->validateOnly($label, $this->rules(), $this->messages);
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
        $this->dispatchBrowserEvent('open-modal-product');
    }

    public function edit(Product $produc)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->image = '';
        $this->nameModal = 'Editar producto';
        $this->dispatchBrowserEvent('open-modal-product');
        if ($this->editing->isNot($produc)) $this->editing = $produc; // para preservar cambios en los inputs
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
