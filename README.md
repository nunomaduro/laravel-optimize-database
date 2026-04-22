<p align="center">
    <img src="https://raw.githubusercontent.com/nunomaduro/laravel-optimize-database/main/docs/logo.png" height="300" alt="Skeleton Php">
    <p align="center">
        <a href="https://github.com/nunomaduro/laravel-optimize-database/actions"><img alt="GitHub Workflow Status (main)" src="https://github.com/nunomaduro/laravel-optimize-database/actions/workflows/tests.yml/badge.svg"></a>
        <a href="https://packagist.org/packages/nunomaduro/laravel-optimize-database"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/nunomaduro/laravel-optimize-database"></a>
        <a href="https://packagist.org/packages/nunomaduro/laravel-optimize-database"><img alt="Latest Version" src="https://img.shields.io/packagist/v/nunomaduro/laravel-optimize-database"></a>
        <a href="https://packagist.org/packages/nunomaduro/laravel-optimize-database"><img alt="License" src="https://img.shields.io/packagist/l/nunomaduro/laravel-optimize-database"></a>
        <a href="https://youtube.com/@nunomaduro?sub_confirmation=1"><img alt="YouTube Channel Subscribers" src="https://img.shields.io/youtube/channel/subscribers/UCO_hYZF2gb_CyG5sA7ArlGg?style=flat&label=youtube&color=brightgreen"></a>
    </p>
</p>

------

> This package is a **work-in-progress**, therefore you should not use it in production - and **always** backup your database before requiring it through Composer.

This package provides a simple way to optimize your SQLite database in Laravel; it's a good starting point for production-ready SQLite databases. At the time of this writing,
it applies the following settings:

```
 ┌───────────────────────────┬─────────────┬───────────┐
 │ Setting                   │ Value       │ Via       │
 ├───────────────────────────┼─────────────┼───────────┤
 │ PRAGMA auto_vacuum        │ incremental │ Migration │
 │ PRAGMA journal_mode       │ WAL         │ Migration │
 │ PRAGMA page_size          │ 32768       │ Migration │
 │ PRAGMA busy_timeout       │ 5000        │ Runtime   │
 │ PRAGMA cache_size         │ -20000      │ Runtime   │
 │ PRAGMA foreign_keys       │ ON          │ Runtime   │
 │ PRAGMA incremental_vacuum │ (enabled)   │ Runtime   │
 │ PRAGMA mmap_size          │ 2147483648  │ Runtime   │
 │ PRAGMA temp_store         │ MEMORY      │ Runtime   │
 │ PRAGMA synchronous        │ NORMAL      │ Runtime   │
 └───────────────────────────┴─────────────┴───────────┘
 ```

The settings are applied in two ways:
- **[Migration Stub](https://github.com/nunomaduro/laravel-optimize-database/blob/main/database/migrations/optimize_database_settings.php.stub)** - Applied via migration.
- **[Runtime Configuration](https://github.com/nunomaduro/laravel-optimize-database/blob/main/src/LaravelOptimizeDatabaseServiceProvider.php)** - Applied at runtime, via service provider.

## 🚀 Installation

> **Requires [PHP 8.2+](https://php.net/releases), [SQLite 3.46+](https://www.sqlite.org/changes.html) and [Laravel 11.0+](https://laravel.com)**

You can install the package via [Composer](https://getcomposer.org):

```bash
composer require nunomaduro/laravel-optimize-database
```

## 🙌 Usage

To get started optimizing your SQLite database, you need to run the following command:

```bash
php artisan db:optimize
```

At this point, the [Runtime] settings are applied automatically. However, you need to run the migration to apply the [Migration] settings:

```bash
php artisan migrate
```

**Laravel Optimize Database** was created by **[Nuno Maduro](https://twitter.com/enunomaduro)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
