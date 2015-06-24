<?php namespace Arcanedev\Generators\Bases;

use Arcanedev\Generators\Exceptions\FileAlreadyExistsException;
use Arcanedev\Generators\Stub;
use Illuminate\Console\AppNamespaceDetectorTrait;
use Illuminate\Filesystem\Filesystem;

/**
 * Class Generator
 * @package Arcanedev\Generators\Bases
 */
abstract class Generator
{
    /* ------------------------------------------------------------------------------------------------
     |  Traits
     | ------------------------------------------------------------------------------------------------
     */
    use AppNamespaceDetectorTrait;

    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */

    protected $name;

    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * The array of options.
     *
     * @var array
     */
    protected $options;

    /**
     * The short name of stub.
     *
     * @var string
     */
    protected $stub;

    /**
     * Force the generator
     *
     * @var bool
     */
    protected $force = false;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create new instance of this class.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->filesystem = new Filesystem;
        $this->options    = $options;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get name input.
     *
     * @return string
     */
    public function getName()
    {
        $name = $this->name;

        if (str_contains($this->name, '\\')) {
            $name = str_replace('\\', '/', $this->name);
        }

        if (str_contains($this->name, '/')) {
            $name = str_replace('/', '/', $this->name);
        }

        return str_studly(str_replace(' ', '/', ucwords(str_replace('/', ' ', $name))));
    }

    /**
     * Get the filesystem instance.
     *
     * @return Filesystem
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * Set the filesystem instance.
     *
     * @param  Filesystem $filesystem
     *
     * @return self
     */
    public function setFilesystem(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;

        return $this;
    }

    /**
     * Get stub template for generated file.
     *
     * @return string
     */
    public function getStub()
    {
        $stub = Stub::create($this->stub . '.stub', $this->getReplacements());

        $stub->setBasePath(__DIR__ . '/../../stubs/');

        return $stub->render();
    }

    /**
     * Get template replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        return [
            'class'          => $this->getClass(),
            'namespace'      => $this->getNamespace(),
            'root_namespace' => $this->getRootNamespace(),
        ];
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return base_path();
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . '/' . $this->getName() . '.php';
    }

    /**
     * Get class name.
     *
     * @return string
     */
    public function getClass()
    {
        return str_studly(class_basename($this->getName()));
    }

    /**
     * Get paths of namespace.
     *
     * @return array
     */
    public function getSegments()
    {
        return explode('/', $this->getName());
    }

    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace()
    {
        return $this->getAppNamespace();
    }

    /**
     * Get class namespace.
     *
     * @return string
     */
    public function getNamespace()
    {
        $segments = $this->getSegments();

        array_pop($segments);

        $rootNamespace = $this->getRootNamespace();

        if ($rootNamespace === '') {
            return '';
        }

        return 'namespace ' . rtrim($rootNamespace . implode($segments, '\\'), '\\') . ';';
    }

    /**
     * Setup some hook.
     */
    public function setUp()
    {
        //
    }

    /**
     * Get options.
     *
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Helper method for "getOption".
     *
     * @param  string      $key
     * @param  string|null $default
     *
     * @return string
     */
    public function option($key, $default = null)
    {
        return $this->getOption($key, $default);
    }

    /**
     * Get value from options by given key.
     *
     * @param  string      $key
     * @param  string|null $default
     *
     * @return string
     */
    public function getOption($key, $default = null)
    {
        if ( ! $this->hasOption($key)) {
            return $default;
        }

        return $this->options[$key] ?: $default;
    }

    /**
     * Force the generator to overwrite
     *
     * @return self
     */
    public function force()
    {
        $this->force = true;

        return $this;
    }

    /**
     * Handle call to __get method.
     *
     * @param  string $key
     *
     * @return string|mixed
     */
    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->{$key};
        }

        return $this->option($key);
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
        $this->setUp();

        if ($this->filesystem->exists($path = $this->getPath()) && ! $this->force) {
            throw new FileAlreadyExistsException($path);
        }

        if ( ! $this->filesystem->isDirectory($dir = dirname($path))) {
            $this->filesystem->makeDirectory($dir, 0777, true, true);
        }

        return $this->filesystem->put($path, $this->getStub());
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Determinate whether the given key exist in options array.
     *
     * @param  string $key
     *
     * @return bool
     */
    public function hasOption($key)
    {
        return array_key_exists($key, $this->options);
    }
}
