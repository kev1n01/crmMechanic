<?php

namespace App\Http\Requests;

use App\Models\Provider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestProvider extends FormRequest
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
    public function rules($provider = null){ return [ 
        'editing.name' => ['required', 'min:4', 'max:20', Rule::unique('providers', 'name')->ignore($provider)],
        'editing.phone' => ['required', 'min:9', 'max:9', Rule::unique('providers', 'phone')->ignore($provider)],
        'editing.address' => ['min:5', 'max:30', Rule::unique('providers', 'address')->ignore($provider)],
        'editing.ruc' => ['required', 'min:11', 'max:11', Rule::unique('providers', 'ruc')->ignore($provider)],
        'editing.status' => 'nullable|in:'.collect(Provider::STATUSES)->keys()->implode(','),
    ];}

     public function messages(){ return [
        'editing.name.required' => 'El nombre es obligatorio',
        'editing.name.min' => 'El nombre debe tener al menos 4 caracteres',
        'editing.name.max' => 'El nombre no debe tener más de 20 caracteres',
        'editing.name.unique' => 'Este nombre ya fue registrado',
        
        'editing.phone.required' => 'El celular es obligatorio',
        'editing.phone.min' => 'El celular debe tener al menos 9 caracteres',
        'editing.phone.max' => 'El celular no debe tener más de 9 caracteres',
        'editing.phone.unique' => 'El celular ya fue registrado',

        'editing.address.min' => 'La dirección debe tener al menos 5 caracteres',
        'editing.address.max' => 'La dirección no debe tener más de 30 caracteres',
        'editing.address.unique' => 'La dirección ya fue registrado',

        'editing.ruc.required' => 'El ruc es obligatorio',
        'editing.ruc.min' => 'El ruc debe tener al menos 11 caracteres',
        'editing.ruc.max' => 'El ruc no debe tener más de 11 caracteres',
        'editing.ruc.unique' => 'El ruc ya fue registrado',
        
        'editing.status.in' => 'El valor es invalido',
     ];}
}
