<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Crypt;


class Book extends Model
{
    use HasFactory;

    // Define guarded columns
    protected $guarded = ['id'];

    // Enkripsi title
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Crypt::encryptString($value);
    }

    public function getTitleAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    // Enkripsi author
    public function setAuthorAttribute($value)
    {
        $this->attributes['author'] = Crypt::encryptString($value);
    }

    public function getAuthorAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    // Enkripsi publisher
    public function setPublisherAttribute($value)
    {
        $this->attributes['publisher'] = Crypt::encryptString($value);
    }

    public function getPublisherAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    /**
     * Define one to many relationship for copies
     */
    public function copies(): HasMany
    {
        return $this->hasMany(BookCopy::class, 'book_id', 'id');
    }


    /**
     * Define belongs to relationship for category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BookCategory::class, 'category_id');
    }

    /**
     * Define one to many relationship for data creator
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->locale('id')
            ->translatedFormat('l, j F Y');
    }
}
