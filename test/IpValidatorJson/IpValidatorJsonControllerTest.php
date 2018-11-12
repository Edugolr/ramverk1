<?php

namespace Chai17\IpValidatorJson;

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
        $this->controller->initialize();
    }



    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexActionGet();
        $this->assertInternalType("array", $res);

        $json = $res[0];
        $exp = "No content";
        $this->assertContains($exp, $json["message"]);
    }



    /**
     * Test the route "dump-di".
     */
    public function testDumpDiActionGet()
    {
        $res = $this->controller->dumpDiActionGet();
        $this->assertInternalType("array", $res);

        $json = $res[0];
        $exp = "di contains";
        $this->assertContains($exp, $json["message"]);
        $this->assertContains("configuration", $json["di"]);
        $this->assertContains("request", $json["di"]);
        $this->assertContains("response", $json["di"]);
    }

    // test the index post
    public function testIndexActionPost()
    {
        $request = $this->di->get("request");
        $request->setGlobals([
            'post' => [
                'ip' => "194.47.150.9"
                ]]);
        $res = $this->controller->indexActionPost();

        $this->assertInternalType("array", $res);
        $json = $res[0];
        $exp = "194.47.150.9";
        $this->assertEquals($exp, $json["ip"]);

        $request->setGlobals([
            'post' => [
                'ip' => "2001:0db8:85a3:0000:0000:8a2e:0370:7334"
                ]]);
        $res = $this->controller->indexActionPost();
        $json = $res[0];
        $exp = "2001:0db8:85a3:0000:0000:8a2e:0370:7334";
        $this->assertEquals($exp, $json["ip"]);
    }

    /**
     * Test the route "forbidden".
     */
    public function testForbiddenAction()
    {
        $res = $this->controller->forbiddenAction();
        $this->assertInternalType("array", $res);

        $json = $res[0];
        $status = $res[1];

        $exp = "forbidden to access";
        $this->assertContains($exp, $json["message"]);
        $this->assertEquals(403, $status);
    }
}
