<?php

namespace Modules\Progress\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Support\Models\BaseModel;
use Modules\Support\Traits\Searchable;
use Modules\Support\Traits\ActivityLog;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Project\Models\Project;

class Progress extends BaseModel
{
    use ActivityLog, Searchable, SoftDeletes;
    
    protected $table = 'progress';

    /**
     * Get the project that owns this progress.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}