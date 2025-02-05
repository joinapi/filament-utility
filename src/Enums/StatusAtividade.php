<?php

namespace Joinapi\FilamentUtility\Enums;

use Joinapi\FilamentUtility\Enums\Concerns\Utilities;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusAtividade: string implements HasLabel , HasIcon, HasColor
{
    use Utilities;
    case ATIVO = 'ATIVO';
    case INATIVO = 'INATIVO';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ATIVO => 'Ativo',
            self::INATIVO => 'Inativo',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::ATIVO => 'success',
            self::INATIVO => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::ATIVO, self::INATIVO => 'heroicon-o-check-circle',
        };
    }
}
