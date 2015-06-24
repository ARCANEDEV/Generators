<?php namespace Arcanedev\Generators\FormDumpers;

use Arcanedev\Generators\Migrations\SchemaParser;
use Arcanedev\Generators\Stub;
use Arcanedev\Generators\Traits\StubTrait;

/**
 * Class FieldsDumper
 * @package Arcanedev\Generators\FormDumpers
 */
class FieldsDumper
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
     * The form fields.
     *
     * @var string
     */
    protected $fields;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The constructor.
     *
     * @param string $fields
     */
    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get schema parser.
     *
     * @return SchemaParser
     */
    public function getParser()
    {
        return new SchemaParser($this->fields);
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
        $results = '';

        foreach ($this->getParser()->toArray() as $name => $types) {
            $results .= $this->getStub($this->getFieldType($types), $name).PHP_EOL;
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

        foreach ($this->getParser()->toArray() as $name => $types) {
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

        foreach ($this->getParser()->toArray() as $name => $types) {
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

        foreach ($this->getParser()->toArray() as $name => $types) {
            if ( ! in_array($name, $this->ignores)) {
                $results .= Stub::createFromPath(__DIR__ . '/../../stubs/scaffold/row.stub', [
                    'label'  => ucwords($name),
                    'column' => $name,
                    'var'    => $var,
                ])->render();
            }
        }

        return $results . PHP_EOL;
    }
}
