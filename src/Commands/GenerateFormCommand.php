<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Bases\GeneratorCommand;

/**
 * Class GenerateFormCommand
 * @package Arcanedev\Generators\Commands
 */
class GenerateFormGeneratorCommand extends GeneratorCommand
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
    protected $signature = 'generate:form
                            {table? : The name of table being used.}
                            {--fields= : The form fields.}';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Generate a new form.';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Execute the command.
     */
    public function handle()
    {
        $result = $this->generator
            ->setConsole($this)
            ->setOptions([
                'name'   => $this->argument('table'),
                'fields' => $this->option('fields')
            ])->run();

        $this->line($result);
    }
}
