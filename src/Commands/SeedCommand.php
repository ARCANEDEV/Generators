<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Bases\Command;
use Arcanedev\Generators\Generators\SeedGenerator;
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
    protected $signature = 'generate:seed
                            {name : The name of class being generated.}
                            {--master : Generate master database seeder.}
                            {--force : Force the creation if file already exists.}';

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
    public function handle(Composer $composer)
    {
        (new SeedGenerator([
            'name'   => $this->argument('name'),
            'master' => $this->option('master'),
            'force'  => $this->option('force'),
        ]))->run();

        $this->info('Seed created successfully.');

        $composer->dumpAutoloads();
    }
}
