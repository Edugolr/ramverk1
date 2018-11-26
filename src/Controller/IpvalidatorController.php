<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Chai17\Models;

class IpValidatorController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionGet() : object
    {
        $api = $this->di->get("ipstack");
        $ipstack = $api["config"];
        $title = "Ip validator";
        $page = $this->di->get("page");
        $session = $this->di->get("session");
        $getipInfo = new Models\Curl;
        $extra =  "&fields=ip";
        $userIp =  $getipInfo->cUrl($ipstack["url"]. "check". '?access_key='. $ipstack["key"]. $extra);
        $apiResult = json_decode($userIp, true);
        $session->set("userIp", $apiResult["ip"]);

        $page->add("ipvalidate/index", [
            "ip" => $session->get("userIp"),
            "res" => null,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
    // standard
    public function indexActionPost() : object
    {
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $session = $this->di->get("session");
        $ipNumber = $request->getPost("ip");

        if (filter_var($ipNumber, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $hostname = gethostbyaddr($ipNumber);
            $session->set("ipvalidate", "$ipNumber is a valid IPV6 address Host: $hostname");
        } elseif (filter_var($ipNumber, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $hostname = gethostbyaddr($ipNumber);
            $session->set("ipvalidate", "$ipNumber is a valid IPV4 address Host: $hostname");
        } else {
            $session->set("ipvalidate", "$ipNumber is not a valid IP address");
        }

        $page->add("ipvalidate/index", [
            "ip" => $session->get("userIp"),
            "res" => null,
            "session" => $session,
        ]);

        return $page->render([
        ]);
    }

    // location
    public function locationActionPost() : object
    {
        $api = $this->di->get("ipstack");
        $ipstack = $api["config"];
        $title = "Location";
        $getipInfo = new Models\Curl;
        $map = new Models\Map;
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $session = $this->di->get("session");
        $ipNumber = $request->getPost("ip");
        $extra =  "";
        $json = $getipInfo->cUrl($ipstack["url"]. $ipNumber. '?access_key='. $ipstack["key"]. $extra);


        // Decode JSON response:
        $apiResult = json_decode($json, true);
        $mapDiv = $map->getMap($apiResult["latitude"], $apiResult["longitude"]);
        $page->add("ipvalidate/index", [
            "res" => $apiResult,
            "ip" => $session->get("userIp"),
            "mapDiv" => $mapDiv,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
