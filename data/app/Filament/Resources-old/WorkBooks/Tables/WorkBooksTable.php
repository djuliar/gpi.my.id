<?php

namespace App\Filament\Resources\WorkBooks\Tables;

use App\Enums\Status;
use App\Models\WorkBook;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class WorkBooksTable
{
    public static function configure(Table $table): Table
    {
        $userId = Auth::id();

        return $table
            ->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(function (Builder $query) use ($userId) {
                if (!auth()->user()->hasRole('super_admin')) {
                    $query->where('user_id', $userId);
                }
            })
            ->columns([
                TextColumn::make('course.course_name')
                    ->label('Mata Kuliah')
                    ->url(fn ($record): string => "work-book-events?filters[course][value]={$record->id}")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('launch_city')
                    ->label('Kota')
                    ->searchable(),
                TextColumn::make('launch_date')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('course_coordinator')
                    ->label('Koordinator')
                    ->searchable(),
                TextColumn::make('course_coordinator_nip')
                    ->label('NIP Koordinator')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable(),
                TextColumn::make('author_nip')
                    ->label('NIP Penulis')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->width('10%')
                    ->badge()
                    ->sortable(),
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
                ActionGroup::make([
                    EditAction::make(),
                    Action::make('Print')
                        ->label('Cetak Cover')
                        ->url(fn (WorkBook $record): string => route('bkpm.cover.print', $record->course->course_code))
                        ->openUrlInNewTab()
                        ->icon('heroicon-o-printer'),
                ]),
            ], position: RecordActionsPosition::BeforeColumns)
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
}
