<?php

namespace App\Filament\Resources\WorkBooks;

use App\Filament\Resources\WorkBooks\Pages\CreateWorkBook;
use App\Filament\Resources\WorkBooks\Pages\EditWorkBook;
use App\Filament\Resources\WorkBooks\Pages\ListWorkBooks;
use App\Filament\Resources\WorkBooks\Schemas\WorkBookForm;
use App\Filament\Resources\WorkBooks\Tables\WorkBooksTable;
use App\Models\WorkBook;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkBookResource extends Resource
{
    protected static ?string $model = WorkBook::class;

    protected static string|\UnitEnum|null $navigationGroup = '2. RPS, Rubrik, BKPM';

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $recordTitleAttribute = 'BKPM';

    protected static ?string $navigationLabel = 'BKPM';

    protected static ?string $label = 'BKPM';

    protected static ?string $pluralLabel = 'BKPM';

    public static function form(Schema $schema): Schema
    {
        return WorkBookForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorkBooksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWorkBooks::route('/'),
            'create' => CreateWorkBook::route('/create'),
            'edit' => EditWorkBook::route('/{record}/edit'),
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
