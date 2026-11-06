<?php

namespace App\Modules\Library\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Library\Models\Author;
use App\Modules\Library\Requests\StoreAuthorRequest;
use App\Modules\Library\Exceptions\AuthorHasBooksException;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->get();
        return view('Library::authors.index', compact('authors'));
    }

    public function store(StoreAuthorRequest $request)
    {
        Author::create($request->validated());
        return redirect()->back()->with('success', 'Penulis berhasil ditambahkan!.');
    }

    public function destroy(Author $author)
    {
        // exception ketika penulis yang masih memiliki buku dihapus
        if ($author->books()->count() > 0) {
            $errorMessage = "Gagal menghapus: Penulis '{$author->nama}' masih memiliki {$author->books()->count()} buku.";

            // fitur plus : log error ke storage/logs/laravel.log
            Log::error($errorMessage);

            throw new AuthorHasBooksException($errorMessage);
        }

        $author->delete();
        return redirect()->back()->with('success', 'Penulis berhasil dihapus!');
    }
}