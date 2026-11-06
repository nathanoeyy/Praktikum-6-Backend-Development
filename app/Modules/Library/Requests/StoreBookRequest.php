<?php 

namespace App\Modules\Library\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn|regex:/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/i',
            'tahun_terbit' => 'required|integer|min:1900|max:'  . date('Y'),
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'author_id' => 'required|exists:authors,id',
        ];
    }

    public function message(): array
    {
        return [
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.max' => 'Judul buku maksimal 255 karakter.',
            'isbn.required' => 'Nomor ISBN wajib diisi.',
            'isbn.unique' => 'Nomor ISBN sudah terdaftar.',
            'isbn.regex' => 'Format ISBN tidak valid.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka.',
            'tahun_terbit.min' => 'Tahun terbit minimal tahun 1900.',
            'tahun_terbit.max' => 'Tahun terbit tidak boleh melebihi tahun saat ini.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
            'stok.required' => 'Jumlah stok wajib diisi.',
            'stok.integer' => 'Jumlah stok harus berupa angka bulat.',
            'stok.min' => 'Jumlah stok tidak boleh kurang dari 0.',
            'author_id.required' => 'Penulis wajib dipilih.',
            'author_id.exists' => 'Penulis yang dipilih tidak ditemukan.',
        ];
    }
}