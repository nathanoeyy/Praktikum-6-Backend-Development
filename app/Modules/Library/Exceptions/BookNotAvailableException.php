<?php

namespace App\Modules\Library\Exceptions;

use Exception;

class BookNotAvailableException extends Exception
{
    public function __construt($message = "Buku tidak tersedia karena stok habis.")
    {
        parent::__construct($message);
    }
}