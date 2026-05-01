<?php

namespace App\Filament\Resources\WorkBookEvents\Tables;

use App\Enums\Status;
use App\Models\WorkBookEvent;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class WorkBookEventsTable
{
    public static function configure(Table $table): Table
    {
        $userId = Auth::id();

        return $table
            // ->defaultSort('created_at', 'desc')
            ->defaultSort(function (Builder $query): Builder {
                return $query
                    ->orderBy('bkpm_id', 'asc')
                    ->orderBy('event_to', 'desc')
                    ->orderBy('created_at', 'desc');
            })
            ->modifyQueryUsing(function (Builder $query) use ($userId) {
                // if (!auth()->user()->hasRole('super_admin')) {
                    $query->where('user_id', $userId);
                // }
            })
            ->columns([
                TextColumn::make('event_to')
                    ->label('Acara Ke')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Judul Acara')
                    ->searchable(),
                TextColumn::make('main_topic')
                    ->label('Pokok Bahasan')
                    ->searchable(),
                TextColumn::make('weeks')
                    ->label('Acara Praktikum')
                    ->searchable(),
                TextColumn::make('class_name')
                    ->label('Tempat')
                    ->searchable(),
                TextColumn::make('time_allocation')
                    ->label('Alokasi Waktu')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.name')
                    ->label('Creator')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('bkpm.course.course_name')
                    ->label('Mata Kuliah')
                    ->sortable(),
                TextColumn::make('page_number')
                    ->label('No. Halaman')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
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
                SelectFilter::make('course')
                    ->label('Mata Kuliah')
                    ->relationship('bkpm.course', 'course_name'),
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
                    ReplicateAction::make(),
                    Action::make('Print')
                        ->label('Cetak Acara')
                        ->url(fn (WorkBookEvent $record): string => route('bkpm.event.print', [$record->bkpm->course->course_code, $record->id]))
                        ->openUrlInNewTab()
                        ->icon('heroicon-o-printer'),
                ]),
            ], position: RecordActionsPosition::BeforeColumns)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
