<?php namespace Arcanedev\Generators\Generators;

use Arcanedev\Generators\Bases\Generator;

/**
 * Class ConsoleGenerator
 * @package Arcanedev\Generators\Generators
 */
class ConsoleGenerator extends Generator
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
    protected $stub = 'console';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return app_path() . '/Console/Commands';
    }

    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace()
    {
        return $this->getAppNamespace() . 'Console\\Commands\\';
    }

    /**
     * Get template replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        return array_merge(parent::getReplacements(), [
            'command'     => $this->option('command', 'command:name'),
            'description' => $this->option('description', 'Command description'),
        ]);
    }
}
