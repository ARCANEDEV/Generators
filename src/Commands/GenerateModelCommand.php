<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Bases\GeneratorCommand;

/**
 * Class GenerateModelCommand
 * @package Arcanedev\Generators\Commands
 */
class GenerateModelGeneratorCommand extends GeneratorCommand
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
    protected $signature = 'generate:model
                            {name : The name of class being generated.}
                            {--fillable= : The fillable attributes.}
                            {--force : Force the creation if file already exists.}';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Generate a new model.';

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
                'fillable'  => $this->option('fillable'),
                'force'     => $this->option('force'),
            ])->run();

        $this->info('Model created successfully.');
    }
}
