<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Bases\Command;
use Arcanedev\Generators\Generators\FormGenerator;

/**
 * Class FormCommand
 * @package Arcanedev\Generators\Commands
 */
class FormCommand extends Command
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
        $generator = new FormGenerator(
            $this->argument('table'),
            $this->option('fields')
        );

        $this->line($generator->render());
    }
}
