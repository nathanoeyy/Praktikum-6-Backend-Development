<?php

namespace App\Modules\Circulation\Services;

use App\Modules\Catalog\Models\Book;
use App\Modules\Membership\Models\Member;
use App\Modules\Circulation\Models\Borrowing;
use App\Modules\Circulation\Events\BookBorrowed;
use Illuminate\Support\Facades\DB;
use Exception;

class BorrowingService
{
    public function executeBorrowing(int $memberId, array $bookIds): Borrowing
    {
        return DB::transaction(function () use ($memberId, $bookIds) {
            $member = Member::findOrFail($memberId);

            if ($member->status !== 'active') {
                throw new Exception("Member tidak aktif.");
            }

            $borrowing = Borrowing::create([
                'borrow_code' => 'BRW-' . time() . '-' . rand(100, 999),
                'member_id' => $member->id,
                'borrowed_at' => now()->toDateString(),
                'due_at' => now()->addDays(7)->toDateString(),
                'status' => 'borrowed',
            ]);

            foreach ($bookIds as $bookId) {
                $book = Book::where('id', $bookId)->lockForUpdate()->firstOrFail();

                if ($book->stock < 1 || !$book->is_available) {
                    throw new Exception("Buku '{$book->title}' kehabisan stok.");
                }

                $book->decrement('stock', 1);

                $borrowing->details()->create([
                    'book_id' => $book->id,
                    'qty' => 1,
                ]);
            }

            event(new BookBorrowed($borrowing));

            return $borrowing;
        });
    }
}