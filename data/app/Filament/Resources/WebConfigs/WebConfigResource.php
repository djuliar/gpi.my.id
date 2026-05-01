<?php

namespace App\Filament\Resources\WebConfigs;

use App\Filament\Resources\WebConfigs\Pages\ManageWebConfigs;
use App\Models\WebConfig;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Schemas\Components\Grid;

class WebConfigResource extends Resource
{
    protected static ?string $model = WebConfig::class;

    protected static string|\UnitEnum|null $navigationGroup = '3. Pengaturan';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $recordTitleAttribute = 'Pengaturan Web';

    protected static ?string $navigationLabel = 'Pengaturan Web';

    protected static ?string $label = 'Pengaturan Web';

    protected static ?string $pluralLabel = 'Pengaturan Web';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('ministry')
                            ->label('Kementerian')
                            ->default(null),
                        TextInput::make('institution')
                            ->label('Lembaga')
                            ->default(null),
                    ]),
                Grid::make(3)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('department')
                            ->label('Jurusan')
                            ->default(null),
                        TextInput::make('department_leader')
                            ->label('Ketua Jurusan')
                            ->default(null),
                        TextInput::make('department_leader_nip')
                            ->label('NIP Ketua Jurusan')
                            ->default(null),
                    ]),
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('storage_path')
                            ->columnSpan(1)
                            ->default(null),
                        TextInput::make('absolute_path')
                            ->columnSpan(1)
                            ->default(null),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Pengaturan Web')
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),
                TextColumn::make('department')
                    ->label('Jurusan')
                    ->searchable(),
                TextColumn::make('department_leader')
                    ->label('Ketua Jurusan')
                    ->searchable(),
                TextColumn::make('department_leader_nip')
                    ->label('NIP Ketua Jurusan')
                    ->searchable(),
                TextColumn::make('institution')
                    ->label('Lembaga')
                    ->searchable(),
                TextColumn::make('ministry')
                    ->label('Kementerian')
                    ->searchable(),
                TextColumn::make('storage_path')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('absolute_path')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => ManageWebConfigs::route('/'),
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
