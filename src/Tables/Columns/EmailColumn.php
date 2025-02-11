<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class EmailColumn extends TextColumn
{
    public static function make(string $name): static
    {
        return parent::make($name)
            ->label('EMAIL')
            ->alignCenter()
            ->tooltip(fn (?string $state): ?string => $state ? 'Clique para copiar o e-mail' : null)           
            ->copyable()
            ->sortable()
            ->searchable();
    }
}