<?php

namespace App\Providers;

use App\Services\DynamicForm;
use App\Services\DynamicField;
use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\DynamicFormInterface;
use App\Services\Interfaces\DynamicFieldInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(DynamicFormInterface::class, DynamicForm::class);
        $this->app->bind(DynamicFieldInterface::class, DynamicField::class);
    }
}
