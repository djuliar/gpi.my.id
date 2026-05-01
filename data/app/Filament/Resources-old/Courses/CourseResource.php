<?php

namespace App\Filament\Resources\Courses;

use App\Enums\CourseStatus;
use App\Filament\Resources\Courses\Pages\ManageCourses;
use App\Models\Course;
use BackedEnum;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static string|\UnitEnum|null $navigationGroup = '1. Master Data';

    protected static ?int $navigationSort = 5;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $recordTitleAttribute = 'Mata Kuliah';

    protected static ?string $navigationLabel = 'Mata Kuliah';

    protected static ?string $label = 'Mata Kuliah';

    protected static ?string $pluralLabel = 'Mata Kuliah';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpan(9)
                    ->columns(12)
                    ->schema([
                        TextInput::make('course_code')
                            ->label('Kode Mata Kuliah')
                            ->columnSpan(4)
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->default(null),
                        TextInput::make('course_name')
                            ->label('Nama Mata Kuliah')
                            ->columnSpan(8)
                            ->required()
                            ->default(null),
                        Select::make('prodi_id')
                            ->relationship('prodi', 'prodi')
                            ->label('Program Studi')
                            ->preload()
                            ->searchable()
                            ->required()
                            ->columnSpan(6)
                            ->default(1),
                        Select::make('semester')
                            ->label('Semester')
                            ->options([
                                1 => 'Semester 1',
                                2 => 'Semester 2',
                                3 => 'Semester 3',
                                4 => 'Semester 4',
                                5 => 'Semester 5',
                                6 => 'Semester 6',
                                7 => 'Semester 7',
                                8 => 'Semester 8',
                            ])
                            ->columnSpan(6)
                            ->default(1)
                            ->native(false),
                        Select::make('status')
                            ->options(CourseStatus::class)
                            ->default(1)
                            ->columnSpan(4)
                            ->native(false),
                        TextInput::make('sks_teori')
                            ->label('SKS Teori')
                            ->numeric()
                            ->columnSpan(4)
                            ->default(0),
                        TextInput::make('sks_praktik')
                            ->label('SKS Praktik')
                            ->numeric()
                            ->columnSpan(4)
                            ->default(0),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Mata Kuliah')
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('course_code')
                    ->label('Kode Mata Kuliah')
                    ->badge()
                    ->searchable(),
                TextColumn::make('course_name')
                    ->label('Nama Mata Kuliah')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('prodi.prodi')
                    ->label('Program Studi')
                    ->wrap()
                    ->sortable(),
                TextColumn::make('semester')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sks_teori')
                    ->label('SKS Teori')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sks_praktik')
                    ->label('SKS Praktik')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                // TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('deleted_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageCourses::route('/'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
