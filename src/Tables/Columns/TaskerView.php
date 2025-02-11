<?php

namespace App\Tables\Columns;

use App\Concerns\HasTaskView;
use App\Enums\StatusItemTema;
use Closure;
use Filament\Forms\Concerns\CanBeValidated;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\Concerns\CanUpdateState;
use Illuminate\Contracts\Support\Htmlable;

class TaskerView extends ColumnGroup
{
    use CanBeValidated;
    use CanUpdateState;
    use HasTaskView;

    protected array | Closure $tasks = ['INVITE' => StatusItemTema::STS_PNI];

    public function tasks(array | Closure $tasks): static
    {
        $this->tasks = $tasks;

        return $this;
    }
    public function getStatus( string $sigla): string | Htmlable
    {
        return StatusItemTema::STS_PNI;
    }

    protected string $view = 'tables.columns.tasker-io-view';

    // protected string $view = 'tables.columns.tasker-view';

    public function icon(): string
    {
        return 'heroicon-s-task';
    }

    public static function make(string | Htmlable | Closure $label, array | Closure $columns = []): static
    {
        return parent::make($label, self::fillTask($columns));
    }
}
