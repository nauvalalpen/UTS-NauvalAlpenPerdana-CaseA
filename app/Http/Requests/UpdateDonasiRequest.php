<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDonasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         // Get the ID of the donation being edited from the route
        $donasiId = $this->route('donasi')->id; // 'donasi' is the parameter name in the resource route

        return [
             'nama_donatur' => 'required|string|max:255',
             // Email must be unique, EXCEPT for the donation record itself
             'email' => ['nullable','email','max:255', Rule::unique('donasis', 'email')->ignore($donasiId)],
             'nominal' => 'required|numeric|min:1000',
             'metode_pembayaran' => 'required|string|max:100',
             'tanggal_donasi' => 'required|date',
             'status' => ['required', Rule::in(['menunggu konfirmasi', 'dikonfirmasi', 'batal'])],
        ];
    }

    /**
     * Custom message for validation (Can copy from StoreDonasiRequest)
     * @return array
     */
    public function messages()
    {
        return [
            'nama_donatur.required' => 'Nama donatur wajib diisi.',
            'nominal.required' => 'Nominal donasi wajib diisi.',
            'nominal.numeric' => 'Nominal harus berupa angka.',
            'nominal.min' => 'Nominal minimal adalah 1000.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'tanggal_donasi.required' => 'Tanggal donasi wajib diisi.',
            'tanggal_donasi.date' => 'Format tanggal tidak valid.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
            'metode_pembayaran.required' => 'Metode pembayaran wajib diisi.',
        ];
    }
}