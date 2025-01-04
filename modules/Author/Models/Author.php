<?php

namespace Modules\Author\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Support\Models\BaseModel;
use Modules\Support\Traits\Searchable;
use Modules\Support\Traits\ActivityLog;
use Modules\User\Models\User;

class Author extends User
{
    use ActivityLog, Searchable, SoftDeletes;
    
    protected $table = 'authors';
}
