<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpValidatorControllerTest extends TestCase
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
        $this->controller = new IpValidatorController();
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
        $body = $res->getBody();
        $exp = "| ramverk1</title>";
        $this->assertContains($exp, $body);
        // $this->assertEquals('some value', var_dump($res), '$b is not equal to "some value", instead it is instead: ' . var_dump($res));
    }

    // test the index post
    public function testIndexActionPost()
    {
        $request = $this->di->get("request");
        $request->setGlobals([
            'post' => [
                'ip' => "194.47.150.9"
            ]
        ]);
        $this->controller->indexActionPost();

        $session = $this->di->get("session");
        $res = $session->get("ipvalidate");

        // $this->assertEquals('some value', var_dump($res), '$b is not equal to "some value", instead it is instead: ' . var_dump($res));
        $exp = "194.47.150.9 is a valid IPV4 address Host: ". gethostbyaddr("194.47.150.9");
        $this->assertEquals($exp, $res);

        $request = $this->di->get("request");
        $request->setGlobals([
            'post' => [
                'ip' => "2001:0db8:85a3:0000:0000:8a2e:0370:7334"
                ]]);
            $this->controller->indexActionPost();
        $session = $this->di->get("session");
        $res = $session->get("ipvalidate");

        $exp = "2001:0db8:85a3:0000:0000:8a2e:0370:7334 is a valid IPV6 address Host: ".gethostbyaddr("2001:0db8:85a3:0000:0000:8a2e:0370:7334");
        $this->assertEquals($exp, $res);
        // $this->assertEquals('some value', var_dump($res), '$b is not equal to "some value", instead it is instead: ' . var_dump($res));


        $request = $this->di->get("request");
        $request->setGlobals([
            'post' => [
                'ip' => "felip"
                ]]);
            $this->controller->indexActionPost();
        $session = $this->di->get("session");
        $res = $session->get("ipvalidate");

        $exp = "felip is not a valid IP address";
        $this->assertEquals($exp, $res);
    }

    // test the location post
    public function testLocationActionPost()
    {
        $request = $this->di->get("request");
        $request->setGlobals([
            'post' => [
                'ip' => "194.47.150.9"
            ]
        ]);
        $res = $this->controller->locationActionPost();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
    }
}
