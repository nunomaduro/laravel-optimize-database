<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelOptimizeDatabase\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use NunoMaduro\LaravelOptimizeDatabase\LaravelOptimizeDatabaseServiceProvider;

use function Laravel\Prompts\table;

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

        if (DB::getDriverName() !== 'sqlite') {
            $this->error('Optimization is only available for SQLite databases.');

            return;
        }

        $this->components->info('The following settings will be applied to your SQLite database:');

        table([
            'Setting',
            'Value',
            'Via',
        ], [
            ['PRAGMA auto_vacuum', 'incremental', 'Migration'],
            ['PRAGMA journal_mode', 'WAL', 'Migration'],
            ['PRAGMA page_size', '32768', 'Migration'],
            ['PRAGMA busy_timeout', '5000', 'Runtime'],
            ['PRAGMA cache_size', '-20000', 'Runtime'],
            ['PRAGMA foreign_keys', 'ON', 'Runtime'],
            ['PRAGMA incremental_vacuum', '', 'Runtime'],
            ['PRAGMA mmap_size', '2147483648', 'Runtime'],
            ['PRAGMA temp_store', 'MEMORY', 'Runtime'],
            ['PRAGMA synchronous', 'NORMAL', 'Runtime'],
        ]);

        $this->components->info('While [Runtime] settings are applied automatically, [Migration] settings will only be applied after running [php artisan migrate].');
        $this->components->warn('Please make sure to backup your database before running the migrations.');
    }
}
