<?php

namespace App\Filament\Resources\StudyPrograms;

use App\Enums\Status;
use App\Filament\Resources\StudyPrograms\Pages\ManageStudyPrograms;
use App\Models\StudyProgram;
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
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudyProgramResource extends Resource
{
    protected static ?string $model = StudyProgram::class;

    protected static string|\UnitEnum|null $navigationGroup = '1. Master Data';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $recordTitleAttribute = 'Program Studi';

    protected static ?string $navigationLabel = 'Program Studi';

    protected static ?string $label = 'Program Studi';

    protected static ?string $pluralLabel = 'Program Studi';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('prodi')
                    ->label('Program Studi')
                    ->default(null)
                    ->required(),
                TextInput::make('alias')
                    ->default(null)
                    ->minLength(3)
                    ->maxLength(10)
                    ->required(),
                TextInput::make('coordinator')
                    ->label('Koordinator Program Studi')
                    ->default(null)
                    ->maxLength(50)
                    ->required(),
                TextInput::make('coordinator_nip')
                    ->label('Koordinator NIP')
                    ->default(null)
                    ->maxLength(25)
                    ->required(),
                Select::make('status')
                    ->options(Status::class)
                    ->hiddenOn('create')
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Program Studi')
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('prodi')
                    ->label('Program Studi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('alias')
                    ->width('10%')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('coordinator')
                    ->label('Koordinator Program Studi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('coordinator_nip')
                    ->label('Koordinator NIP')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->width('10%')
                    ->badge()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('active_status')
                    ->label('Status')
                    ->indicator('Active/Inactive')
                    ->form([
                        Select::make('status') // Or Checkbox::make(), Toggle::make()
                            ->options([
                                '1' => 'Active',
                                '0' => 'Inactive',
                            ])
                            ->default('Active') // Set default filter state
                            ->placeholder('Select Status')
                            ->native(false), // Use styled select
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if ($data['status'] === '1') {
                            return $query->where('status', 1);
                        } elseif ($data['status'] === '0') {
                            return $query->where('status', 0);
                        }
                        return $query; // Return original query if nothing selected
                    }),
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
                    BulkAction::make('markActive')
                        ->label('Set Active')
                        ->color('success')
                        ->icon('heroicon-o-check')
                        ->requiresConfirmation() // Prompts for confirmation
                        ->action(fn (Collection $records) => $records->each->update(['status' => '1']))
                        ->after(fn () => Notification::make()->title('Selected records are now active')->success()->send())
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('markInactive')
                        ->label('Set Inactive')
                        ->color('danger')
                        ->icon('heroicon-o-x-mark')
                        ->requiresConfirmation() // Prompts for confirmation
                        ->action(fn (Collection $records) => $records->each->update(['status' => '0']))
                        ->after(fn () => Notification::make()->title('Selected records are now inactive')->success()->send())
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageStudyPrograms::route('/'),
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
