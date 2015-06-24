<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Bases\Command;
use Arcanedev\Generators\Generators\ConsoleGenerator;

/**
 * Class ConsoleCommand
 * @package Arcanedev\Generators\Commands
 */
class ConsoleCommand extends Command
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
        (new ConsoleGenerator([
            'name'        => $this->argument('name'),
            'force'       => $this->option('force'),
            'command'     => $this->option('command'),
            'description' => $this->option('description'),
        ]))->run();

        $this->info('Console created successfully.');
    }
}
