<?php

namespace App\Filament\Resources\TruckResource\Pages;

use App\Filament\Resources\TruckResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTruck extends CreateRecord
{
    protected static string $resource = TruckResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(), // Aksi untuk menyimpan truck baru
        ];
    }
}
