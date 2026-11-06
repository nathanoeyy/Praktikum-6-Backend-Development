<?php

namespace App\Modules\Orders\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'order_number', 'total_amount',
        'status', 'shipping_address', 'ordered_at'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'ordered_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany('Modules\\Orders\\Models\\OrderItem');
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany('Modules\\Orders\\Models\\OrderStatusHistory');
    }

    public function scopeByStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeRecent(Builder $query, int $days = 30)
    {
        return $query->where('ordered_at', '>=', now()->subDays($days));
    }

    public function calculateTotal(): float
    {
        return $this->items->sum(fn($item) => $item->price_at_purchase * $item->quantity);
    }
}