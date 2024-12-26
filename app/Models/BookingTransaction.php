<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BookingTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'order_id',
        'quantity',
        'total_amount',
        'is_paid',
        'proof',
        'booking_trx_id',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        // Set nilai default untuk booking_trx_id jika tidak ada
        static::creating(function ($model) {
            if (empty($model->booking_trx_id)) {
                $model->booking_trx_id = Str::uuid()->toString(); // Menggunakan UUID
            }
        });
    }

    /**
     * Relasi dengan Customer
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relasi dengan Order
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * URL untuk Bukti Pembayaran
     */
    public function getProofUrlAttribute(): ?string
    {
        return $this->proof ? asset('storage/' . $this->proof) : null;
    }

    /**
     * Total Biaya setelah Pajak
     */
    public function getTotalAmountWithTaxAttribute(): float
    {
        return $this->total_amount * 1.11; // Total + Pajak 11%
    }

    /**
     * Hitung Biaya dengan Pajak secara Manual
     */
    public function calculateTotalAmount(int $quantity, float $price): float
    {
        $total = $quantity * $price;
        return $total * 1.11; // Total + Pajak 11%
    }
}
