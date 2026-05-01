<?php

namespace App\Filament\Resources\WorkBookEvents\Pages;

use App\Filament\Resources\WorkBookEvents\WorkBookEventResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateWorkBookEvent extends CreateRecord
{
    protected static string $resource = WorkBookEventResource::class;

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
