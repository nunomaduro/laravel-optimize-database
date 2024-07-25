<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelOptimizeDatabase\Commands;

use Illuminate\Console\Command;
use NunoMaduro\LaravelOptimizeDatabase\LaravelOptimizeDatabaseServiceProvider;

/**
 * @internal
 */
final class DbOptimizeCommand extends Command
{
    /**
     * {@inheritDoc}
     */
    protected $signature = 'db:optimize';

    /**
     * {@inheritDoc}
     */
    protected $description = 'Publishes the latest database optimization migration.';

    /**
     * {@inheritDoc}
     */
    public function handle(): void
    {
        $this->call('vendor:publish', [
            '--provider' => LaravelOptimizeDatabaseServiceProvider::class,
        ]);

        if (config('database.default') !== 'sqlite') {
            $this->error('Optimization is only available for SQLite databases.');

            return;
        }

        $this->components->warn('Please validate the migration before running it in production. It may contain settings that are not compatible with your application.');
        $this->components->info('Once validated, you may run [php artisan migrate] to apply the migration.');
    }
}
