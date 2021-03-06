<?php namespace Arcanedev\Generators\Tests;

use Arcanedev\Generators\GeneratorsServiceProvider;

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
    public function it_can_provide()
    {
        $this->assertEmpty($this->provider->provides());
    }
}
