<?php namespace Arcanedev\Generators\Providers;

use Arcanedev\Generators\Generators\ConsoleGenerator;
use Arcanedev\Generators\Generators\ControllerGenerator;
use Arcanedev\Generators\Generators\FormGenerator;
use Arcanedev\Generators\Generators\MigrationGenerator;
use Arcanedev\Generators\Generators\ModelGenerator;
use Arcanedev\Generators\Generators\PivotGenerator;
use Arcanedev\Generators\Generators\RequestGenerator;
use Arcanedev\Generators\Generators\ScaffoldGenerator;
use Arcanedev\Generators\Generators\SeedGenerator;
use Arcanedev\Generators\Generators\ViewGenerator;
use Arcanedev\Support\ServiceProvider;
use Closure;

/**
 * Class     GeneratorsServiceProvider
 *
 * @package  Arcanedev\Generators\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeneratorsServiceProvider extends ServiceProvider
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
    protected $vendor       = 'arcanedev';

    /**
     * Package name.
     *
     * @var string
     */
    protected $package      = 'generators';

    /** @var array */
    protected $generators   = [];

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerModelGenerator();
        $this->registerControllerGenerator();
        $this->registerConsoleGenerator();
        $this->registerViewGenerator();
        $this->registerSeedGenerator();
        $this->registerMigrationGenerator();
        $this->registerRequestGenerator();
        $this->registerPivotGenerator();
        $this->registerScaffoldGenerator();
        $this->registerFormGenerator();
    }

    /**
     * @return array
     */
    public function provides()
    {
        return $this->generators;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Generators Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the model generator.
     */
    private function registerModelGenerator()
    {
        $this->registerGenerator('model', function() {
            return new ModelGenerator;
        });
    }

    /**
     * Register the controller generator.
     */
    private function registerControllerGenerator()
    {
        $this->registerGenerator('controller', function() {
            return new ControllerGenerator;
        });
    }

    /**
     * Register the console generator.
     */
    private function registerConsoleGenerator()
    {
        $this->registerGenerator('console', function() {
            return new ConsoleGenerator;
        });
    }

    /**
     * Register the view generator.
     */
    private function registerViewGenerator()
    {
        $this->registerGenerator('view', function() {
            return new ViewGenerator;
        });
    }

    /**
     * Register the seed generator.
     */
    private function registerSeedGenerator()
    {
        $this->registerGenerator('seed', function() {
            return new SeedGenerator;
        });
    }

    /**
     * Register the migration generator.
     */
    private function registerMigrationGenerator()
    {
        $this->registerGenerator('migration', function() {
            return new MigrationGenerator;
        });
    }

    /**
     * Register the request generator.
     */
    private function registerRequestGenerator()
    {
        $this->registerGenerator('request', function() {
            return new RequestGenerator;
        });
    }

    /**
     * Register the pivot generator.
     */
    private function registerPivotGenerator()
    {
        $this->registerGenerator('pivot', function() {
            return new PivotGenerator;
        });
    }

    /**
     * Register the scaffold generator.
     */
    private function registerScaffoldGenerator()
    {
        $this->registerGenerator('scaffold', function() {
            return new ScaffoldGenerator;
        });
    }

    /**
     * Register the form generator.
     */
    private function registerFormGenerator()
    {
        $this->registerGenerator('form', function() {
            return new FormGenerator;
        });
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the generator.
     *
     * @param  string   $name
     * @param  Closure  $callback
     */
    private function registerGenerator($name, Closure $callback)
    {
        $generator = $this->vendor . '.' . $this->package . '.' . $name;

        $this->app->singleton($generator, $callback);

        $this->generators[] = $generator;
    }
}
