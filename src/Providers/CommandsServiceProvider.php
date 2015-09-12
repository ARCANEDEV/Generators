<?php namespace Arcanedev\Generators\Providers;

use Arcanedev\Generators\Commands\GenerateConsoleGeneratorCommand;
use Arcanedev\Generators\Commands\GenerateControllerGeneratorCommand;
use Arcanedev\Generators\Commands\GenerateFormGeneratorCommand;
use Arcanedev\Generators\Commands\GenerateMigrationGeneratorCommand;
use Arcanedev\Generators\Commands\GenerateModelGeneratorCommand;
use Arcanedev\Generators\Commands\GeneratePivotGeneratorCommand;
use Arcanedev\Generators\Commands\GenerateRequestGeneratorCommand;
use Arcanedev\Generators\Commands\GenerateScaffoldGeneratorCommand;
use Arcanedev\Generators\Commands\GenerateSeedGeneratorCommand;
use Arcanedev\Generators\Commands\GenerateViewGeneratorCommand;
use Arcanedev\Generators\Contracts\GeneratorInterface;
use Arcanedev\Support\ServiceProvider;
use Closure;

/**
 * Class CommandsServiceProvider
 * @package Arcanedev\Generators\Providers
 */
class CommandsServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var string */
    protected $vendor   = 'arcanedev';

    /** @var string */
    protected $package  = 'generators';

    /** @var array */
    protected $commands = [];

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerGenerateModelCommand();
        $this->registerGenerateControllerCommand();
        $this->registerGenerateConsoleCommand();
        $this->registerGenerateViewCommand();
        $this->registerGenerateSeedCommand();
        $this->registerGenerateMigrationCommand();
        $this->registerGenerateRequestCommand();
        $this->registerGeneratePivotCommand();
        $this->registerGenerateScaffoldCommand();
        $this->registerGenerateFormCommand();

        $this->commands($this->commands);
    }

    /**
     * Get the provided commands by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return $this->commands;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Commands Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the model generator.
     */
    private function registerGenerateModelCommand()
    {
        $this->registerCommand('model', function() {
            return new GenerateModelGeneratorCommand(
                $this->getGenerator('model')
            );
        });
    }

    /**
     * Register the controller generator.
     */
    private function registerGenerateControllerCommand()
    {
        $this->registerCommand('controller', function() {
            return new GenerateControllerGeneratorCommand(
                $this->getGenerator('controller')
            );
        });
    }

    /**
     * Register the console generator.
     */
    private function registerGenerateConsoleCommand()
    {
        $this->registerCommand('console', function() {
            return new GenerateConsoleGeneratorCommand(
                $this->getGenerator('console')
            );
        });
    }

    /**
     * Register the view generator.
     */
    private function registerGenerateViewCommand()
    {
        $this->registerCommand('view', function() {
            return new GenerateViewGeneratorCommand(
                $this->getGenerator('view')
            );
        });
    }

    /**
     * Register the seed generator.
     */
    private function registerGenerateSeedCommand()
    {
        $this->registerCommand('seed', function() {
            return new GenerateSeedGeneratorCommand(
                $this->getGenerator('seed')
            );
        });
    }

    /**
     * Register the migration generator.
     */
    private function registerGenerateMigrationCommand()
    {
        $this->registerCommand('migration', function() {
            return new GenerateMigrationGeneratorCommand(
                $this->getGenerator('migration')
            );
        });
    }

    /**
     * Register the request generator.
     */
    private function registerGenerateRequestCommand()
    {
        $this->registerCommand('request', function() {
            return new GenerateRequestGeneratorCommand(
                $this->getGenerator('request')
            );
        });
    }

    /**
     * Register the pivot generator.
     */
    private function registerGeneratePivotCommand()
    {
        $this->registerCommand('pivot', function() {
            return new GeneratePivotGeneratorCommand(
                $this->getGenerator('pivot')
            );
        });
    }

    /**
     * Register the scaffold generator.
     */
    private function registerGenerateScaffoldCommand()
    {
        $this->registerCommand('scaffold', function() {
            return new GenerateScaffoldGeneratorCommand(
                $this->getGenerator('scaffold')
            );
        });
    }

    /**
     * Register the form generator.
     */
    private function registerGenerateFormCommand()
    {
        $this->registerCommand('form', function() {
            return new GenerateFormGeneratorCommand(
                $this->getGenerator('form')
            );
        });
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register a command.
     *
     * @param  string   $name
     * @param  Closure  $callback
     */
    private function registerCommand($name, Closure $callback)
    {
        $command = $this->vendor . '.' . $this->package . '.commands.' . $name;

        $this->app->singleton($command, $callback);

        $this->commands[] = $command;
    }

    /**
     * Get the generator.
     *
     * @param  string  $name
     *
     * @return GeneratorInterface
     */
    private function getGenerator($name)
    {
        $generator = $this->vendor . '.' . $this->package . '.' . $name;

        return $this->app[$generator];
    }
}
