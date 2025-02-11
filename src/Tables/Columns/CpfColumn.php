<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class CpfColumn extends TextColumn
{
    public static function make(string $name): static
    {
        return parent::make($name)
            ->label('CPF')
            ->alignCenter()
            ->formatStateUsing(fn (?string $state): ?string => 
                $state ? preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $state) : null)
            ->copyable()
            ->tooltip(fn (?string $state): ?string => $state ? 'Clique para copiar o CPF' : null)            
            ->sortable()
            ->searchable();
    }
}