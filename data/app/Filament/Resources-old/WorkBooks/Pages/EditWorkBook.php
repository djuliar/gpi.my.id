<?php

namespace App\Filament\Resources\WorkBooks\Pages;

use App\Filament\Resources\WorkBooks\WorkBookResource;
use App\Models\WorkBook;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditWorkBook extends EditRecord
{
    protected static string $resource = WorkBookResource::class;

    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['user_id'] = Auth::id();

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
            Action::make('Print')
                ->label('Cetak Cover')
                ->url(fn (WorkBook $record): string => route('bkpm.cover.print', $record->course->course_code))
                ->openUrlInNewTab()
                ->icon('heroicon-o-printer'),
        ];
    }
}
