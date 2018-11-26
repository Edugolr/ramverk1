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
if (isset($weather["currently"])) {
    ?>
    <div class="container days">
        <div class="container card  current">
            <i class="<?=$weather["currently"]["icon"] ?>"></i>
            Vädret just nu: <?=  strftime("%c", $weather["currently"]["time"])?> <br>
            Väderlek  : <?= $weather["currently"]["summary"] ?><br>
            Temperatur: <?= $weather["currently"]["temperature"] ?> &#8451;<br>
            windSpeed : <?= $weather["currently"]["windSpeed"] ?> m/s
        </div> <br><br>
        <?php

        foreach ($weather["daily"]["data"] as $key => $value) {
            ?>
            <div class="container card day">
                <i class="<?=$value["icon"]?>"></i>
                Dag: <?= ucfirst(strftime("%A", $value["time"])); ?> | <?=  strftime("%x", $value["time"])?> <br>
                Väderlek  : <?= $value["summary"] ?><br>
                Temperatur (högsta): <span class="tempHigh"><?= $value["temperatureHigh"] ?></span>  &#8451; <br>
                Temperatur (lägsta): <span class="tempLow"><?= $value["temperatureLow"] ?></span> &#8451;<br>
                VindHastighet : <?= $value["windSpeed"] ?> m/s<br>
            </div> <br><br>
                <?php
        }
        ?>
    </div>
    <?php
}
if (isset($mapDiv)) {
    ?>
    <div class="">
    <?php
    echo $mapDiv;
    ?>
    </div>
    <?php
}
?>
