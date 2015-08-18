<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Bases\GeneratorCommand;
use Arcanedev\Generators\Exceptions\FileAlreadyExistsException;
use Illuminate\Foundation\Composer;

/**
 * Class GenerateSeedCommand
 * @package Arcanedev\Generators\Commands
 */
class GenerateSeedGeneratorCommand extends GeneratorCommand
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
     *
     * @param  Composer $composer
     *
     * @throws FileAlreadyExistsException
     */
    public function handle(Composer $composer)
    {
        $this->generator
            ->setConsole($this)
            ->setOptions([
                'name'   => $this->argument('name'),
                'master' => $this->option('master'),
                'force'  => $this->option('force'),
            ])->run();

        $this->info('Seed created successfully.');

        $composer->dumpAutoloads();
    }
}
