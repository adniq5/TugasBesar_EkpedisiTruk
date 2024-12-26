<?php

namespace App\Filament\Resources\ProgrammerResource\Pages;

use App\Filament\Resources\ProgrammerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgrammers extends ListRecords
{
    protected static string $resource = ProgrammerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(), // Aksi untuk membuat programmer baru
        ];
    }
}
