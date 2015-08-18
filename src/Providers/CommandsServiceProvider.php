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
use Arcanedev\Support\Laravel\ServiceProvider;
use Closure;

/**
 * Class CommandsServiceProvider
 * @package Arcanedev\Generators\Providers
 */
class CommandsServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Constants
     | ------------------------------------------------------------------------------------------------
     */
    const COMMAND_KEY = 'generator';

    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
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

    /* ------------------------------------------------------------------------------------------------
     |  Commands Functions
     | ------------------------------------------------------------------------------------------------
     */
    private function registerGenerateModelCommand()
    {
        $this->registerCommand('model', function() {
            return new GenerateModelGeneratorCommand(
                new ModelGenerator
            );
        });
    }

    private function registerGenerateControllerCommand()
    {
        $this->registerCommand('controller', function() {
            return new GenerateControllerGeneratorCommand(
                new ControllerGenerator
            );
        });
    }

    private function registerGenerateConsoleCommand()
    {
        $this->registerCommand('console', function() {
            return new GenerateConsoleGeneratorCommand(
                new ConsoleGenerator
            );
        });
    }

    private function registerGenerateViewCommand()
    {
        $this->registerCommand('view', function() {
            return new GenerateViewGeneratorCommand(
                new ViewGenerator
            );
        });
    }

    private function registerGenerateSeedCommand()
    {
        $this->registerCommand('seed', function() {
            return new GenerateSeedGeneratorCommand(
                new SeedGenerator
            );
        });
    }

    private function registerGenerateMigrationCommand()
    {
        $this->registerCommand('migration', function() {
            return new GenerateMigrationGeneratorCommand(
                new MigrationGenerator
            );
        });
    }

    private function registerGenerateRequestCommand()
    {
        $this->registerCommand('request', function() {
            return new GenerateRequestGeneratorCommand(
                new RequestGenerator
            );
        });
    }

    private function registerGeneratePivotCommand()
    {
        $this->registerCommand('pivot', function() {
            return new GeneratePivotGeneratorCommand(
                new PivotGenerator
            );
        });
    }

    private function registerGenerateScaffoldCommand()
    {
        $this->registerCommand('scaffold', function() {
            return new GenerateScaffoldGeneratorCommand(
                new ScaffoldGenerator
            );
        });
    }

    private function registerGenerateFormCommand()
    {
        $this->registerCommand('form', function() {
            return new GenerateFormGeneratorCommand(
                new FormGenerator
            );
        });
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register a command
     *
     * @param  string   $name
     * @param  Closure  $callback
     *
     * @return self
     */
    private function registerCommand($name, Closure $callback)
    {
        $name = self::COMMAND_KEY . '.' . $name;
        $this->app->bind($name, $callback);
        $this->commands[] = $name;

        return $this;
    }
}
