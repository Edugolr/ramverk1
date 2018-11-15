<?php

namespace Chai17\IpValidatorJson;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Chai17\Models;
/**
 * Style chooser controller loads available stylesheets from a directory and
 * lets the user choose the stylesheet to use.
 */
class IpValidatorJsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $access_key = '2a0e9de90275d9ee18806e72160162ca';
    private $url = "http://api.ipstack.com/";

    // json
    public function indexAction() : object
    {
        $title = "Ip validator";
        $session = $this->di->get("session");
        $getipInfo = New Models\Curl;
        $extra =  "&fields=ip";
        $userIp =  $getipInfo->cUrl($this->url, "check", $this->access_key, $extra);
        $api_result = json_decode($userIp, true);
        $session->set("userIp", $api_result);
        $page = $this->di->get("page");

        $page->add("ipvalidatejson/index", [
            "ip" => $session->get("userIp"),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
    public function standardActionGet()
    {
        $request = $this->di->get("request");
        $ipNumber = $request->getGet("ip");
        $hostname = "NA";
        $type = "Not valid";

        if (filter_var($ipNumber, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $hostname = gethostbyaddr($ipNumber);
            $type = "IPV6";
        } elseif (filter_var($ipNumber, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $hostname = gethostbyaddr($ipNumber);
            $type = "IPV4";
        }
        $json = [
            "type" => "$type",
            "host" => "$hostname",
            "ip" => "$ipNumber",
        ];
        return [$json, 200];
    }
    public function locationActionGet()
    {
        $getipInfo = New Models\Curl;
        $request = $this->di->get("request");
        $ipNumber = $request->getGet("ip");

        $json = $getipInfo->cUrl($this->url, $ipNumber, $this->access_key);
        return [$json];
    }
}
