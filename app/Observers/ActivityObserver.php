<?php

namespace App\Observers;

use App\Services\LogService;
use Illuminate\Database\Eloquent\Model;

class ActivityObserver
{
    /** Campos que no aportan valor en el log y se excluyen */
    private const SKIP_KEYS = ['password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'];

    private function compact(array $attrs): array
    {
        return array_diff_key($attrs, array_flip(self::SKIP_KEYS));
    }

    public function created(Model $model): void
    {
        LogService::record(
            'creado',
            class_basename($model),
            'Registro creado en ' . class_basename($model) . ' #' . $model->getKey(),
            $this->compact($model->getAttributes())
        );
    }

    public function updated(Model $model): void
    {
        $changes = $this->compact($model->getChanges());
        if (empty($changes)) return;

        LogService::record(
            'actualizado',
            class_basename($model),
            'Registro actualizado en ' . class_basename($model) . ' #' . $model->getKey(),
            $changes
        );
    }

    public function deleted(Model $model): void
    {
        LogService::record(
            'eliminado',
            class_basename($model),
            'Registro eliminado en ' . class_basename($model) . ' #' . $model->getKey(),
            ['id' => $model->getKey()]
        );
    }
}
