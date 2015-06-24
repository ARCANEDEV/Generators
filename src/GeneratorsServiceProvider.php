<?php namespace Arcanedev\Generators;

use Illuminate\Support\ServiceProvider;

/**
 * Class GeneratorsServiceProvider
 * @package Arcanedev\Generators
 */
class GeneratorsServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerCommands();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the commands
     */
    private function registerCommands()
    {
        $commands = [
            Commands\ModelCommand::class,
            Commands\ControllerCommand::class,
            Commands\ConsoleCommand::class,
            Commands\ViewCommand::class,
            Commands\SeedCommand::class,
            Commands\MigrationCommand::class,
            Commands\RequestCommand::class,
            Commands\PivotCommand::class,
            Commands\ScaffoldCommand::class,
            Commands\FormCommand::class,
        ];

        foreach ($commands as $command) {
            $this->commands($command);
        }
    }
}
