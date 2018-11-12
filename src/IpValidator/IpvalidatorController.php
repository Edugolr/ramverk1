<?php

namespace Chai17\IpValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * Style chooser controller loads available stylesheets from a directory and
 * lets the user choose the stylesheet to use.
 */
class IpValidatorController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction() : object
    {
        $title = "Ip validator";
        $page = $this->di->get("page");

        $page->add("ipvalidate/index", [
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function indexActionPost() : object
    {
        $response = $this->di->get("response");
        $request = $this->di->get("request");
        $session = $this->di->get("session");
        $ipNumber = $request->getPost("ip");
        // $hostname = $request->getPost("hostname");
        // $ip= gethostbyname($ip);
        if (filter_var($ipNumber, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $hostname = gethostbyaddr($ipNumber);
            $session->set("flashmessage", "$ipNumber is a valid IPV6 address Host: $hostname");
        } elseif (filter_var($ipNumber, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $hostname = gethostbyaddr($ipNumber);
            $session->set("flashmessage", "$ipNumber is a valid IPV4 address Host: $hostname");
        } else {
            $session->set("flashmessage", "$ipNumber is not a valid IP address");
        }

        return $response->redirect("ipvalidate/index");
    }
}
