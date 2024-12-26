<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgrammerResource\Pages;
use App\Models\Programmer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgrammerResource extends Resource
{
    protected static ?string $model = Programmer::class;

    protected static ?string $navigationIcon = 'heroicon-o-command-line';

    // Menambahkan kategori atau grup navigasi
    protected static ?string $navigationGroup = 'Data Management'; // Ganti dengan nama kategori yang diinginkan

    // Menentukan urutan kategori navigasi
    protected static ?int $navigationSort = 100; // Nilai lebih tinggi untuk menempatkan di bawah

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->label('Nama')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nim')
                    ->required()
                    ->label('NIM')
                    ->unique(Programmer::class, 'nim', ignoreRecord: true)
                    ->maxLength(20),
                Forms\Components\TextInput::make('kelas')
                    ->required()
                    ->label('Kelas')
                    ->maxLength(50),
                Forms\Components\TextInput::make('jurusan')
                    ->required()
                    ->label('Jurusan')
                    ->maxLength(100),
                Forms\Components\TextInput::make('instansi')
                    ->required()
                    ->label('Instansi')
                    ->maxLength(100),
                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->directory('programmers/images') // Menyimpan gambar di direktori ini
                    ->maxSize(2048) // Maksimal ukuran file 2MB
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nim')
                    ->label('NIM')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kelas')
                    ->label('Kelas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jurusan')
                    ->label('Jurusan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('instansi')
                    ->label('Instansi')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image') // Menampilkan gambar programmer
                    ->label('Image')
                    ->disk('public'), // Pastikan menggunakan disk yang benar
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProgrammers::route('/'),
            'create' => Pages\CreateProgrammer::route('/create'),
            'edit' => Pages\EditProgrammer::route('/{record}/edit'),
        ];
    }
}
