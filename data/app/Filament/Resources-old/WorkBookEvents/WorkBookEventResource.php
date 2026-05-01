<?php

namespace App\Filament\Resources\WorkBookEvents;

use App\Filament\Resources\WorkBookEvents\Pages\CreateWorkBookEvent;
use App\Filament\Resources\WorkBookEvents\Pages\EditWorkBookEvent;
use App\Filament\Resources\WorkBookEvents\Pages\ListWorkBookEvents;
use App\Filament\Resources\WorkBookEvents\Schemas\WorkBookEventForm;
use App\Filament\Resources\WorkBookEvents\Tables\WorkBookEventsTable;
use App\Models\WorkBookEvent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkBookEventResource extends Resource
{
    protected static ?string $model = WorkBookEvent::class;

    protected static string|\UnitEnum|null $navigationGroup = '2. RPS, Rubrik, BKPM';
    
    protected static ?int $navigationSort = 5;
    
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-bookmark-square';
    
    protected static ?string $navigationParentItem = 'BKPM';

    protected static ?string $recordTitleAttribute = 'Acara BKPM';

    protected static ?string $navigationLabel = 'Acara BKPM';

    protected static ?string $label = 'Acara BKPM';

    protected static ?string $pluralLabel = 'Acara BKPM';

    public static function form(Schema $schema): Schema
    {
        return WorkBookEventForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorkBookEventsTable::configure($table);
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
            'index' => ListWorkBookEvents::route('/'),
            'create' => CreateWorkBookEvent::route('/create'),
            'edit' => EditWorkBookEvent::route('/{record}/edit'),
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
