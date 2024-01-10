<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestCustomer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules($customer = null)
    {
        return [
            'editing.name' => ['required', 'min:3', 'max:100 ', Rule::unique('customers', 'name')->ignore($customer)],
            'editing.num_doc' => ['nullable', Rule::unique('customers', 'num_doc')->ignore($customer)],
            'editing.address' => ['nullable', 'min:5', 'max:100', Rule::unique('customers', 'address')->ignore($customer)],
            'editing.phone' => ['required', 'min:9', 'max:9', Rule::unique('customers', 'phone')->ignore($customer)],
            'editing.email' => ['nullable', 'email', Rule::unique('customers', 'email')->ignore($customer)],
            'editing.status' => 'required|in:' . collect(Customer::STATUSES)->keys()->implode(','),
            'type_doc' => 'required|in:' . collect(Customer::TYPE_DOCUMENTS)->keys()->implode(','),
        ];
    }

    public function messages()
    {
        return [
            'editing.name.required' => 'El nombre es obligatorio',
            'editing.name.min' => 'El nombre debe tener al menos 3 caracteres',
            'editing.name.max' => 'El nombre no debe tener más de 100 caracteres',
            'editing.name.unique' => 'Este nombre ya fue registrado',

            'editing.num_doc.unique' => 'El numero de documento ya fue registrado',

            'editing.address.min' => 'La dirección debe tener al menos 5 caracteres',
            'editing.address.max' => 'La dirección no debe tener más de 100 caracteres',
            'editing.address.unique' => 'La dirección ya fue registrado',

            'editing.phone.required' => 'El celular es obligatorio',
            'editing.phone.min' => 'El celular debe tener al menos 9 caracteres',
            'editing.phone.max' => 'El celular no debe tener más de 9 caracteres',
            'editing.phone.unique' => 'El celular ya fue registrado',

            'editing.status.in' => 'El valor es inválido',
            'editing.status.required' => 'El estado es obligatorio',

            'type_doc.in' => 'El valor es inválido',
            'type_doc.required' => 'El tipo de documento es obligatorio',

            'editing.email.unique' => 'Este correo ya fue registrado',
            'editing.email.email' => 'El correo ingresado es inválido',
        ];
    }
}
