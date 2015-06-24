<?php namespace Arcanedev\Generators\Generators;

use Arcanedev\Generators\Bases\Generator;
use Arcanedev\Generators\Migrations\NameParser;
use Arcanedev\Generators\Migrations\SchemaParser;
use Arcanedev\Generators\Stub;

/**
 * Class MigrationGenerator
 * @package Arcanedev\Generators\Generators
 */
class MigrationGenerator extends Generator
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
    protected $stub = 'migration/plain';

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
        return base_path('database/migrations');
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . $this->getFileName() . '.php';
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
     * Get migration name.
     *
     * @return string
     */
    public function getMigrationName()
    {
        return strtolower($this->name);
    }

    /**
     * Get file name.
     *
     * @return string
     */
    public function getFileName()
    {
        return date('Y_m_d_His_') . $this->getMigrationName();
    }

    /**
     * Get schema parser.
     *
     * @return SchemaParser
     */
    public function getSchemaParser()
    {
        return new SchemaParser($this->fields);
    }

    /**
     * Get name parser.
     *
     * @return NameParser
     */
    public function getNameParser()
    {
        return new NameParser($this->name);
    }

    /**
     * Get stub templates.
     *
     * @return string
     */
    public function getStub()
    {
        $parser = $this->getNameParser();

        if ($parser->isCreate()) {
            return Stub::createFromPath(__DIR__ . '/../../stubs/migration/create.stub', [
                'class' => $this->getClass(),
                'table' => $parser->getTable(),
                'fields' => $this->getSchemaParser()->render(),
            ]);
        }
        elseif ($parser->isAdd()) {
            return Stub::createFromPath(__DIR__ . '/../../stubs/migration/add.stub', [
                'class' => $this->getClass(),
                'table' => $parser->getTable(),
                'fields_up' => $this->getSchemaParser()->up(),
                'fields_down' => $this->getSchemaParser()->down(),
            ]);
        }
        elseif ($parser->isDelete()) {
            return Stub::createFromPath(__DIR__ . '/../../stubs/migration/delete.stub', [
                'class' => $this->getClass(),
                'table' => $parser->getTable(),
                'fields_down' => $this->getSchemaParser()->up(),
                'fields_up' => $this->getSchemaParser()->down(),
            ]);
        }
        elseif ($parser->isDrop()) {
            return Stub::createFromPath(__DIR__ . '/../../stubs/migration/drop.stub', [
                'class' => $this->getClass(),
                'table' => $parser->getTable(),
                'fields' => $this->getSchemaParser()->render(),
            ]);
        }

        return parent::getStub();
    }
}
