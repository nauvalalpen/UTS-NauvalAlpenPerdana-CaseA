<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDonasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'nama_donatur' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:donasis,email',
            'nominal' => 'required|numeric|min:10000',
            'metode_pembayaran' => 'required|string|max:255',
            'tanggal_donasi' => 'required|date',
            'status' => [
                'required',
                'string',
                'max:255',
                Rule::in(['menunggu konfirmasi', 'dikonfirmasi', 'batal']),
            ]
        ];
    }

    public function messages(){
        return [
            'nama_donatur.required' => 'Nama donatur harus diisi',
            'nominal.required' => 'Nominal harus diisi',
            'nominal.numeric' => 'Nominal harus berupa angka',
            'nominal.min' => 'Nominal minimal 10000',
            'email.email' => 'Email harus berupa email yang valid',
            'email.unique' => 'Email ini sudah terdaftar',
            'tanggal_donasi.required' => 'Tanggal donasi harus diisi',
            'tanggal_donasi.date' => 'Tanggal donasi harus berupa tanggal',
            'status.required' => 'Status harus diisi',
            'status.in' => 'Status yang dipilih tidak valid',
            'metode_pembayaran.required' => 'Metode pembayaran harus diisi',
        ];
    }
}
