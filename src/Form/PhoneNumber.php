<?php

namespace Joinapi\FilamentUtility\Form;

use Closure;
use Filament\Forms\Components\TextInput;
use Filament\Support\RawJs;

class PhoneNumber extends TextInput
{
    protected function setUp(): void
    {
        $this->dynamic();
    }

    public function dynamic(bool $condition = true): static
    {
        if ($condition) {
            $this->mask(RawJs::make(<<<'JS'
                $input.length >= 14 ? '(99)99999-9999' : '(99)9999-9999'
            JS));
        }

        return $this;
    }

    public function minDigits( int|Closure $digits = 14): static
    {
        $this->rules(['regex:/^([0-9\s\-\+\(\)]*)$/', 'min:'.$digits]);

        return $this;

    }

    public function format(string|Closure $format = '(99)99999-9999'): static
    {
        $this->dynamic(false)
            ->minLength(0)
            ->mask($format);

        return $this;
    }
}
