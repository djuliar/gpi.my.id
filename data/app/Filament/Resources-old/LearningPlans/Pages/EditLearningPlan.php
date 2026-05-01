<?php

namespace App\Filament\Resources\LearningPlans\Pages;

use App\Filament\Resources\LearningPlans\LearningPlanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditLearningPlan extends EditRecord
{
    protected static string $resource = LearningPlanResource::class;

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
        ];
    }
}
