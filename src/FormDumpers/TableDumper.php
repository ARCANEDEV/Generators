<?php namespace Arcanedev\Generators\FormDumpers;

use Arcanedev\Generators\Traits\StubTrait;
use Doctrine\DBAL\Schema\Column;
use Illuminate\Support\Facades\DB;
use Arcanedev\Generators\Stub;

/**
 * Class TableDumper
 * @package Arcanedev\Generators\FormDumpers
 */
class TableDumper
{
    /* ------------------------------------------------------------------------------------------------
     |  Traits
     | ------------------------------------------------------------------------------------------------
     */
    use StubTrait;

    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The table name.
     *
     * @var string
     */
    protected $table;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The constructor.
     *
     * @param string $table
     */
    public function __construct($table)
    {
        $this->table = $table;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get table name.
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Get column.
     *
     * @return array
     */
    public function getColumns()
    {
        return DB::getDoctrineSchemaManager()
            ->listTableDetails($this->getTable())
            ->getColumns();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Render the form.
     *
     * @return string
     */
    public function render()
    {
        $columns = $this->getColumns();

        $results = '';

        foreach ($columns as $column) {
            /** @var Column $column */
            $results .= $this->getStub(
                $column->getType()->getName(),
                $column->getName()
            );
        }

        return $results;
    }

    /**
     * Convert the fields to html heading.
     *
     * @return string
     */
    public function toHeading()
    {
        $results = '';

        foreach ($this->getColumns() as $column) {
            /** @var Column $column */
            $name = $column->getName();

            if ( ! in_array($name, $this->ignores)) {
                $results .= "\t\t\t" . '<th>' . ucwords($name) . '</th>' . PHP_EOL;
            }
        }

        return $results;
    }

    /**
     * Convert the fields to formatted php script.
     *
     * @param string $var
     *
     * @return string
     */
    public function toBody($var)
    {
        $results = '';

        foreach ($this->getColumns() as $column) {
            /** @var Column $column */
            $name = $column->getName();

            if ( ! in_array($name, $this->ignores)) {
                $results .= "\t\t\t\t\t" . '<td>{!! $' . $var . '->' . $name . ' !!}</td>' . PHP_EOL;
            }
        }

        return $results;
    }

    /**
     * Get replacements for $SHOW_BODY$.
     *
     * @param string $var
     *
     * @return string
     */
    public function toRows($var)
    {
        $results = PHP_EOL;

        foreach ($this->getColumns() as $column) {
            /** @var Column $column */
            $name = $column->getName();

            if ( ! in_array($name, $this->ignores)) {
                $results .= Stub::create(__DIR__ . '/../../stubs/scaffold/row.stub', [
                    'label'  => ucwords($name),
                    'column' => $name,
                    'var'    => $var,
                ])->render();
            }
        }

        return $results . PHP_EOL;
    }
}
