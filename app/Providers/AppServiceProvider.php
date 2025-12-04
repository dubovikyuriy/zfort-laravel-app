<?php

namespace App\Providers;

use App\Contracts\AIActorInterface;
use App\Services\OpenAIActorService;
use App\Services\PromptBuilderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AIActorInterface::class, OpenAIActorService::class);
        $this->app->singleton(PromptBuilderService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
