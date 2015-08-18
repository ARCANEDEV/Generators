<?php namespace Arcanedev\Generators\Generators;

use Arcanedev\Generators\Bases\Generator;
use Arcanedev\Support\Stub;

/**
 * Class ViewGenerator
 * @package Arcanedev\Generators
 *
 * @property string extends
 * @property string section
 * @property string content
 * @property bool   master
 */
class ViewGenerator extends Generator
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
    protected $stub = 'view';

    /**
     * The array of custom replacements.
     *
     * @var array
     */
    protected $customReplacements = [];

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
        return base_path('resources/views');
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . strtolower($this->getName()) . '.blade.php';
    }

    /**
     * Get stub template for generated file.
     *
     * @return string
     */
    public function getStub()
    {
        if ($this->plain) {
            return $this->getPath();
        }

        if ($template = $this->template) {
            return Stub::create($template, $this->getReplacements())->render();
        }

        return parent::getStub();
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

    /**
     * Get template replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        return $this->customReplacements + [
            'extends' => $this->extends, // 'layouts.master'
            'section' => $this->section, // 'content'
            'content' => $this->content,
        ];
    }

    /**
     * Append a custom replacements to this instance.
     *
     * @param array $replacements
     *
     * @return self
     */
    public function appendReplacement(array $replacements)
    {
        $this->customReplacements = $replacements;

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Setup.
     */
    public function setUp()
    {
        if ($this->master) {
            $this->stub = 'views/master';
        }
    }
}
