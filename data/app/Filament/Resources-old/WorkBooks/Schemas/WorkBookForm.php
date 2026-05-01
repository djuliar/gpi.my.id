<?php

namespace App\Filament\Resources\WorkBooks\Schemas;

use App\Enums\Status;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class WorkBookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        Select::make('course_id')
                            ->relationship('course', 'course_name')
                            ->label('Mata Kuliah')
                            ->preload()
                            ->searchable()
                            ->required()
                            ->columnSpanFull()
                            ->default(null),
                        TextInput::make('launch_city')
                            ->label('Kota Launching')
                            ->columnSpan(1)
                            ->required()
                            ->default('Jember'),
                        DatePicker::make('launch_date')
                            ->label('Tanggal Launching')
                            ->columnSpan(1)
                            ->required()
                            ->default(now()),
                        TextInput::make('course_coordinator')
                            ->label('Koordinator Mata Kuliah')
                            ->columnSpan(1)
                            ->required()
                            ->default(null),
                        TextInput::make('course_coordinator_nip')
                            ->label('NIP Koordinator')
                            ->columnSpan(1)
                            ->required()
                            ->default(null),
                        TextInput::make('author')
                            ->label('Penulis')
                            ->columnSpan(1)
                            ->required()
                            ->default(null),
                        TextInput::make('author_nip')
                            ->label('NIP Penulis')
                            ->columnSpan(1)
                            ->required()
                            ->default(null),
                        RichEditor::make('introduction')
                            ->label('Kata Pengantar')
                            ->required()
                            ->columnSpanFull(),
                    ]),
                Grid::make(2)
                    ->schema([
                        Repeater::make('lecturer')
                            ->label('Tim Teaching')
                            ->defaultItems(1)
                            ->minItems(1)
                            ->maxItems(7)
                            ->required()
                            ->columnSpanFull()
                            ->addActionLabel('Add Dosen')
                            ->schema([
                                TextInput::make('name')->label('Nama Dosen')->required(),
                            ]),
                        Select::make('status')
                            ->options(Status::class)
                            ->hiddenOn('create')
                            ->columnSpanFull()
                            ->default(1),
                        Hidden::make('user_id')
                            ->default(auth()->id()),
                    ]),
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        Repeater::make('additional_page')
                            ->label('Halaman Tambahan')
                            ->defaultItems(0)
                            ->maxItems(3)
                            ->columnSpan(1)
                            ->addActionLabel('Add Halaman Tambahan')
                            ->schema([
                                TextInput::make('title')->label('Judul')->required(),
                                RichEditor::make('content')->label('Kontent')->required(),
                            ]),
                        Repeater::make('table_of_content')
                            ->label('Daftar Isi')
                            ->defaultItems(0)
                            ->columnSpan(1)
                            ->addActionLabel('Add Daftar Isi')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('heading')->label('Heading')->columnSpan(1)->required(),
                                    TextInput::make('number')->label('Nomor')->columnSpan(1)->required(),
                                ]),
                            ]),
                ]),
            ]);
    }
}
