<?php namespace Arcanedev\Generators;

use Arcanedev\Support\PackageServiceProvider;

/**
 * Class GeneratorsServiceProvider
 * @package Arcanedev\Generators
 */
class GeneratorsServiceProvider extends PackageServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Vendor name.
     *
     * @var string
     */
    protected $vendor = 'arcanedev';

    /**
     * Package name
     *
     * @var string
     */
    protected $package = 'generators';

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the base path of the package.
     *
     * @return string
     */
    public function getBasePath()
    {
        return __DIR__ . '/../';
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Boot the package.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerProviders();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register all providers.
     */
    private function registerProviders()
    {
        $this->app->register(Providers\GeneratorsServiceProvider::class);
        $this->app->register(Providers\CommandsServiceProvider::class);
    }
}
