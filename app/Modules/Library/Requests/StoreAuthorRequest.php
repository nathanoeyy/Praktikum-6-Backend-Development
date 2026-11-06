<?php

namespace App\Modules\Library\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email',
            'bio' => 'nullable|string|max:1000',
        ];
    }

    public function message(): array
    {
        return [
            'nama.required' => 'Nama penulis wajib diisi.',
            'nama.max' => 'Nama penulis maksimal 255 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Alamat email sudah digunakan.',
            'bio.max' => 'Biografi maksimal 1000 karakter.',
        ];
    }
}