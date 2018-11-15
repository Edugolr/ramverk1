<?php

namespace Chai17\IpValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Chai17\Models;


class IpValidatorController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $access_key = '2a0e9de90275d9ee18806e72160162ca';
    private $url = "http://api.ipstack.com/";

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

        $page->add("ipvalidate/index", [
            "ip" => $session->get("userIp"),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
    // standard
    public function indexActionPost() : object
    {
        $page = $this->di->get("page");
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
    // json
    // public function jsonActionPost()
    // {
    //     $title = "Json";
    //     $page = $this->di->get("page");
    //     $request = $this->di->get("request");
    //     $ipNumber = $request->getPost("ip");
    //     $hostname = "NA";
    //     $type = "Not valid";
    //
    //     if (filter_var($ipNumber, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
    //         $hostname = gethostbyaddr($ipNumber);
    //         $type = "IPV6";
    //     } elseif (filter_var($ipNumber, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
    //         $hostname = gethostbyaddr($ipNumber);
    //         $type = "IPV4";
    //     }
    //     $json = [
    //         "type" => "$type",
    //         "host" => "$hostname",
    //         "ip" => "$ipNumber",
    //     ];
    //     return [$json, 200];
    // }
    // location
    public function locationActionPost() : object
    {
        $title = "Location";
        $getipInfo = New Models\Curl;
        $page = $this->di->get("page");
        $response = $this->di->get("response");
        $request = $this->di->get("request");
        $session = $this->di->get("session");
        $ipNumber = $request->getPost("ip");
        $extra =  "";
        $json = $getipInfo->cUrl($this->url, $ipNumber, $this->access_key, $extra);


        // Decode JSON response:
        $api_result = json_decode($json, true);

        $page->add("ipvalidate/index", [
            "res" => $api_result,
            "ip" => $session->get("userIp"),
        ]);

        return $page->render([
            "title" => $title,
        ]);


    }
}
