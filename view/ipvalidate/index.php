<?php
namespace Anax\View;

?>
<h1>Ip validator standard</h1>
Choose format
<form action="">
  <input type="radio" name="action" onclick="document.getElementById('ipvalidate').action='<?=url("ipvalidate")?> ';"> Standard<br>
  <input type="radio" name="action" onclick="document.getElementById('ipvalidate').action='<?= url("ipvalidate/location")?>';"> Location<br>
</form>

<form id="ipvalidate" class="" action="<?=url("ipvalidate") ?> " method="post">
    Ip:<input type="text" name="ip" value="<?=$ip?>">
    <input type="submit" name="" value="Submit">
</form>

<?php
if (isset($session)) {
    ?>
    <div class="">
        <p> <?= $session->get("ipvalidate") ?> </p>
    </div>
    <?php
}
if (isset($res)) {
    ?>
    <div class="">
        <div class="flag fa-pull-right">
            <img src="<?=$res["location"]["country_flag"] ?>" alt="">
        </div>
        <div class="">
            <p class="">Ip: <?=$res["ip"]?> </p>
            <p class="">Type: <?=$res["type"]?></p>
            <p class="">Continent: <?=$res["continent_name"]?></p>
            <p class="">Country: <?=$res["country_name"]?></p>
            <p class="">Region: <?=$res["region_name"]?></p>
            <p class="">City: <?=$res["city"]?></p>
            <p class="">Zip: <?=$res["zip"]?></p>
            <p class="">Language: <?=$res["location"]["languages"][0]["name"]?></p>
        </div>
    </div>
    <?php
}

if (isset($mapDiv)) {
    echo $mapDiv;
}
?>
