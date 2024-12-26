<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TruckResource\Pages;
use App\Models\Truck;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TruckResource extends Resource
{
    protected static ?string $model = Truck::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Truck List';

    // Menentukan urutan kategori navigasi
    protected static ?int $navigationSort = 50; // Nilai lebih rendah untuk menempatkan di atas

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('license_plate')
                    ->required()
                    ->unique(Truck::class, 'license_plate', ignoreRecord: true)
                    ->label('License Plate')
                    ->maxLength(10),
                Forms\Components\TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->label('Capacity (kg)')
                    ->helperText('Masukkan kapasitas dalam kilogram.'),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'available' => 'Available',
                        'in_use' => 'In Use',
                        'maintenance' => 'Maintenance',
                    ])
                    ->label('Truck Status'),
                Forms\Components\TextInput::make('driver_name')
                    ->required()
                    ->label('Driver Name')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->label('Truck Image')
                    ->image()
                    ->directory('trucks/images')
                    ->maxSize(2048)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('license_plate')
                    ->label('License Plate')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Capacity (kg)')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('driver_name')
                    ->label('Driver Name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Truck Image'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrucks::route('/'),
            'create' => Pages\CreateTruck::route('/create'),
            'edit' => Pages\EditTruck::route('/{record}/edit'),
        ];
    }
}
