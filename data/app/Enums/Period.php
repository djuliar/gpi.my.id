<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum Period: int implements HasLabel, HasIcon, HasColor
{
    case Ganjil = 1;
    case Genap = 2;

    public const DEFAULT = self::Ganjil->value;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Ganjil => 'Ganjil',
            self::Genap => 'Genap',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Ganjil => 'heroicon-o-hashtag',
            self::Genap => 'heroicon-o-hashtag',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Ganjil => 'secondary',
            self::Genap => 'secondary',
        };
    }
}
