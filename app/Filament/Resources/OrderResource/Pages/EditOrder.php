<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(), // Aksi untuk menyimpan perubahan
            Actions\DeleteAction::make(), // Aksi untuk menghapus order
        ];
    }
}

