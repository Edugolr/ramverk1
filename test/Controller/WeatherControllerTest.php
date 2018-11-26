<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherControllerTest extends TestCase
{

    protected $di;
    protected $controller;



    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new WeatherController();
        $this->controller->setDI($this->di);
        // $this->controller->initialize();
    }

    /**
     * Test the route "index".
     */
    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);

        // $this->assertEquals('some value', var_dump($res), '$b is not equal to "some value", instead it is instead: ' . var_dump($res));
    }

    // test the index post
    public function testWeatherActionGet()
    {

        //test ip
        $request = $this->di->get("request");
        $request->setGet("ip", "37.123.148.64");
        $res = $this->controller->weatherActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);

        //test city
        $request->setGet("ip", "stockholm");
        $res = $this->controller->weatherActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
    }

    // test the location post
    public function testWeatherOldActionGet()
    {
        // test ip
        $request = $this->di->get("request");
        $request->setGet("ip", "37.123.148.64");
        $res = $this->controller->weatherOldActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
        //test city
        $request->setGet("ip", "stockholm");
        $res = $this->controller->weatherOldActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
        // $this->assertEquals('some value', var_dump($res), '$b is not equal to "some value", instead it is instead: ' . var_dump($res));
    }
}
