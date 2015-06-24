<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Bases\Command;
use Arcanedev\Generators\Generators\RequestGenerator;

/**
 * Class RequestCommand
 * @package Arcanedev\Generators\Commands
 */
class RequestCommand extends Command
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
    protected $signature = 'generate:request
                            {name : The name of class being generated.}
                            {--rules= : The rules.}
                            {--scaffold : Determine whether the request class generated with scaffold.}
                            {--auth : Determine whether the request class needs authorized.}
                            {--force : Force the creation if file already exists.}';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Generate a new form request class.';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Execute the command.
     */
    public function handle()
    {
        (new RequestGenerator([
            'name'      => $this->argument('name'),
            'rules'     => $this->option('rules'),
            'auth'      => $this->option('auth'),
            'scaffold'  => $this->option('scaffold'),
            'force'     => $this->option('force'),
        ]))->run();

        $this->info('Form request created successfully.');
    }
}
