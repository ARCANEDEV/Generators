<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Generators\FormGenerator;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

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
    protected $name = 'generate:form';

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
    public function fire()
    {
        $generator = new FormGenerator(
            $this->argument('table'),
            $this->option('fields')
        );

        $this->line($generator->render());
    }

    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            ['table', InputArgument::OPTIONAL, 'The name of table being used.', null],
        ];
    }

    /**
     * The array of command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            ['fields', 'f', InputOption::VALUE_OPTIONAL, 'The form fields.', null],
        ];
    }
}
