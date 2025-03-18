<?php

namespace Joinapi\FilamentUtility\Form\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Joinapi\FilamentUtility\Support\Strings;

trait WithVIACep
{
    const FIELD_VALIDATED_CEP = 'is_valid_cep';

    const FIELD_VALIDATED_CEP_UNKNOWN = 'UNKNOWN';

    const FIELD_VALIDATED_CEP_FROM_RECORD = 'FROM_RECORD';

    const FIELD_VALIDATED_CEP_FROM_SERVICE = 'FROM_SERVICE';

    public const CEP_COMMONS_FIELDS_NULLABLE = [
        'bairro' => null,
        'complemento' => null,
        'rua' => null,
        'numero' => null,
        'cidade' => null,
        'uf' => null,
        'cep' => null,
    ];


    public function getCEPData(?string $cep): ?array
    {
        Log::debug('Consultando CEP ' . $cep);

        $cep = Strings::onlyNumbers($cep);

        if (empty($cep)) {
            return [
                'erro' => 'CEP NAO INFORMADO',
            ];
        }elseif (mb_strlen($cep, 'UTF-8') < 8) {
            return [
                'erro' => 'CEP INVALIDO',
            ];
        }


        try {
            $request = Http::get(config('filament-utility.viacep_url') . $cep . '/json/')->json();
        } catch (\Exception $exception) {
            Log::error('ERRO CONSULTANDO VIA CEP ' . $cep, $exception->getTrace());

            return [
                'erro' => $exception->getMessage(),
            ];
        }

        if (blank($request) || Arr::has($request, 'erro')) {

            return null;
        }

        return $request;
    }
}
