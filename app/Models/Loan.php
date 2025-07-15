<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Loan extends Model
{
    use HasFactory;

    // Define unfillable columns
    protected $guarded = ['id'];

    /**
     * Define hasOne relationship for book copy
     */
    public function copy(): HasOne
    {
        return $this->hasOne(BookCopy::class, 'id', 'copy_id');
    }

    /**
     * Define hasOneTrough relationship for book
     */
    public function book(): HasOneThrough
    {
        return $this->hasOneThrough(Book::class, BookCopy::class, 'id', 'id', 'copy_id', 'book_id');
    }

    /**
     * Define relationshio for member
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    /**
     * Determine if loan is need to return
     */
    public function getIsNeedReturnAttribute()
    {
        if ($this->is_returned) {
            return false;
        }

        return $this->return_date <= now();
    }

    /**
     * Scope for need to return loan
     */
    public function scopeNeedReturn(Builder $query)
    {
        $query->where('return_date', '<=', now())->where('is_returned', 0);
    }

    protected $appends = ['is_need_return'];
}
