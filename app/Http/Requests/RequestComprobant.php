<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestComprobant extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'comprobant.tipoDoc' => ['required'],
            'comprobant.serie' => ['required'],
            'comprobant.correlativo' => ['required'],
            'comprobant.fechaEmision' => ['required'],
            'comprobant.moneda' => ['required'],
            'comprobant.tipoPago' => ['required'],
            'selectCustomer' => ['required'],
        ];
    }
    
    public function messages()
    {
        return [
            'comprobant.tipoDoc.required' => 'El tipo de comprobante es obligatorio',
            'comprobant.serie.required' => 'La serie es obligatorio',
            'comprobant.correlativo.required' => 'El correlativo es obligatorio',
            'comprobant.fechaEmision.required' => 'La fecha de emision es obligatorio',
            'comprobant.moneda.required' => 'La moneda es obligatorio',
            'comprobant.tipoPago.required' => 'El tipo de pago es obligatorio',
            'selectCustomer.required' => 'El cliente es obligatorio',
        ];
    }
}
