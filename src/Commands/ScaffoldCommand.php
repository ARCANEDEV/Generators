<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Generators\ScaffoldGenerator;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class ScaffoldCommand
 * @package Arcanedev\Generators\Commands
 */
class ScaffoldCommand extends Command
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
    protected $name = 'generate:scaffold';

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
    public function fire()
    {
        (new ScaffoldGenerator($this))->run();
    }

    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            ['entity', InputArgument::REQUIRED, 'The entity name.', null],
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
            ['fields', null, InputOption::VALUE_OPTIONAL, 'The fields of migration. Separated with comma (,).', null],
            ['prefix', null, InputOption::VALUE_OPTIONAL, 'The prefix path & routes.', null],
            ['no-question', null, InputOption::VALUE_NONE, 'Don\'t ask any question.', null],
            ['force', 'f', InputOption::VALUE_NONE, 'Force the creation if file already exists.', null],
        ];
    }
}
