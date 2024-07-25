<p align="center">
    <img src="https://raw.githubusercontent.com/nunomaduro/laravel-optimize-database/main/docs/logo.png" height="300" alt="Skeleton Php">
    <p align="center">
        <a href="https://github.com/nunomaduro/laravel-optimize-database/actions"><img alt="GitHub Workflow Status (main)" src="https://github.com/nunomaduro/laravel-optimize-database/actions/workflows/tests.yml/badge.svg"></a>
        <a href="https://packagist.org/packages/nunomaduro/laravel-optimize-database"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/nunomaduro/laravel-optimize-database"></a>
        <a href="https://packagist.org/packages/nunomaduro/laravel-optimize-database"><img alt="Latest Version" src="https://img.shields.io/packagist/v/nunomaduro/laravel-optimize-database"></a>
        <a href="https://packagist.org/packages/nunomaduro/laravel-optimize-database"><img alt="License" src="https://img.shields.io/packagist/l/nunomaduro/laravel-optimize-database"></a>
    </p>
</p>

------

This package publish a migration that will apply good defaults to your SQLite database, making it faster and more production-ready.

> **Requires [PHP 8.2+](https://php.net/releases), [SQLite 3.46+](https://www.sqlite.org/changes.html) and [Laravel 11.0+](https://laravel.com)**

## 🚀 Installation

You can install the package via [Composer](https://getcomposer.org):

```bash
composer require nunomaduro/laravel-optimize-database
```

## 🙌 Usage

To optimize your SQLite database, you need to run the migration that this package provides:

```bash
php artisan db:optimize
```

This will publish a migration that apply defaults like so:

```SQL
PRAGMA journal_mode = WAL;
PRAGMA synchronous = NORMAL;
... etc
```

Next, you simply need to run the migration:

```bash
php artisan migrate
```

**Laravel Optimize Database** was created by **[Nuno Maduro](https://twitter.com/enunomaduro)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
