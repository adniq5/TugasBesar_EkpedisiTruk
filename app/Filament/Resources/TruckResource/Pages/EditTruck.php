<?php

namespace App\Filament\Resources\TruckResource\Pages;

use App\Filament\Resources\TruckResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTruck extends EditRecord
{
    protected static string $resource = TruckResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(), // Aksi untuk menyimpan perubahan
            Actions\DeleteAction::make(), // Aksi untuk menghapus truck
        ];
    }
}


