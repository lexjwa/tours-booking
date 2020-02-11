<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->app->bind(
            'App\Contracts\v1\AuthInterface',
            'App\Services\v1\AuthService'
        );
        $this->app->bind(
            'App\Contracts\v1\AdminInterface',
            'App\Services\v1\AdminService'
        );
        $this->app->bind(
            'App\Contracts\v1\EventInterface',
            'App\Services\v1\EventService'
        );
        $this->app->bind(
            'App\Contracts\v1\ReminderInterface',
            'App\Services\v1\ReminderService'
        );
        $this->app->bind(
            'App\Contracts\v1\EmailsInterface',
            'App\Services\v1\EmailsService'
        );
        $this->app->bind(
            'App\Contracts\v1\SettingInterface',
            'App\Services\v1\SettingService'
        );
        $this->app->bind(
            'App\Contracts\v1\CampaignsInterface',
            'App\Services\v1\CampaignsService'
        );
    }

}
