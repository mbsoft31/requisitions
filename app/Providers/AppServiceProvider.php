<?php

namespace App\Providers;

use App\Actions\Person\CreatePersonAction;
use App\Actions\Requisition\CreateRequisitionAction;
use App\Contracts\Person\CreatePerson;
use App\Contracts\Requisition\CreateRequisition;
use Illuminate\Support\Facades\Config;
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
        Config::set('app.locale', 'ar');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CreatePerson::class, CreatePersonAction::class);
        $this->app->bind(CreateRequisition::class, CreateRequisitionAction::class);
    }
}
