<?php

namespace App\Providers;

use App\Actions\Person\CreatePersonAction;
use App\Actions\Requisition\CreateRequisitionAction;
use App\Actions\Requisition\PrintRequisitionAction;
use App\Contracts\Person\CreatePerson;
use App\Contracts\Requisition\CreateRequisition;
use App\Contracts\Requisition\PrintRequisition;
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
        $this->app->bind(PrintRequisition::class, PrintRequisitionAction::class);
    }
}
