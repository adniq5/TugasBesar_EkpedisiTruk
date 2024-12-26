<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(), // Aksi untuk menyimpan perubahan
            Actions\DeleteAction::make(), // Aksi untuk menghapus customer
        ];
    }
}

