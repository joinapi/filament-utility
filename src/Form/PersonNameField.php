<?php

namespace Joinapi\FilamentUtility\Form;

use Filament\Forms\Components\TextInput;

class PersonNameField extends TextInput
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function applyRule( string $rule = '/[a-z\040\.\-]+$/i'): static
    {
        $this->rule( 'regex:'.$rule );
        return $this;

    }




}
