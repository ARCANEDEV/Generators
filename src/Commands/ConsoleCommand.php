<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Generators\ConsoleGenerator;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

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
    protected $name = 'generate:console';

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
    public function fire()
    {
        $generator = new ConsoleGenerator([
            'name'        => $this->argument('name'),
            'force'       => $this->option('force'),
            'command'     => $this->option('command'),
            'description' => $this->option('description'),
        ]);

        $generator->run();

        $this->info('Console created successfully.');
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
            ['command', 'c', InputOption::VALUE_OPTIONAL, 'The name of command being used.', null],
            ['description', 'd', InputOption::VALUE_OPTIONAL, 'The description of command being used.', null],
            ['force', 'f', InputOption::VALUE_NONE, 'Force the creation if file already exists.', null],
        ];
    }
}
