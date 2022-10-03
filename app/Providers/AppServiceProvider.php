<?php

namespace App\Providers;

use App\Repositories\CommandRepository;
use App\Repositories\ProjectRepository;
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
        $this->app->scoped(ProjectRepository::class, function () {
            return new ProjectRepository();
        });
        $this->app->scoped(CommandRepository::class, function () {
            return new CommandRepository();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
