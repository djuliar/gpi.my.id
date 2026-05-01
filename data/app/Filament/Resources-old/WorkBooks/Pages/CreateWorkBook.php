<?php

namespace App\Filament\Resources\WorkBooks\Pages;

use App\Filament\Resources\WorkBooks\WorkBookResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateWorkBook extends CreateRecord
{
    protected static string $resource = WorkBookResource::class;

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
