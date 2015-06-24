<?php namespace Arcanedev\Generators\Generators;

use Arcanedev\Generators\Bases\Command;
use Arcanedev\Generators\FormDumpers\FieldsDumper;
use Arcanedev\Generators\FormDumpers\TableDumper;
use Arcanedev\Generators\Scaffolders\ControllerScaffolder;

/**
 * Class ScaffoldGenerator
 * @package Arcanedev\Generators\Generators
 */
class ScaffoldGenerator
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The illuminate command instance.
     *
     * @var Command
     */
    protected $console;

    /**
     * The laravel instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * The array of view names being created.
     *
     * @var array
     */
    protected $views = ['index', 'edit', 'show', 'create', 'form'];

    /**
     * Indicates the migration has been migrated.
     *
     * @var bool
     */
    protected $migrated = false;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The constructor.
     *
     * @param Command $console
     */
    public function __construct(Command $console)
    {
        $this->console = $console;
        $this->app     = $console->getLaravel();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get entity name.
     *
     * @return string
     */
    private function getEntityName()
    {
        return strtolower(str_singular($this->console->argument('name')));
    }

    /**
     * Get entities name.
     *
     * @return string
     */
    private function getEntities()
    {
        return str_plural($this->getEntityName());
    }

    /**
     * Get controller name.
     *
     * @return string
     */
    private function getControllerName()
    {
        $controller = str_studly($this->getEntities()) . 'Controller';

        if ($this->console->option('prefix')) {
            $controller = str_studly($this->getPrefix('/')) . $controller;
        }

        return str_replace('/', '\\', $controller);
    }

    /**
     * Get prefix name.
     *
     * @param  string|null $suffix
     *
     * @return string|null
     */
    private function getPrefix($suffix = null)
    {
        $prefix = $this->console->option('prefix');

        return $prefix ? ($prefix . $suffix) : null;
    }

    /**
     * Get route name.
     *
     * @return string
     */
    private function getRouteName()
    {
        $route = $this->getEntities();

        if ($this->console->option('prefix')) {
            $route = strtolower($this->getPrefix('/')) . $route;
        }

        return $route;
    }

    /**
     * Get view layout.
     *
     * @return string
     */
    private function getViewLayout()
    {
        return $this->getPrefix('/') . 'layouts/master';
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Run the generator.
     */
    public function run()
    {
        $this->generateModel();
        $this->generateMigration();
        $this->generateSeed();
        $this->generateRequest();
        $this->generateController();
        $this->runMigration();
        $this->generateViews();
        $this->appendRoute();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Generate Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Generate model.
     */
    private function generateModel()
    {
        if ( ! $this->confirm('Do you want to create a model?')) {
            return;
        }

        $this->console->call('generate:model', [
            'name'       => $this->getEntityName(),
            '--fillable' => $this->console->option('fields'),
            '--force'    => $this->console->option('force'),
        ]);
    }

    /**
     * Generate seed.
     */
    private function generateSeed()
    {
        if ( ! $this->confirm('Do you want to create a database seeder class?')) {
            return;
        }

        $this->console->call('generate:seed', [
            'name'    => $this->getEntities(),
            '--force' => $this->console->option('force'),
        ]);
    }

    /**
     * Generate migration.
     */
    private function generateMigration()
    {
        if ( ! $this->confirm('Do you want to create a migration?')) {
            return;
        }

        $this->console->call('generate:migration', [
            'name'      => "create_{$this->getEntities()}_table",
            '--fields'  => $this->console->option('fields'),
            '--force'   => $this->console->option('force'),
        ]);
    }

    /**
     * Generate controller.
     */
    private function generateController()
    {
        if ( ! $this->confirm('Do you want to generate a controller?')) {
            return;
        }

        $this->console->call('generate:controller', [
            'name'       => $this->getControllerName(),
            '--force'    => $this->console->option('force'),
            '--scaffold' => true,
        ]);
    }

    /**
     * Generate a view layout.
     */
    private function generateViewLayout()
    {
        if ($this->confirm('Do you want to create master view?')) {
            $this->console->call('generate:view', [
                'name'     => $this->getViewLayout(),
                '--master' => true,
                '--force'  => $this->console->option('force'),
            ]);
        }
    }

    /**
     * Get controller scaffolder instance.
     *
     * @return ControllerScaffolder
     */
    private function getControllerScaffolder()
    {
        return new ControllerScaffolder($this->getEntityName(), $this->getPrefix());
    }

    /**
     * Get form generator instance.
     *
     * @return FormGenerator
     */
    private function getFormGenerator()
    {
        return new FormGenerator($this->getEntities(), $this->console->option('fields'));
    }

    /**
     * Get table dumper.
     *
     * @return TableDumper|FieldsDumper
     */
    private function getTableDumper()
    {
        if ($this->migrated) {
            return new TableDumper($this->getEntities());
        }

        return new FieldsDumper($this->console->option('fields'));
    }

    /**
     * Generate views.
     */
    private function generateViews()
    {
        $this->generateViewLayout();

        if ( ! $this->confirm('Do you want to create view resources?')) {
            return;
        }

        foreach ($this->views as $view) {
            $this->generateView($view);
        }
    }

    /**
     * Generate a scaffold view.
     *
     * @param string $view
     */
    private function generateView($view)
    {
        $generator = new ViewGenerator([
            'name'      => $this->getPrefix('/') . $this->getEntities() . '/' . $view,
            'extends'   => str_replace('/', '.', $this->getViewLayout()),
            'template'  => __DIR__ . '/../../stubs/scaffold/views/' . $view . '.stub',
            'force'     => $this->console->option('force'),
        ]);

        $generator->appendReplacement(array_merge($this->getControllerScaffolder()->toArray(), [
            'lower_plural_entity'    => strtolower($this->getEntities()),
            'studly_singular_entity' => str_studly($this->getEntityName()),
            'form'                   => $this->getFormGenerator()->render(),
            'table_heading'          => $this->getTableDumper()->toHeading(),
            'table_body'             => $this->getTableDumper()->toBody($this->getEntityName()),
            'show_body'              => $this->getTableDumper()->toRows($this->getEntityName()),
        ]));

        $generator->run();

        $this->console->info('View created successfully.');
    }

    /**
     * Append new route.
     */
    private function appendRoute()
    {
        if ( ! $this->confirm('Do you want to append new route?')) {
            return;
        }

        $contents  = $this->app['files']->get($path = app_path('Http/routes.php'));
        $contents .= PHP_EOL . "Route::resource('{$this->getRouteName()}', '{$this->getControllerName()}');";

        $this->app['files']->put($path, $contents);

        $this->console->info('Route appended successfully.');
    }

    /**
     * Run the migrations.
     */
    private function runMigration()
    {
        if ($this->confirm('Do you want to run all migration now?')) {
            $this->migrated = true;

            $this->console->call('migrate', [
                '--force' => $this->console->option('force'),
            ]);
        }
    }

    /**
     * Generate request classes.
     */
    private function generateRequest()
    {
        if ( ! $this->confirm('Do you want to create form request classes?')) {
            return;
        }

        foreach (['Create', 'Update'] as $request) {
            $name = $this->getPrefix('/') . $this->getEntities() . '/' . $request . str_studly($this->getEntityName()) . 'Request';

            $this->console->call('generate:request', [
                'name'       => $name,
                '--scaffold' => true,
                '--auth'     => true,
                '--rules'    => $this->console->option('fields'),
                '--force'    => $this->console->option('force'),
            ]);
        }
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Confirm a question with the user.
     *
     * @param  string $message
     *
     * @return string
     */
    private function confirm($message)
    {
        if ($this->console->option('no-question')) {
            return true;
        }

        return $this->console->confirm($message);
    }
}
