<?php namespace Arcanedev\Generators\Generators;

use Arcanedev\Generators\Bases\Generator;

/**
 * Class SeedGenerator
 * @package Arcanedev\Generators\Generators
 *
 * @property bool master
 */
class SeedGenerator extends Generator
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
    protected $stub = 'seed';

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return base_path('database/seeds');
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . $this->getName() . '.php';
    }

    /**
     * Get name of class.
     *
     * @return string
     */
    public function getName()
    {
        return parent::getName() . ($this->master ? 'DatabaseSeeder' : 'TableSeeder');
    }

    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace()
    {
        return '';
    }
}
