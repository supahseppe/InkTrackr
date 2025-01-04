<?php

namespace Modules\Project\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Support\Models\BaseModel;
use Modules\Support\Traits\Searchable;
use Modules\Support\Traits\ActivityLog;
use Modules\Progress\Models\Progress;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends BaseModel
{
    use ActivityLog, Searchable, SoftDeletes;
    
    protected $table = 'projects';

    /**
     * Get the progress for the project.
     */
    public function progress(): HasMany
    {
        return $this->hasMany(Progress::class);
    }
}
