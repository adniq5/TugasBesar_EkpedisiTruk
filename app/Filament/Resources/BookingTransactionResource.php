<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingTransactionResource\Pages;
use App\Models\BookingTransaction;
use App\Models\Order;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingTransactionResource extends Resource
{
    protected static ?string $model = BookingTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Truck and Price')
                        ->schema([
                            Forms\Components\Select::make('order_id')
                                ->relationship('order', 'id')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $order = Order::find($state);
                                    $set('price', $order ? $order->price : 0);
                                })
                                ->label('Truck Order ID'),

                            Forms\Components\TextInput::make('price')
                                ->required()
                                ->numeric()
                                ->prefix('IDR')
                                ->readOnly()
                                ->label('Truck Price'),

                            Forms\Components\TextInput::make('quantity')
                                ->required()
                                ->numeric()
                                ->prefix('Units')
                                ->label('Truck Quantity')
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $price = $get('price');
                                    if ($price) {
                                        $total = $price * $state;
                                        $set('total_amount', $total + ($total * 0.11));
                                    }
                                }),

                            Forms\Components\TextInput::make('total_amount')
                                ->required()
                                ->numeric()
                                ->prefix('IDR')
                                ->readOnly()
                                ->label('Total Price (with Tax)'),
                        ]),

                    Forms\Components\Wizard\Step::make('Customer Information')
                        ->schema([
                            Forms\Components\Select::make('customer_id')
                                ->relationship('customer', 'name')
                                ->required()
                                ->searchable()
                                ->label('Customer'),
                        ]),

                    Forms\Components\Wizard\Step::make('Payment Information')
                        ->schema([
                            Forms\Components\Toggle::make('is_paid')
                                ->label('Payment Status'),
                            Forms\Components\FileUpload::make('proof')
                                ->label('Proof of Payment')
                                ->required(),
                        ]),
                ])
                ->columnSpan('full')
                ->skippable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_trx_id')->searchable()->label('Transaction ID'),
                Tables\Columns\TextColumn::make('customer.name')->searchable()->label('Customer Name'),
                Tables\Columns\TextColumn::make('order_id')->label('Order ID'),
                Tables\Columns\IconColumn::make('is_paid')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Payment Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransaction::route('/create'),
            'edit' => Pages\EditBookingTransaction::route('/{record}/edit'),
        ];
    }
}
