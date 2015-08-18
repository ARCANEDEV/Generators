<?php namespace Arcanedev\Generators\Generators;

use Arcanedev\Generators\Bases\GeneratorCommand;
use Arcanedev\Generators\Contracts\GeneratorInterface;
use Arcanedev\Generators\Exceptions\FileAlreadyExistsException;
use Arcanedev\Generators\FormDumpers\FieldsDumper;
use Arcanedev\Generators\FormDumpers\TableDumper;

/**
 * Class FormGenerator
 * @package Arcanedev\Generators\Generators
 */
class FormGenerator implements GeneratorInterface
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
        $this->setOptions(compact('name', 'fields'));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set generator options
     *
     * @param  array $options
     *
     * @return self
     */
    public function setOptions(array $options)
    {
        $this->name   = $options['name'];
        $this->fields = $options['fields'];

        return $this;
    }

    /**
     * Set generator options
     *
     * @param  GeneratorCommand $console
     *
     * @return self
     */
    public function setConsole(GeneratorCommand $console)
    {
        // TODO: Implement setConsole() method.
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Run the generator.
     *
     * @return int
     *
     * @throws FileAlreadyExistsException
     */
    public function run()
    {
        return $this->render();
    }

    /**
     * Render the form.
     *
     * @return string
     */
    public function render()
    {
        return $this->fields
            ? $this->renderFromFields()
            : $this->renderFromDb();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Render form from database.
     *
     * @return string
     */
    private function renderFromDb()
    {
        return (new TableDumper($this->name))->render();
    }

    /**
     * Render form from fields option.
     *
     * @return string
     */
    private function renderFromFields()
    {
        return (new FieldsDumper($this->fields))->render();
    }
}
