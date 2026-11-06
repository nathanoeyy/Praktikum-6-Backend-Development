<?php

namespace App\Modules\Circulation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Modules\Membership\Models\Member;
use App\Modules\Circulation\Models\BorrowingDetail;

class Borrowing extends Model
{
    use SoftDeletes;

    protected $fillable = ['borrow_code', 'member_id', 'borrowed_at', 'due_at', 'returned_at', 'status'];

    public function details(): HasMany
    {
        return $this->hasMany(BorrowingDetail::class, 'borrowing_id');
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

}