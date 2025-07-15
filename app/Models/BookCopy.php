<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BookCopy extends Model
{
    use HasFactory;

    const AVAILABLE = 1;
    const UNAVAILABLE = 0;

    // Define guarded columns
    protected $guarded = ['id'];

    /**
     * Define relationship for original book
     */
    public function book(): HasOne
    {
        return $this->hasOne(Book::class, 'id', 'book_id');
    }
}
