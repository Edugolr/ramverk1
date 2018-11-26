<?php
namespace Anax\View;

if (isset($location)) {
    ?>
    Stad:   <?= $location[0] ?> <br>
    Lat:    <?= $location[1] ?> <br>
    Long:   <?= $location[2] ?> <br>
    <?php
}
setlocale(LC_ALL, 'swedish.UTF-8');
if (isset($weather[0]["daily"])) {
    ?>
    <div class="container days">
    <?php
    for ($i=0; $i < count($weather); $i++) {
        ?>
        <div class="container card day">
            <i class="<?=$weather[$i]["daily"]["data"][0]["icon"]?>"></i>
            Dag: <?= ucfirst(strftime("%A", $weather[$i]["currently"]["time"])); ?> | <?=  strftime("%x", $weather[$i]["currently"]["time"])?> <br>
            Väderlek  : <?= $weather[$i]["daily"]["data"][0]["summary"] ?><br>
            Temperatur (högsta): <span class="tempHigh"><?=$weather[$i]["daily"]["data"][0]["temperatureHigh"] ?></span>  &#8451; <br>
            Temperatur (lägsta): <span class="tempLow"><?= $weather[$i]["daily"]["data"][0]["temperatureLow"] ?></span> &#8451;<br>
            VindHastighet : <?= $weather[$i]["currently"]["windSpeed"] ?> m/s<br>
        </div> <br><br>
        <?php
    }
    ?>
    </div>
    <?php
}
if (isset($mapDiv)) {
    echo $mapDiv;
}
?>
