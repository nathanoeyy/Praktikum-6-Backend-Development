<?php

namespace App\Modules\Library\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = [
        'judul',
        'isbn',
        'tahun_terbit',
        'harga',
        'stok',
        'author_id',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo('App\\Modules\\Library\\Models\\Author', 'author_id');
    }
}