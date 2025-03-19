<?php

namespace Joinapi\FilamentUtility\Form;

use Closure;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Joinapi\FilamentUtility\Form\Concerns\WithVIACep;
use Joinapi\FilamentUtility\Support\Strings;
use Livewire\Component as Livewire;

class Cep extends TextInput
{
    use WithVIACep;

    public function viaCep(string $mode = 'suffix', string $errorMessage = 'CEP INVÁLIDO.', array $setFields = []): static
    {
        $viaCepRequest = function ($state, $livewire, $set, $component, $errorMessage, array $setFields) {

            foreach ($setFields as $key => $value) {
                $set($key, null);
            }

            $livewire->validateOnly($component->getKey());

            $request = $this->getCEPData($state);

            if (blank($request) || Arr::has($request, 'erro')) {
                $set('cep', null);

                throw ValidationException::withMessages([
                    $component->getKey() => 'O CEP ' . Strings::mask($state, '##.###-###') . ' É INVÁLIDO',
                ]);
            }

            $set(self::FIELD_VALIDATED_CEP, self::FIELD_VALIDATED_CEP_FROM_SERVICE);

            foreach ($setFields as $key => $value) {
                if (Arr::has($request, $value)) {
                    $nv = mb_strtoupper($request[$value]) ?? null;
                    $set($key, $nv);
                }

            }

            $livewire->dispatch('cep-validated', true);
        };

        $this
            ->rules([
                fn ($get, $livewire): Closure => function (string $attribute, $value, Closure $fail) use ($livewire) {
                    $dt = data_get($livewire, 'data.endereco.' . Cep::FIELD_VALIDATED_CEP);

                    Log::debug('Validating  CEP ' . $value . ' ' . $dt);

                    if (! empty($value) && mb_strlen($value) < 8) {
                        $fail('O CEP deve ter no mínimo 8 caracteres.');
                    }

                }, ])
            ->mask('99.999-999')
            ->live(debounce: 500)
            ->afterStateUpdated(function (?string $state, ?string $old, Livewire $livewire, Set $set, Component $component) use ($mode, $errorMessage, $setFields, $viaCepRequest) {

                if ($mode === 'debounce') {
                    $newState = Strings::onlyNumbers($state);
                    $oldState = Strings::onlyNumbers($old);
                    Log::debug('Evento de pesquisa ' . $newState . ' ' . $oldState);

                    if( empty($newState) ) {
                        foreach ($setFields as $key => $value) {
                            $set($key, null);
                        }
                    }

                    if ($newState !== $oldState) {
                        if (! empty($newState) && mb_strlen($newState) == 8) {
                            $viaCepRequest($newState, $livewire, $set, $component, $errorMessage, $setFields);
                        } else {
                            $set(self::FIELD_VALIDATED_CEP, Cep::FIELD_VALIDATED_CEP_UNKNOWN);
                        }
                    }
                }
            })
            ->mutateStateForValidationUsing(fn ($state) => Strings::onlyNumbers($state))
            ->dehydrateStateUsing(fn ($state) => Strings::onlyNumbers($state))
            ->suffixAction(function () use ($mode, $errorMessage, $setFields, $viaCepRequest) {
                if ($mode === 'suffix') {
                    return Action::make('search-action')
                        ->label('Buscar CEP')
                        ->icon('heroicon-o-magnifying-glass')
                        ->action(function ($state, Livewire $livewire, Set $set, Component $component) use ($errorMessage, $setFields, $viaCepRequest) {
                            $viaCepRequest($state, $livewire, $set, $component, $errorMessage, $setFields);
                        })
                        ->cancelParentActions();
                }

                return null;
            })
            ->prefixAction(function () use ($mode, $errorMessage, $setFields, $viaCepRequest) {
                if ($mode === 'prefix') {
                    return Action::make('search-action')
                        ->label('Buscar CEP')
                        ->icon('heroicon-o-magnifying-glass')
                        ->action(function ($state, Livewire $livewire, Set $set, Component $component) use ($errorMessage, $setFields, $viaCepRequest) {
                            $viaCepRequest($state, $livewire, $set, $component, $errorMessage, $setFields);
                        })
                        ->cancelParentActions();
                }

                return null;
            });

        return $this;
    }
}
