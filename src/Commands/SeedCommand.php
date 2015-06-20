<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Generators\SeedGenerator;
use Illuminate\Console\Command;
use Illuminate\Foundation\Composer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class SeedCommand
 * @package Arcanedev\Generators\Commands
 */
class SeedCommand extends Command
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
    protected $name = 'generate:seed';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Generate a new seed.';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Execute the command.
     */
    public function fire(Composer $composer)
    {
        $generator = new SeedGenerator([
            'name' => $this->argument('name'),
            'master' => $this->option('master'),
            'force' => $this->option('force'),
        ]);

        $generator->run();

        $this->info('Seed created successfully.');

        $composer->dumpAutoloads();
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
            ['master', 'm', InputOption::VALUE_NONE, 'Generate master database seeder.', null],
            ['force', 'f', InputOption::VALUE_NONE, 'Force the creation if file already exists.', null],
        ];
    }
}
