<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LogService
{
    public static function record(string $action, string $module, string $message, array $context = []): void
    {
        if (!Auth::check()) {
            return;
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => $action,
            'module'  => $module,
            'level'   => 'info',
            'message' => $message,
            'context' => $context ?: null,
        ]);
    }
}
