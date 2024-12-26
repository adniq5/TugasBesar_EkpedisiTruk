<?php

   // App\Models\Order.php
   namespace App\Models;

   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Database\Eloquent\Relations\BelongsTo;
   use Illuminate\Database\Eloquent\SoftDeletes;
   use Illuminate\Database\Eloquent\Relations\HasMany;

   class Order extends Model
   {
       use HasFactory, SoftDeletes;

       protected $fillable = [
           'customer_id',
           'truck_id',
           'order_date',
           'notes',
           'price',
       ];

       // Menambahkan kolom order_date ke dalam array dates
       protected $dates = ['order_date']; // Pastikan ini ada

       // Relasi dengan Customer
       public function customer(): BelongsTo
       {
           return $this->belongsTo(Customer::class);
       }

       // Relasi dengan Truck
       public function truck(): BelongsTo
       {
           return $this->belongsTo(Truck::class);
       }

       // Relasi dengan BookingTransaction
       public function bookingTransactions(): HasMany
       {
           return $this->hasMany(BookingTransaction::class);
       }

       // Helper untuk mendapatkan harga yang lebih mudah
       public function getFormattedPriceAttribute()
       {
           return 'IDR ' . number_format($this->price, 0, ',', '.');
       }
   }

