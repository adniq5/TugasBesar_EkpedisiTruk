<?php

namespace App\Filament\Resources\BookingTransactionResource\Pages;

use App\Filament\Resources\BookingTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookingTransaction extends EditRecord
{
    protected static string $resource = BookingTransactionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(), // Untuk menyimpan perubahan
            Actions\DeleteAction::make(), // Aksi untuk menghapus transaksi
        ];
    }
}
