<?php namespace Arcanedev\Generators;

use Arcanedev\Support\Laravel\PackageServiceProvider;

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
    protected $package = 'generators';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerProviders();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    private function registerProviders()
    {
        $this->app->register(Providers\CommandsServiceProvider::class);
    }
}
