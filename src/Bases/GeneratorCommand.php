<?php namespace Arcanedev\Generators\Bases;

use Arcanedev\Generators\Contracts\GeneratorInterface;
use Illuminate\Console\Command as IlluminateCommand;

/**
 * Class GeneratorCommand
 * @package Arcanedev\Generators\Bases
 */
abstract class GeneratorCommand extends IlluminateCommand
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Generator
     *
     * @var GeneratorInterface
     */
    protected $generator;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct(GeneratorInterface $generator)
    {
        parent::__construct();

        $this->$generator = $generator;
    }
}
