<?php namespace Arcanedev\Generators\Contracts;

use Arcanedev\Generators\Bases\GeneratorCommand;
use Arcanedev\Generators\Exceptions\FileAlreadyExistsException;

/**
 * Interface GeneratorInterface
 * @package Arcanedev\Generators\Contracts
 */
interface GeneratorInterface
{
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
    public function setOptions(array $options);

    /**
     * Set generator options
     *
     * @param  GeneratorCommand $console
     *
     * @return self
     */
    public function setConsole(GeneratorCommand $console);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Run the generator.
     *
     * @return mixed
     *
     * @throws FileAlreadyExistsException
     */
    public function run();
}
