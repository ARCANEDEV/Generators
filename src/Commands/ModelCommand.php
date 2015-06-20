<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Generators\ModelGenerator;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class ModelCommand
 * @package Arcanedev\Generators\Commands
 */
class ModelCommand extends Command
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
    protected $name = 'generate:model';

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
    public function fire()
    {
        $generator = new ModelGenerator([
            'name'      => $this->argument('name'),
            'fillable'  => $this->option('fillable'),
            'force'     => $this->option('force'),
        ]);

        $generator->run();

        $this->info('Model created successfully.');
    }

    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of class being generated.', null],
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
            ['fillable', null, InputOption::VALUE_OPTIONAL, 'The fillable attributes.', null],
            ['force', 'f', InputOption::VALUE_NONE, 'Force the creation if file already exists.', null],
        ];
    }
}
