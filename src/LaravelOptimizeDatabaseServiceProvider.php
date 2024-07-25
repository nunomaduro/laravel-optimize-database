<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelOptimizeDatabase;

use Illuminate\Support\ServiceProvider;

/**
 * @internal
 */
final class LaravelOptimizeDatabaseServiceProvider extends ServiceProvider
{
    /**
     * {@inheritDoc}
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../database/migrations/optimize_database_settings.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_optimize_database_settings.php'),
        ], 'migrations');
    }

    /**
     * {@inheritDoc}
     */
    public function commands($commands): void
    {
        $this->commands([
            DbOptimizeCommand::class,
        ]);
    }
}
