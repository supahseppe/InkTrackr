<?php

namespace Modules\Progress;

use Modules\Support\BaseServiceProvider;

class ProgressServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'progress');
    }
}