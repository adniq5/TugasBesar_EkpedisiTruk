<?php

namespace App\Filament\Resources\ProgrammerResource\Pages;

use App\Filament\Resources\ProgrammerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgrammer extends EditRecord
{
    protected static string $resource = ProgrammerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(), // Aksi untuk menyimpan perubahan
            Actions\DeleteAction::make(), // Aksi untuk menghapus programmer
        ];
    }
}
