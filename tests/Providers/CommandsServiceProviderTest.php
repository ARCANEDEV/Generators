<?php namespace Arcanedev\Generators\Tests\Providers;

use Arcanedev\Generators\Providers\CommandsServiceProvider;
use Arcanedev\Generators\Tests\TestCase;

/**
 * Class     CommandsServiceProviderTest
 *
 * @package  Arcanedev\Generators\Tests\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CommandsServiceProviderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var CommandsServiceProvider */
    private $provider;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(CommandsServiceProvider::class);
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
        $this->assertInstanceOf(CommandsServiceProvider::class, $this->provider);
    }

    /** @test */
    public function it_can_provides()
    {
        $provided = $this->provider->provides();

        $this->assertCount(10, $provided);
        $this->assertEquals([
            'arcanedev.generators.commands.model',
            'arcanedev.generators.commands.controller',
            'arcanedev.generators.commands.console',
            'arcanedev.generators.commands.view',
            'arcanedev.generators.commands.seed',
            'arcanedev.generators.commands.migration',
            'arcanedev.generators.commands.request',
            'arcanedev.generators.commands.pivot',
            'arcanedev.generators.commands.scaffold',
            'arcanedev.generators.commands.form',
        ], $provided);
    }
}
