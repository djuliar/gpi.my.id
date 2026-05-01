<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Selamat Datang';

    protected static ?string $navigationLabel = 'Beranda';

    protected static ?int $navigationSort = -1;
}