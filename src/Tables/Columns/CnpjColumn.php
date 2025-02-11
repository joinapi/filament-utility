<?php

namespace Joinapi\FilamentUtility\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class CnpjColumn extends TextColumn
{
    public static function make(string $name): static
    {
        return parent::make($name)
            ->label('CNPJ')
            ->alignCenter()
            ->formatStateUsing(fn (?string $state): ?string =>
                $state ? preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "$1.$2.$3/$4-$5", $state) : null)
            ->copyable()
            ->tooltip(fn (?string $state): ?string => $state ? 'Clique para copiar o CNPJ' : null)
            ->sortable()
            ->searchable();
    }
}
