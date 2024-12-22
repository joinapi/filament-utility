<?php

namespace Joinapi\FilamentUtility\Form;

use Filament\Tables\Columns\TextColumn;
use Joinapi\FilamentUtility\Enums\DateFormat;

class TextColumnTms extends TextColumn
{
    public static function make(string $name): static
    {
        $static = app(static::class, ['name' => $name]);
        $static->dateTime(DateFormat::DMY_SLASH->getLabel())
            ->label($name == 'created_at' ? 'CRIADO EM' : 'ALTERADO EM')
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true);

        return $static;
    }
}
