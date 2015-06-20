<?php namespace Arcanedev\Generators\Generators;

use Arcanedev\Generators\FormDumpers\FieldsDumper;
use Arcanedev\Generators\FormDumpers\TableDumper;

/**
 * Class FormGenerator
 * @package Arcanedev\Generators\Generators
 */
class FormGenerator
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The name of entity.
     *
     * @var string
     */
    protected $name;

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
     * @param string $name
     * @param string $fields
     */
    public function __construct($name = null, $fields = null)
    {
        $this->name   = $name;
        $this->fields = $fields;
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
        if ($this->fields) {
            return $this->renderFromFields();
        }

        return $this->renderFromDb();
    }

    /**
     * Render form from database.
     *
     * @return string
     */
    public function renderFromDb()
    {
        return (new TableDumper($this->name))->render();
    }

    /**
     * Render form from fields option.
     *
     * @return string
     */
    public function renderFromFields()
    {
        return (new FieldsDumper($this->fields))->render();
    }
}
