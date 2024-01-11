<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\UnitProduct;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules($product = null)
    {
        return [
            'editing.name' => ['required', 'min:4', 'max:50', Rule::unique('products', 'name')->ignore($product)],
            'editing.code' => ['required', 'min:4', 'max:15', Rule::unique('products', 'code')->ignore($product)],
            'editing.sku' => ['required', Rule::unique('products', 'sku')->ignore($product)],
            'editing.stock' => 'required|integer',
            'editing.sale_price' => 'required|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'editing.purchase_price' => 'required|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'editing.category_products_id' => ['nullable'],
            'editing.brand_products_id' => ['nullable'],
            'editing.image' => ['nullable'],
            'editing.status' => 'required|in:' . collect(Product::STATUSES)->keys()->implode(','),
            'editing.unit_products_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'editing.name.min' => 'El nombre no debe tener menos de 4 caracteres',
            'editing.name.max' => 'El nombre no debe tener más de 50 caracteres',
            'editing.name.required' => 'El nombre es obligatorio',
            'editing.name.unique' => 'Ya existe un producto con el mismo nombre',
            'editing.stock.integer' => 'El stock tiene que ser un número entero',
            'editing.stock.required' => 'El stock es obligatorio',
            'editing.sku.required' => 'El sku es obligatorio',
            'editing.sku.unique' => 'Ya existe un sku con el mismo nombre',
            'editing.code.min' => 'El código no debe tener menos de 4 caracteres',
            'editing.code.max' => 'El código no debe tener más de 15 caracteres',
            'editing.code.required' => 'El código es obligatorio',
            'editing.code.unique' => 'Ya existe un producto con este código',
            'editing.sale_price.numeric' => 'El precio venta tiene que ser entero o decimal',
            'editing.sale_price.regex' => 'El formato decimal de precio es incorrecto',
            'editing.sale_price.required' => 'El precio de venta es obligatorio',
            'editing.purchase_price.regex' => 'El formato decimal de precio es incorrecto',
            'editing.purchase_price.required' => 'El precio de compra es obligatorio',
            'editing.purchase_price.numeric' => 'El precio compra tiene que ser entero o decimal',
            'editing.status.required' => 'El estado es obligatorio',
            'editing.status.in' => 'El estado es inválido',
            'editing.unit_products_id.required' => 'La unidad de producto es obligatoria',
        ];
    }
}
