<?php namespace Arcanedev\Generators\Tests\Providers;

use Arcanedev\Generators\Providers\GeneratorsServiceProvider;
use Arcanedev\Generators\Tests\TestCase;

/**
 * Class     GeneratorsServiceProviderTest
 *
 * @package  Arcanedev\Generators\Tests\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeneratorsServiceProviderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var GeneratorsServiceProvider */
    private $provider;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(GeneratorsServiceProvider::class);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->provider);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(GeneratorsServiceProvider::class, $this->provider);
    }

    /** @test */
    public function it_can_provides()
    {
        $provided = $this->provider->provides();

        $this->assertCount(10, $provided);
        $this->assertEquals([
            'arcanedev.generators.model',
            'arcanedev.generators.controller',
            'arcanedev.generators.console',
            'arcanedev.generators.view',
            'arcanedev.generators.seed',
            'arcanedev.generators.migration',
            'arcanedev.generators.request',
            'arcanedev.generators.pivot',
            'arcanedev.generators.scaffold',
            'arcanedev.generators.form',
        ], $provided);
    }
}
