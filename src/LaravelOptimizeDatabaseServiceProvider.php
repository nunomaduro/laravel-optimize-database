<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelOptimizeDatabase;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use NunoMaduro\LaravelOptimizeDatabase\Commands\DbOptimizeCommand;

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
        $this->registerCommands();
        $this->configurePublishing();
    }

    /**
     * {@inheritDoc}
     */
    private function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                DbOptimizeCommand::class,
            ]);
        }

        if (DB::getDriverName() === 'sqlite') {
            DB::unprepared(<<<'SQL'
                PRAGMA busy_timeout = 5000;
                PRAGMA cache_size = -20000;
                PRAGMA foreign_keys = ON;
                PRAGMA incremental_vacuum;
                PRAGMA mmap_size = 2147483648;
                PRAGMA temp_store = MEMORY;
                PRAGMA synchronous = NORMAL;
                SQL,
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    private function configurePublishing(): void
    {
        $this->publishes([
            __DIR__.'/../database/migrations/optimize_database_settings.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_optimize_database_settings.php'),
        ], 'migrations');
    }
}
