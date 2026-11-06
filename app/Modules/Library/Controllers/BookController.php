<?php

namespace App\Modules\Library\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Library\Models\Book;
use App\Modules\Library\Models\Author;
use App\Modules\Library\Requests\StoreBookRequest;
use App\Modules\Library\Exceptions\BookNotAvailableException;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->get();
        $authors = Author::all();
        return view('Library::books.index', compact('books', 'authors'));
    }

    public function store(StoreBookRequest $request)
    {
        Book::create($request->validated());
        return redirect()->back()->with('success', 'Buku berhasil ditambahkan!.');
    }

    public function pinjam(Book $book)
    {
        // fitur plus : validasi stok sebelum peminjaman
        if ($book->stok <= 0) {
            $errorMessage = "Peminjaman Gagal: Stok buku '{$book->judul}' bernilai 0.";

            // fitur plus: log error ke storage/logs/laravel.log
            Log::error($errorMessage);

            throw new BookNotAvailableException("Buku '{$book->judul}' tidak tersedia untuk dipinjam.");
        }

        $book->decrement('stok', 1);
        return redirect()->back()->with('success', "Buku '{$book->judul}' berhasil dipinjam.");
    }

    public function kembali(Book $book)
    {
        // Tambah stok buku sebanyak 1
        $book->increment('stok', 1);

        return redirect()->back()->with('success', "Buku '{$book->judul}' berhasil dikembalikan! Stok bertambah.");
    }
}