<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Generators\ViewGenerator;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

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
    protected $name = 'generate:view';

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
    public function fire()
    {
        $generator = new ViewGenerator([
            'name'      => $this->argument('name'),
            'extends'   => $this->option('extends'),
            'section'   => $this->option('section'),
            'master'    => $this->option('master'),
            'plain'     => $this->option('plain'),
            'content'   => $this->option('content'),
            'template'  => $this->option('template'),
            'force'     => $this->option('force'),
        ]);

        $generator->run();

        $this->info('View created successfully.');
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
            ['extends', 'e', InputOption::VALUE_OPTIONAL, 'The name of view layout being used.', 'layouts.master'],
            ['section', 's', InputOption::VALUE_OPTIONAL, 'The name of section being used.', 'content'],
            ['content', 'c', InputOption::VALUE_OPTIONAL, 'The view content.', null],
            ['template', 't', InputOption::VALUE_OPTIONAL, 'The path of view template.', null],
            ['master', 'm', InputOption::VALUE_NONE, 'Create a master view.', null],
            ['plain', 'p', InputOption::VALUE_NONE, 'Create a blank view.', null],
            ['force', 'f', InputOption::VALUE_NONE, 'Force the creation if file already exists.', null],
        ];
    }
}
