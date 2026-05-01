<?php

namespace App\Filament\Resources\WebConfigs\Pages;

use App\Filament\Resources\WebConfigs\WebConfigResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageWebConfigs extends ManageRecords
{
    protected static string $resource = WebConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
