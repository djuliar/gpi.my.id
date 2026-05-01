<?php

namespace App\Filament\Resources\LearningPlans;

use App\Filament\Resources\LearningPlans\Pages\CreateLearningPlan;
use App\Filament\Resources\LearningPlans\Pages\EditLearningPlan;
use App\Filament\Resources\LearningPlans\Pages\ListLearningPlans;
use App\Filament\Resources\LearningPlans\Schemas\LearningPlanForm;
use App\Filament\Resources\LearningPlans\Tables\LearningPlansTable;
use App\Models\LearningPlan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LearningPlanResource extends Resource
{
    protected static ?string $model = LearningPlan::class;

    protected static string|\UnitEnum|null $navigationGroup = '2. RPS, Rubrik, BKPM';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-table-cells';

    protected static ?string $recordTitleAttribute = 'RPS';

    protected static ?string $navigationLabel = 'RPS';

    protected static ?string $label = 'RPS';

    protected static ?string $pluralLabel = 'RPS';

    public static function form(Schema $schema): Schema
    {
        return LearningPlanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LearningPlansTable::configure($table);
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
            'index' => ListLearningPlans::route('/'),
            'create' => CreateLearningPlan::route('/create'),
            'edit' => EditLearningPlan::route('/{record}/edit'),
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
