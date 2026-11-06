<?php

namespace App\Modules\Circulation\Listeners;

use App\Modules\Circulation\Events\BookBorrowed;
use Illuminate\Support\Facades\Log;

class LogBookBorrowed
{
    public function handle(BookBorrowed $event): void
    {
        Log::info("Domain Event: Buku dipinjam dengan Kode Trx {$event->borrowing->borrow_code} oleh Member ID {$event->borrowing->member_id}");
    }
}