<?php namespace Arcanedev\Generators\Commands;

use Arcanedev\Generators\Bases\Command;
use Arcanedev\Generators\Generators\PivotGenerator;

/**
 * Class PivotCommand
 * @package Arcanedev\Generators\Commands
 */
class PivotCommand extends Command
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
    protected $signature = 'generate:pivot
                            {table_one : The name of table one.}
                            {table_two : The name of table two.}
                            {--timestamp : Add timestamp to migration schema.}
                            {--force : Force the creation if file already exists.}';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Generate a new pivot migration.';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Execute the command.
     */
    public function handle()
    {
        (new PivotGenerator([
            'table_one' => $this->argument('table_one'),
            'table_two' => $this->argument('table_two'),
            'timestamp' => $this->option('timestamp'),
            'force'     => $this->option('force'),
        ]))->run();

        $this->info('Migration created successfully.');
    }
}
