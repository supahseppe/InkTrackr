<?php

return [
    App\Providers\AppServiceProvider::class,

    \SocialiteProviders\Manager\ServiceProvider::class,

    Modules\Support\SupportServiceProvider::class,
    Modules\AdminAuth\AdminAuthServiceProvider::class,
    Modules\User\UserServiceProvider::class,
    Modules\Dashboard\DashboardServiceProvider::class,
    Modules\Acl\AclServiceProvider::class,
    
    // Modules\Index\IndexServiceProvider::class,
    Modules\Project\ProjectServiceProvider::class,
    Modules\Author\AuthorServiceProvider::class,
    Modules\Progress\ProgressServiceProvider::class,
];
