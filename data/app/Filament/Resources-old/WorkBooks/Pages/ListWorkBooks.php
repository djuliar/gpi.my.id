<?php

namespace App\Filament\Resources\WorkBooks\Pages;

use App\Filament\Resources\WorkBooks\WorkBookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorkBooks extends ListRecords
{
    protected static string $resource = WorkBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
