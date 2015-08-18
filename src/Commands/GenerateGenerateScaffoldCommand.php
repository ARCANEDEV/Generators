<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Bases\GeneratorCommand;

/**
 * Class GenerateScaffoldCommand
 * @package Arcanedev\Generators\Commands
 */
class GenerateScaffoldGeneratorCommand extends GeneratorCommand
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
    protected $signature = 'generate:scaffold
                            {name : The entity name.}
                            {--fields= : The fields of migration. Separated with comma (,).}
                            {--prefix= : The prefix path & routes.}
                            {--no-question : Don\'t ask any question.}
                            {--force : Force the creation if file already exists.}';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Generate a new scaffold resource.';

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
            ->run();
    }
}
