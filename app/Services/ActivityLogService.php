<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogService
{
    public function log(
        string $action,
        string $module,
        ?string $description = null,
        array $properties = []
    ) {
        return ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'properties' => $properties,
        ]);
    }
}
