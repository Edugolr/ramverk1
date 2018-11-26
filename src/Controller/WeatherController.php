<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Chai17\Models;

class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionGet() : object
    {
        $title = "Weather";
        $page = $this->di->get("page");
        $session = $this->di->get("session");
        $api = $this->di->get("ipstack");
        $ipstack = $api["config"];
        $getipInfo = new Models\Curl;
        $extra =  "&fields=ip";
        $userIp =  $getipInfo->cUrl($ipstack["url"]. "check". '?access_key='. $ipstack["key"]. $extra);
        $apiResult = json_decode($userIp, true);

        $session->set("userIp", $apiResult["ip"]);

        $page->add("weather/index", [
            "ip" => $session->get("userIp"),
            "res" => null,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function weatherActionGet()
    {
        $title = "Weather";
        $api = $this->di->get("ipstack");
        $ipstack = $api["config"];
        $api = $this->di->get("mapquest");
        $mapquest = $api["config"];
        $api = $this->di->get("darksky");
        $darksky = $api["config"];
        $getJson = new Models\Curl;
        $map = new Models\Map;
        $validateIP = new Models\ValidateIP;

        $request = $this->di->get("request");
        $page = $this->di->get("page");
        $ipNumber = $request->getGet("ip");
        $test = $validateIP->validate($ipNumber);
        if ($test[0]) {
            $location = $getJson->cUrl($ipstack["url"]. $ipNumber. '?access_key='. $ipstack["key"]);
            $location = json_decode($location, true);
            $latitude = $location["latitude"];
            $longitude = $location["longitude"];
            $location = [$location["city"], $latitude, $longitude];
        } else {
            $search = array('å','ä','ö');
            $replace = array('a','a','o');
            $ipNumber = str_replace($search, $replace, $ipNumber);
            $location = $getJson->cUrl($mapquest["url"]. $mapquest["key"]. $mapquest["extra"]. $ipNumber);
            $location = json_decode($location, true);
            $latitude = $location["results"][0]["locations"][0]["latLng"]["lat"];
            $longitude = $location["results"][0]["locations"][0]["latLng"]["lng"];
            $city = $location["results"][0]["locations"][0]["adminArea5"] ?? "Ingen ort";
            $location = [$city, $latitude, $longitude];
        }

        $extra = "?lang=sv&units=auto";
        $mapDiv = $map->getMap($latitude, $longitude);
        $weatherJson = $getJson->cUrl($darksky["url"]. $darksky["key"]. "/". $latitude. ",". $longitude. $extra);

        $weather = json_decode($weatherJson, true);
        $page->add("weather/weather", [
            "location" => $location,
            "mapDiv" => $mapDiv,
            "weather" => $weather
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function weatherOldActionGet()
    {
        $title = "Weather Old";
        $api = $this->di->get("ipstack");
        $ipstack = $api["config"];
        $api = $this->di->get("darksky");
        $darksky = $api["config"];
        $title = "Weather";

        $getJson = new Models\Curl;
        $map = new Models\Map;
        $validateIP = new Models\ValidateIP;

        $request = $this->di->get("request");
        $page = $this->di->get("page");
        $ipNumber = $request->getGet("ip");
        $test = $validateIP->validate($ipNumber);
        if ($test[0]) {
            $location = $getJson->cUrl($ipstack["url"]. $ipNumber. '?access_key='. $ipstack["key"]);
            $location = json_decode($location, true);
            $latitude = $location["latitude"];
            $longitude = $location["longitude"];
            $location = [$location["city"], $latitude, $longitude];
        } else {
            $search = array('å','ä','ö');
            $replace = array('a','a','o');
            $ipNumber = str_replace($search, $replace, $ipNumber);
            $location = $getJson->cUrl("http://www.mapquestapi.com/geocoding/v1/address?key=HVd7TbTeHvGGiGF14rSntAMMq3VDSAtT&location=".$ipNumber);
            $location = json_decode($location, true);

            $latitude = $location["results"][0]["locations"][0]["latLng"]["lat"];
            $longitude = $location["results"][0]["locations"][0]["latLng"]["lng"];
            $location = $getJson->cUrl("http://www.mapquestapi.com/geocoding/v1/reverse?key=HVd7TbTeHvGGiGF14rSntAMMq3VDSAtT&location=".$latitude. ",". $longitude);
            $location = json_decode($location, true);
            $city = $location["results"][0]["locations"][0]["adminArea5"] ?? "Ingen ort";
            $location = [$city, $latitude, $longitude];
        }
        $url = [];
        $extra = "?lang=sv&units=auto";
        $time  = time() - (30 * 24 * 60 * 60);
        for ($i=0; $i < 31; $i++) {
            $time  = time() - ($i * 24 * 60 * 60);
            array_push($url, $darksky["url"]. $darksky["key"]. "/". $latitude. ",". $longitude. ",". $time. $extra);
        }


        $mapDiv = $map->getMap($latitude, $longitude);
        $weatherJson = $getJson->cUrlMulti($url);
        $weather = [];
        for ($i=0; $i < count($weatherJson); $i++) {
            array_push($weather, json_decode($weatherJson[$i], true));
        }

        $page->add("weather/weatherOld", [
            "location" => $location,
            "mapDiv" => $mapDiv,
            "weather" => $weather
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
