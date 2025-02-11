<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class CelularColumn extends TextColumn
{
    public static function make(string $name): static
    {
        return parent::make($name)
            ->label('CELULAR')
            ->alignCenter()
            ->formatStateUsing(fn (?string $state): ?string => 
                $state ? preg_replace("/(\d{2})(\d{5})(\d{4})/", "($1) $2-$3", $state) : null)
            ->copyable() // Permite a cópia do número ao clicar
            ->tooltip(fn (?string $state): ?string => $state ? 'Clique para copiar o número' : null) 
            ->sortable()
            ->searchable();
    }
}
