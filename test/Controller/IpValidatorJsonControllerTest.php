<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Anax\Request\Request as Request;

/**
 * Test the SampleJsonController.
 */
class IpValidatorJsonControllerTest extends TestCase
{

    // Create the di container.
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
        $this->controller = new IpValidatorJsonController();
        $this->controller->setDI($this->di);
        // $this->controller->initialize();
    }

    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
    }

    /**
     * Test the route "standard".
     */
    public function testStandardActionGet()
    {
        $request = $this->di->get("request");
        $request->setGet("ip", "37.123.148.64");
        $res = $this->controller->standardActionGet();
        $this->assertInternalType("array", $res);

        $request = $this->di->get("request");
        $request->setGet("ip", "2001:0db8:85a3:0000:0000:8a2e:0370:7334");
        $res = $this->controller->standardActionGet();
        $this->assertInternalType("array", $res);
    }

    /**
     * Test the route "location".
     */
    public function testLocationActionGet()
    {
        $res = $this->controller->locationActionGet();
        $this->assertInternalType("array", $res);
    }
}
