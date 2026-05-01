<?php

namespace App\Filament\Resources\WorkBookEvents\Pages;

use App\Filament\Resources\WorkBookEvents\WorkBookEventResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorkBookEvents extends ListRecords
{
    protected static string $resource = WorkBookEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
