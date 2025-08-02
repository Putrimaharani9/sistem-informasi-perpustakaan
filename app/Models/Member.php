<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Member extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_anggota';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_anggota',
        'nama',
        'nik',
        'email',
        'alamat',
        'nomor_telepon',
        'status_anggota',
    ];

    // ========================
    // Encrypt saat menyimpan
    // ========================
    public function setNikAttribute($value)
    {
        $this->attributes['nik'] = Crypt::encryptString($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Crypt::encryptString($value);
    }

    public function setAlamatAttribute($value)
    {
        $this->attributes['alamat'] = Crypt::encryptString($value);
    }

    public function setNomorTeleponAttribute($value)
    {
        $this->attributes['nomor_telepon'] = Crypt::encryptString($value);
    }

    // ========================
    // Decrypt saat mengakses
    // ========================
    public function getNikAttribute($value)
    {
        return $this->safeDecrypt($value);
    }

    public function getEmailAttribute($value)
    {
        return $this->safeDecrypt($value);
    }

    public function getAlamatAttribute($value)
    {
        return $this->safeDecrypt($value);
    }

    public function getNomorTeleponAttribute($value)
    {
        return $this->safeDecrypt($value);
    }

    protected function safeDecrypt($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return $value;
        }
    }
}
