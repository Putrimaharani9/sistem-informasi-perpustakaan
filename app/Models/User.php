<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    // Define unfillable columsn
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get member visit
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, 'member_id', 'id');
    }

    /**
     * Has visit attribute
     */
    public function getHasVisitedAttribute(): bool
    {
        $count = DB::select("SELECT COUNT(*) as total_rows FROM visits WHERE member_id = ? AND DATE(created_at) = CURDATE()", [$this->id]);

        return $count[0]->total_rows > 0;
    }

    /**
     * Get book active loans by current member
     */
    public function getActiveLoansAttribute()
    {
        return Loan::where('member_id', $this->id)->where('is_returned', false)->get();
    }

    /**
     * Define relationship for device id
     */
    public function deviceIds(): HasMany
    {
        return $this->hasMany(UserDeviceId::class, 'user_id', 'id');
    }
}
