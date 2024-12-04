<?php

namespace Joinapi\FilamentUtility;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class FilamentUtilityServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        FilamentAsset::register([
            Js::make('money-script', __DIR__.'/../resources/js/money.js'),
        ]);


        /*
        $rules = [
            'celular'                        => \Joinapi\FilamentUtility\Rules\Celular::class,
            'celular_com_ddd'                => \Joinapi\FilamentUtility\Rules\CelularComDdd::class,
            'celular_com_codigo'             => \Joinapi\FilamentUtility\Rules\CelularComCodigo::class,
            'celular_com_codigo_sem_mascara' => \Joinapi\FilamentUtility\Rules\CelularComCodigoSemMascara::class,
            'cnh'                            => \Joinapi\FilamentUtility\Rules\Cnh::class,
            'cnpj'                           => \Joinapi\FilamentUtility\Rules\Cnpj::class,
            'cns'                            => \Joinapi\FilamentUtility\Rules\Cns::class,
            'cpf'                            => \Joinapi\FilamentUtility\Rules\Cpf::class,
            'formato_cnpj'                   => \Joinapi\FilamentUtility\Rules\FormatoCnpj::class,
            'formato_cpf'                    => \Joinapi\FilamentUtility\Rules\FormatoCpf::class,
            'telefone'                       => \Joinapi\FilamentUtility\Rules\Telefone::class,
            'telefone_com_ddd'               => \Joinapi\FilamentUtility\Rules\TelefoneComDdd::class,
            'telefone_com_codigo'            => \Joinapi\FilamentUtility\Rules\TelefoneComCodigo::class,
            'formato_cep'                    => \Joinapi\FilamentUtility\Rules\FormatoCep::class,
            'formato_placa_de_veiculo'       => \Joinapi\FilamentUtility\Rules\FormatoPlacaDeVeiculo::class,
            'formato_pis'                    => \Joinapi\FilamentUtility\Rules\FormatoPis::class,
            'pis'                            => \Joinapi\FilamentUtility\Rules\Pis::class,
            'cpf_ou_cnpj'                    => \Joinapi\FilamentUtility\Rules\CpfOuCnpj::class,
            'formato_cpf_ou_cnpj'            => \Joinapi\FilamentUtility\Rules\FormatoCpfOuCnpj::class,
            'uf'                             => \Joinapi\FilamentUtility\Rules\Uf::class,

        ];

        foreach ($rules as $name => $class) {
            $rule = new $class;

            $extension = static function ($attribute, $value) use ($rule) {
                return $rule->passes($attribute, $value);
            };

            $this->app['filament-utility']->extend($name, $extension, $rule->message());
        }*/
    }

    public function boot()
    {

    }
}
