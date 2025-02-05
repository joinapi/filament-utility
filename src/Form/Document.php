<?php

namespace Joinapi\FilamentUtility\Form;

use Closure;
use Filament\Forms\Components\TextInput;
use Filament\Support\RawJs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Document extends TextInput
{
    public bool $validation = true;

    public function unique(Closure|string|null $table = null, Closure|string|null $column = null, Model|Closure|null $ignorable = null, bool $ignoreRecord = false, ?Closure $modifyRuleUsing = null): static
    {
        $this->validation = true;
        $this->registerMutation();
        parent::unique($table, $column, $ignorable, $ignoreRecord, $modifyRuleUsing);

        return $this;

    }

    private function registerMutation(): void {
        $this->mutateStateForValidationUsing(fn (string $state): string => Str::of($state)
            ->replaceMatches('/[^0-9]/', ''));
    }

    public function dynamic(bool $condition = true): static
    {
        if (self::getValidation()) {
           // $this->rule('cpf_ou_cnpj');
        }

        if ($condition) {
            $this->mask(RawJs::make(<<<'JS'
                $input.length > 14 ? '99.999.999/9999-99' : '999.999.999-99'
            JS))->minLength(14);
        }

        return $this;
    }

    public function cpf(string|Closure $format = '999.999.999-99'): static
    {
        $this->dynamic(false)
            ->mask($format);

        $this->mutateStateForValidationUsing(fn (string $state): string => Str::of($state)
            ->replaceMatches('/[^0-9]/', ''));

        if (self::getValidation()) {
            $this->rule('cpf');
            $this->validationAttribute('CPF');
            $this->validationMessages(['cpf' => 'O CPF informado não é valido.']);
            $this->validationMessages(['required' => 'O CPF é obrigatório.']);
        }

        return $this;
    }

    public function cnpj(string|Closure $format = '99.999.999/9999-99'): static
    {
        $this->dynamic(false)
            ->mask($format);

        if (self::getValidation()) {
            $this->rule('cnpj');
            $this->validationAttribute('CNPJ');
            $this->validationMessages(['cnpj' => 'O CNPJ informado não é valido.']);
            $this->validationMessages(['required' => 'O CNPJ é obrigatório.']);
        }

        return $this;
    }

    public function validation(bool|Closure $condition = true): static
    {
        $this->validation = $condition;

        return $this;
    }

    public function getValidation(): bool
    {
        return $this->validation;
    }
}
