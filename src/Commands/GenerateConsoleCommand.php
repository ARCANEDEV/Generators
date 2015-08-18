<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Bases\GeneratorCommand;

/**
 * Class GenerateConsoleCommand
 * @package Arcanedev\Generators\Commands
 */
class GenerateConsoleGeneratorCommand extends GeneratorCommand
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
    protected $signature = 'generate:console
                            {name : The name of class being generated.}
                            {--command= : The name of command being used.}
                            {--description= : The description of command being used.}
                            {--force : Force the creation if file already exists.}';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Generate a new console command.';

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
                'name'        => $this->argument('name'),
                'force'       => $this->option('force'),
                'command'     => $this->option('command'),
                'description' => $this->option('description'),
            ])->run();

        $this->info('Console created successfully.');
    }
}
