<?php

namespace Modules\Project;

use Modules\Support\BaseServiceProvider;

class ProjectServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'project');
    }
}