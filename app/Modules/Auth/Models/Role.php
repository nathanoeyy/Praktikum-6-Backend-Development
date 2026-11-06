<?php

namespace App\Modules\Auth\Models; // Tambahkan App\ di awal

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Sesuaikan lokasi model User Anda (App\Models\User atau App\Modules\Auth\Models\User)
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}