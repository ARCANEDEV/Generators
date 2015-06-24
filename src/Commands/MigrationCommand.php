<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Bases\Command;
use Arcanedev\Generators\Generators\MigrationGenerator;
use Illuminate\Foundation\Composer;

/**
 * Class MigrationCommand
 * @package Arcanedev\Generators\Commands
 */
class MigrationCommand extends Command
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
    protected $signature = 'generate:migration
                            {name : The name of class being generated.}
                            {--fields= : The fields of migration. Separated with comma (,).}
                            {--force : Force the creation if file already exists.}';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Generate a new migration.';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Execute the command.
     *
     * @param Composer $composer
     *
     * @throws \Arcanedev\Generators\Exceptions\FileAlreadyExistsException
     */
    public function handle(Composer $composer)
    {
        (new MigrationGenerator([
            'name'   => $this->argument('name'),
            'fields' => $this->option('fields'),
            'force'  => $this->option('force'),
        ]))->run();

        $this->info('Migration created successfully.');

        $composer->dumpAutoloads();
    }
}
