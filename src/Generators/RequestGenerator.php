<?php namespace Arcanedev\Generators\Generators;

use Arcanedev\Generators\Bases\Generator;
use Arcanedev\Generators\Migrations\SchemaParser;

/**
 * Class RequestGenerator
 * @package Arcanedev\Generators\Generators
 *
 * @property bool auth
 * @property bool scaffold
 * @property bool rules
 */
class RequestGenerator extends Generator
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
    protected $stub = 'request';

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
        return app_path('Http/Requests');
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
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace()
    {
        return $this->getAppNamespace() . 'Http\\Requests\\';
    }

    /**
     * Get stub replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        return array_merge(parent::getReplacements(), [
            'auth'  => $this->getAuth(),
            'rules' => $this->getRules(),
        ]);
    }

    /**
     * Get auth replacement.
     *
     * @return string
     */
    private function getAuth()
    {
        return 'return ' . ($this->auth ? 'true' : 'false') . ';';
    }

    /**
     * Get replacement for "$RULES$".
     *
     * @return string
     */
    private function getRules()
    {
        if ( ! $this->rules) {
            return 'return [];';
        }

        $parser = new SchemaParser($this->rules);

        $results = 'return ['.PHP_EOL;

        foreach ($parser->toArray() as $field => $rules) {
            $results .= $this->createRules($field, $rules);
        }

        return $results . "\t\t];";
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create a rule.
     *
     * @param  string $field
     * @param  string $rules
     *
     * @return string
     */
    private function createRules($field, $rules)
    {
        $rule = str_replace(['(', ')', ';'], [':', '', ','], implode('|', $rules));

        if ($this->scaffold) {
            $rule = 'required';
        }

        return "\t\t\t'{$field}' => '".$rule."',".PHP_EOL;
    }
}
