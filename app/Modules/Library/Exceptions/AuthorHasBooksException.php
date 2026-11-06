<?php

namespace App\Modules\Library\Exceptions;

use Exception;

class AuthorHasBooksException extends Exception
{
    public function __construct($message = "Penulis tidak dapat dihapus karena masih memiliki buku terdaftar.")
    {
        parent::__construct($message);
    }
}