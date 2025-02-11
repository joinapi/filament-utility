<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class TituloEleitorColumn extends TextColumn
{
    public static function make(string $name): static
    {
        return parent::make($name)
            ->label('TÍTUTO ELEITOR')
            ->formatStateUsing(fn (?string $state): ?string => 
                $state ? preg_replace("/(\d{4})(\d{4})(\d{4})/", "$1 $2 $3", $state) : null)
            ->alignCenter()
            ->copyable() 
            ->tooltip(fn (?string $state): ?string => $state ? 'Clique para copiar o título de eleitor' : null)
            ->sortable()
            ->searchable(); 
    }
}