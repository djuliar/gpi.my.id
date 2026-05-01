<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->columns(1),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required()
                            ->columns(1),
                    ]),
                Grid::make(3)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('password')
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->password()
                            ->revealable()
                            ->maxLength(255)
                            ->columns(1),
                        TextInput::make('password_confirmation')
                            ->required(fn (string $context): bool => $context === 'create')
                            ->password()
                            ->revealable()
                            ->maxLength(255)
                            ->same('password')
                            ->label('Confirm Password')
                            ->columns(1),
                        Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->required()
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
