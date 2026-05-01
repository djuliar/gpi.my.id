<?php

namespace App\Filament\Resources\LearningPlans\Pages;

use App\Filament\Resources\LearningPlans\LearningPlanResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateLearningPlan extends CreateRecord
{
    protected static string $resource = LearningPlanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();

        return $data;
    }
}
