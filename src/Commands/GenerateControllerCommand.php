<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Bases\GeneratorCommand;

/**
 * Class GenerateControllerCommand
 * @package Arcanedev\Generators\Commands
 */
class GenerateControllerGeneratorCommand extends GeneratorCommand
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The name of command.
     *
     * @var string
     */
    protected $signature = 'generate:controller
                            {name : The name of class being generated.}
                            {--resource : Generate a resource controller.}
                            {--scaffold : Generate a scaffold controller.}
                            {--force : Force the creation if file already exists.}';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Generate a new controller.';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Execute the command.
     */
    public function handle()
    {
        $this->generator
            ->setConsole($this)
            ->setOptions([
                'name'      => $this->argument('name'),
                'resource'  => $this->option('resource'),
                'scaffold'  => $this->option('scaffold'),
                'force'     => $this->option('force'),
            ])->run();

        $this->info('Controller created successfully.');
    }
}
