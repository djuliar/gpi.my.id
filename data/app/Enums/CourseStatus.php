<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CourseStatus: int implements HasLabel, HasIcon, HasColor
{
    case Teori = 1;
    case Praktik = 2;
    case TeoriPraktik = 3;

    public const DEFAULT = self::Teori->value;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Teori => 'Teori',
            self::Praktik => 'Praktik',
            self::TeoriPraktik => 'Teori & Praktik',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Teori => 'heroicon-o-check',
            self::Praktik => 'heroicon-o-check',
            self::TeoriPraktik => 'heroicon-o-check',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Teori => 'success',
            self::Praktik => 'danger',
            self::TeoriPraktik => 'danger',
        };
    }
}
