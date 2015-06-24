<?php namespace Arcanedev\Generators\Generators;

use Arcanedev\Generators\Bases\Generator;
use Arcanedev\Generators\Scaffolders\ControllerScaffolder;

/**
 * Class ControllerGenerator
 * @package Arcanedev\Generators\Generators
 *
 * @property bool                      resource
 * @property bool                      scaffold
 * @property ControllerScaffolder|null scaffolder
 */
class ControllerGenerator extends Generator
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'controller/plain';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Configure some data.
     */
    public function setUp()
    {
        if ($this->resource) {
            $this->stub       = 'controller/resource';
        }
        elseif ($this->scaffold) {
            $this->stub       = 'controller/scaffold';
            $this->scaffolder = new ControllerScaffolder($this->getClass(), $this->getPrefix());
        }
    }

    /**
     * Get prefix class.
     *
     * @return string
     */
    public function getPrefix()
    {
        $paths = explode('/', $this->getName());

        array_pop($paths);

        return strtolower(implode('\\', $paths));
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return app_path() . '/Http/Controllers';
    }

    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace()
    {
        return $this->getAppNamespace() . 'Http\\Controllers\\';
    }

    /**
     * Get template replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        $replacements = array_merge(parent::getReplacements(), [
            'root_namespace' => $this->getAppNamespace()
        ]);

        if ($this->scaffold) {
            $replacements = array_merge($replacements, $this->scaffolder->toArray());
        }

        return $replacements;
    }
}
