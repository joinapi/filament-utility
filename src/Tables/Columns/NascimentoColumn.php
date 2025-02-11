<?php

namespace Joinapi\FilamentUtility\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class NascimentoColumn extends TextColumn
{
    public static function make(string $name): static
    {
        return parent::make($name)
            ->label('NASCIMENTO')
            ->formatStateUsing(fn (?string $state): ?string =>
                $state ? date('d/m/Y', strtotime($state)) : null)
            ->alignCenter()
            ->tooltip(fn (?string $state): ?string => $state ? 'Clique para copiar Nascimento' : null)
            ->copyable()
            ->sortable()
            ->searchable();
    }
}
