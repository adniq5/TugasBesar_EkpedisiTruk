<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Truck extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'license_plate',
        'capacity',
        'status',
        'driver_name',
        'image',
    ];

    // Relasi dengan Order
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // Accessor untuk mendapatkan URL gambar
    public function getImageUrlAttribute()
    {
        return Storage::url($this->image);
    }
}
