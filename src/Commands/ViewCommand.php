<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Bases\Command;
use Arcanedev\Generators\Generators\ViewGenerator;

/**
 * Class ViewCommand
 * @package Arcanedev\Generators\Commands
 */
class ViewCommand extends Command
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
    protected $signature = 'generate:view
                            {name : The name of class being generated.}
                            {--extends= : The name of view layout being used.}
                            {--section= : The name of section being used.}
                            {--content= : The view content.}
                            {--template= : The path of view template.}
                            {--master : Create a master view.}
                            {--plain : Create a blank view.}
                            {--force : Force the creation if file already exists.}';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Generate a new view.';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Execute the command.
     */
    public function handle()
    {
        (new ViewGenerator([
            'name'      => $this->argument('name'),
            'extends'   => $this->option('extends'),
            'section'   => $this->option('section'),
            'master'    => $this->option('master'),
            'plain'     => $this->option('plain'),
            'content'   => $this->option('content'),
            'template'  => $this->option('template'),
            'force'     => $this->option('force'),
        ]))->run();

        $this->info('View created successfully.');
    }
}
