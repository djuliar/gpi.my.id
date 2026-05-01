<?php

namespace App\Filament\Resources\WorkBookEvents\Pages;

use App\Filament\Resources\WorkBookEvents\WorkBookEventResource;
use App\Models\WorkBookEvent;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditWorkBookEvent extends EditRecord
{
    protected static string $resource = WorkBookEventResource::class;

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
                ->label('Cetak Acara')
                ->url(fn (WorkBookEvent $record): string => route('bkpm.event.print', [$record->bkpm->course->course_code, $record->id]))
                ->openUrlInNewTab()
                ->icon('heroicon-o-printer')
                ->color('info'),
        ];
    }
}
