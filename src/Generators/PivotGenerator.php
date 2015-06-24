<?php namespace Arcanedev\Generators\Generators;

use Arcanedev\Generators\Bases\Generator;

/**
 * Class PivotGenerator
 * @package Arcanedev\Generators\Generators
 *
 * @property string table_one
 * @property string table_two
 * @property bool   timestamp
 */
class PivotGenerator extends Generator
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
    protected $stub = 'migration/pivot';

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
        return $this->getBasePath() . $this->getFilename() . '.php';
    }

    /**
     * Get filename.
     *
     * @return string
     */
    public function getFilename()
    {
        return date('Y_m_d_His_') . $this->getMigrationName();
    }

    /**
     * Get migration name.
     *
     * @return string
     */
    public function getMigrationName()
    {
        return 'create_' . $this->getPivotTableName() . '_pivot';
    }

    /**
     * Get class name.
     *
     * @return string
     */
    public function getClass()
    {
        return str_studly($this->getMigrationName());
    }

    /**
     * Get the name of the pivot table.
     *
     * @return string
     */
    public function getPivotTableName()
    {
        return implode('_', array_map('str_singular', $this->getSortedTableNames()));
    }

    /**
     * Get sorted table names.
     *
     * @return array
     */
    public function getSortedTableNames()
    {
        $tables = [
            strtolower($this->table_one),
            strtolower($this->table_two),
        ];

        sort($tables);

        return $tables;
    }

    /**
     * Get stub replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        return array_merge(parent::getReplacements(), [
            'table_one'     => $this->table_one,
            'table_two'     => $this->table_two,
            'column_one'    => $this->getColumnOne(),
            'column_two'    => $this->getColumnTwo(),
            'table_pivot'   => $this->getPivotTableName(),
            'timestamp'     => $this->getTimestampReplacement(),
        ]);
    }

    /**
     * Get replacement for TIMESTAMP.
     *
     * @return string|null
     */
    public function getTimestampReplacement()
    {
        return $this->timestamp
            ? '$table->timestamps();'
            : null;
    }

    /**
     * Get column one.
     *
     * @return string
     */
    public function getColumnOne()
    {
        return str_singular($this->table_one);
    }

    /**
     * Get column two.
     *
     * @return string
     */
    public function getColumnTwo()
    {
        return str_singular($this->table_two);
    }
}
