<?php

namespace App\Modules\Catalog\ValueObjects;

use InvalidArgumentException;

class ISBN 
{
    private string $value;

    public function __construct(string $value)
    {
        $cleanIsbn = preg_replace('/[^0-9X]/i', '', $value);
        if (strlen($cleanIsbn) !== 10 && strlen($cleanIsbn) !== 13) {
            throw new InvalidArgumentException("Format ISBN tidak valid: {$value}");
        }
        $this->value = $cleanIsbn;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}