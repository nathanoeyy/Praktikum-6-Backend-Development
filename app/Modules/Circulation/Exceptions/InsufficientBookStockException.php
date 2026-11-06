<?php

namespace App\Modules\Circulation\Exceptions;

use Exception;

class InsufficientBookStockException extends Exception
{
    protected $message = "Stok buku tidak mencukupi untuk dipinjam.";
}